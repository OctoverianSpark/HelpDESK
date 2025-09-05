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

class  OrderController
{




    public static function index(Router $router)
    {

        $orders = Ordenes::all();


        $router->render("admin/inventario/ordenes/index", [
            "orders" => $orders,
        ]);
    }

    public static function orden(Router $router)
    {
        $router->render("admin/inventario/ordenes/orden", []);
    }

    public static function crear(Router $router)
    {

        $inv = Inventory::all(null, null, 1);

        $users = Personal::all();


        $orders = Ordenes::filter("state", "=", "pendiente");



        $router->render("/admin/inventario/ordenes/crear", [
            "inv" => $inv,
            "users" => $users,
            "orders" => $orders
        ]);
    }


    public static function send()
    {


        $post = json_decode(file_get_contents("php://input"));

        $html = file_get_contents(__DIR__ . "/../views/templates/mail/" . $post->type . ".html");

        if ($post->type === "entrega" || $post->type === "recepcion") {

            $orderCount = Ordenes::countOrders(strtoupper($post->type[0]));

            $post->order_id = "OD" . strtoupper($post->type[0]) . "#" . (($orderCount === 0) ? 1 : $orderCount);


            $order = new Ordenes([
                "emitted_date" => date("Y-m-d"),
                "order_id" => $post->order_id,
                "computer_id" => $post->computer_id,
                "user_id" => $post->user_id,
                "features" => $post->features
            ]);
        } else {



            $order = array_shift(Ordenes::filter("order_id", "=", $post->order_id));

            $days = "";

            if (strtolower($order->return_date) === "no return") {
                $days = 'Indefinido';
            } else {
                $days = calculateDays($order->emitted_date, $order->return_date);
            }


            $order->sync(["state" => "generada"]);
        }

        $html = str_replace("{{emission_date}}", $order->emitted_date, $html);

        $return = $order->return_date == "no return" ? "Sin Retorno" : $order->return_date;

        $html = str_replace("{{return_date}}", $return, $html);
        $html = str_replace("{{days}}", $days, $html);


        $id = $order->guardar();

        $html = str_replace("{{order_type}}", $_POST["type"], $html);
        $html = str_replace("{{order_id}}", $order->order_id, $html);
        $html = str_replace("{{id}}", $id, $html);

        $inv = Inventory::find($order->computer_id);
        $usr = Personal::find($order->user_id);
        $pers = Perifericos::findGroup($order->user_id);

        if ($post->type === "recepcion") {

            include "../includes/scripts/convert/recepcion.php";
        } else {


            echo json_encode([
                "msg" => enviarCorreo($html, "Orden Generada", [strtolower('jean.pr@goxpert.net')]) ?? "Message sent!!!"
            ]);
        }
        exit;
    }


    public static function sign(Router $router)
    {


        $id = validarID($_GET["id"]);



        $order = Ordenes::find($id);

        if ($order->state == "firmada") header("Location: /");

        $computer_id = filter_var($order->computer_id, FILTER_VALIDATE_INT);
        $user_id = filter_var($order->computer_id, FILTER_VALIDATE_INT);
        $emission_date = date("Y-m-d", strtotime($_POST["emitted-date"]));


        $cols = [
            "tipo",
            "marca",
            "modelo",
            "nombre_equipo",
            "serial",
            "observaciones",
        ];


        if (str_contains($order->order_id, "ODS")) $type = "salida";
        if (str_contains($order->order_id, "ODE")) $type = "entrega";
        if (str_contains($order->order_id, "ODR")) $type = "recepcion";





        $args = ["state" => "generada"];
        $order->sync($args);
        $eq = Inventory::find($order->computer_id);
        $usr = Personal::PIVOTFINDER($order->user_id);

        $pers = Perifericos::filter('user_id', '=', $order->user_id);

        $ftrs = json_decode($order->features);


        $router->render("pages/ordenes/orden", [
            "eq" => $eq,
            "usr" => $usr,
            "pers" => $pers,
            "order" => $order,
            "type" => $type,
            "ftrs" => $ftrs
        ]);
    }
}
