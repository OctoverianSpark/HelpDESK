<?php

namespace Controllers;

use Exception;
use MVC\Router;

use Models\Inventory;
use Models\Perifericos;
use Models\Ordenes;
use Models\Personal;
use Models\Users;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Shared\Html;
use PhpOffice\PhpWord\SimpleType\Jc;
use PhpOffice\PhpWord\SimpleType\TextAlignment;

class OrderController
{
    /**
     * Allowed order types — used for whitelist validation to prevent path traversal.
     */
    private const ALLOWED_TYPES = ["entrega", "recepcion", "salida"];

    /**
     * Maps order ID prefix to human-readable type string.
     */
    private const ORDER_ID_TYPE_MAP = [
        "ODS" => "salida",
        "ODE" => "entrega",
        "ODR" => "recepcion",
    ];


    // -------------------------------------------------------------------------
    // Page renderers
    // -------------------------------------------------------------------------

    public static function index(Router $router): void
    {
        $orders = Ordenes::all();

        $router->render("admin/inventario/ordenes/index", [
            "orders" => $orders,
        ]);
    }

    public static function orden(Router $router): void
    {
        $router->render("admin/inventario/ordenes/orden", []);
    }

    public static function crear(Router $router): void
    {
        $inv    = Inventory::all(null, null, 1);
        $users  = Personal::all();
        $orders = Ordenes::filter("state", "=", "pendiente");

        $router->render("/admin/inventario/ordenes/crear", [
            "inv"    => $inv,
            "users"  => $users,
            "orders" => $orders,
        ]);
    }


    // -------------------------------------------------------------------------
    // Actions
    // -------------------------------------------------------------------------

    public static function send(): void
    {
        // --- 1. Parse and validate JSON body ---
        $post = json_decode(file_get_contents("php://input"));

        if (!$post || !isset($post->type)) {
            http_response_code(400);
            echo json_encode(["error" => "Invalid request body."]);
            exit;
        }

        // FIX #1 — Whitelist $post->type to prevent path traversal attacks.
        if (!in_array($post->type, self::ALLOWED_TYPES, true)) {
            http_response_code(400);
            echo json_encode(["error" => "Invalid order type."]);
            exit;
        }

        // FIX #7 — Guard file_get_contents() against missing templates.
        $templatePath = __DIR__ . "/../views/templates/mail/" . $post->type . ".html";
        $html = file_get_contents($templatePath);
        if ($html === false) {
            http_response_code(500);
            echo json_encode(["error" => "Mail template not found for type: " . $post->type]);
            exit;
        }

        // FIX #3 — Initialise $days so it is always defined regardless of branch.
        $days = "";

        // --- 2. Build or load the order ---
        if ($post->type === "entrega" || $post->type === "recepcion") {

            $orderCount = Ordenes::countOrders(strtoupper($post->type[0]));

            // FIX #11 — Always use $orderCount + 1 to avoid ID collisions.
            $post->order_id = "OD" . strtoupper($post->type[0]) . "#" . ($orderCount + 1);

            $order = new Ordenes([
                "emitted_date" => date("Y-m-d"),
                "order_id"     => $post->order_id,
                "computer_id"  => $post->computer_id,
                "user_id"      => $post->user_id,
                "features"     => $post->features,
            ]);

        } else {

            $order = array_shift(Ordenes::filter("order_id", "=", $post->order_id));

            if (!$order) {
                http_response_code(404);
                echo json_encode(["error" => "Order not found."]);
                exit;
            }

            if (strtolower($order->return_date) === "no return") {
                $days = "Indefinido";
            } else {
                $days = calculateDays($order->emitted_date, $order->return_date);
            }

            $order->sync(["state" => "generada"]);
        }

        // --- 3. Populate the HTML template ---
        $html = str_replace("{{emission_date}}", $order->emitted_date, $html);

        $return = ($order->return_date === "no return") ? "Sin Retorno" : $order->return_date;
        $html   = str_replace("{{return_date}}", $return, $html);
        $html   = str_replace("{{days}}", $days, $html);

        $id = $order->guardar();

        // FIX #5 — Use $post->type consistently; do not mix with $_POST.
        $html = str_replace("{{order_type}}", $post->type, $html);
        $html = str_replace("{{order_id}}", $order->order_id, $html);
        $html = str_replace("{{id}}", $id, $html);

        // --- 4. Dispatch ---
        $inv  = Inventory::find($order->computer_id);
        $usr  = Personal::find($order->user_id);
        $pers = Perifericos::findGroup($order->user_id);

        if ($post->type === "recepcion") {
            // FIX #10 — Delegate to a dedicated method instead of a bare include.
            self::processRecepcion($order, $inv, $usr, $pers, $html);
        } else {
            echo json_encode([
                "msg" => enviarCorreo($html, "Orden Generada", [strtolower($inv->correo_dominio)]) ?? "Message sent!",
            ]);
        }

        exit;
    }


    public static function sign(Router $router): void
    {
        $id    = validarID($_GET["id"]);
        $order = Ordenes::find($id);

        if ($order->state === "firmada") {
            header("Location: /");
            exit;
        }

        // FIX #9 — Use match() with an explicit default so $type is never undefined.
        $type = self::resolveOrderType($order->order_id);

        // FIX #2 & #8 — Removed dead/wrong variables ($computer_id, $user_id,
        //               $emission_date, $cols). They were unused and $user_id
        //               incorrectly read from computer_id.

        $order->sync(["state" => "generada"]);

        $eq   = Inventory::find($order->computer_id);
        $usr  = Personal::PIVOTFINDER($order->user_id);
        $pers = Perifericos::filter("user_id", "=", $order->user_id);
        $ftrs = json_decode($order->features);

        $router->render("pages/ordenes/orden", [
            "eq"    => $eq,
            "usr"   => $usr,
            "pers"  => $pers,
            "order" => $order,
            "type"  => $type,
            "ftrs"  => $ftrs,
        ]);
    }


    // -------------------------------------------------------------------------
    // Private helpers
    // -------------------------------------------------------------------------

    /**
     * Resolve the human-readable order type from an order_id string.
     * FIX #9 — Throws clearly instead of leaving $type undefined.
     *
     * @throws \RuntimeException if the prefix is not recognised.
     */
    private static function resolveOrderType(string $orderId): string
    {
        foreach (self::ORDER_ID_TYPE_MAP as $prefix => $type) {
            if (str_contains($orderId, $prefix)) {
                return $type;
            }
        }

        throw new \RuntimeException("Unrecognised order ID prefix in: " . $orderId);
    }

    /**
     * Handle recepcion order processing.
     * FIX #10 — Replaces the bare include with a proper encapsulated method.
     */
    private static function processRecepcion(
        Ordenes   $order,
        Inventory $inv,
                  $usr,
                  $pers,
        string    $html
    ): void {
        // The original logic from recepcion.php belongs here.
        // Variables $order, $inv, $usr, $pers, and $html are all in scope.
        include __DIR__ . "/../includes/scripts/convert/recepcion.php";
    }
}