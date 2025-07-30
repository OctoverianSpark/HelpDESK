<?php



namespace Controllers;


use MVC\Router;

use Models\Inventory;
use Models\Log;
use Models\Perifericos;
use Models\Personal;
use Models\Users;

class InventoryController
{


    public static function index(Router $router)
    {


        $equipos = Inventory::filter('state', '=', $_GET['state'] ?? 1);



        $router->render("admin/inventario/index", [
            "equipos" => $equipos
        ]);
    }

    public static function ver(Router $router)
    {

        $id = validarID();

        $equipo = Inventory::find($id);

        $perifericos = Perifericos::findGroup($id);






        $router->render("admin/inventario/equipo", [
            "equipo" => $equipo,
            "perifericos" => $perifericos
        ]);
    }

    public static function crear(Router $router)
    {


        $users = Personal::all();
        $log = new Log();


        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $inv = new Inventory($_POST);

            $id = $inv->guardar();
            $log->newInventoryLog($id);



            foreach ($_POST["perifericos"] as $per) {

                $periferico = new Perifericos($per);

                $periferico->user_id = $inv->user_id;

                $periferico->guardar();
            }
        }


        $router->render("admin/inventario/crear", [
            "users" => $users,
            "inv" => $inv
        ]);
    }

    public static function actualizar(Router $router)
    {

        $id = validarID();
        $inv = Inventory::find($id);
        $perifericos = Perifericos::filter('user_id', '=', $inv->getUserId());
        $users = Personal::all();

        $techs = Users::getTecnicals();



        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $inv->sync($_POST);


            $resultado  = $inv->guardar();

            $log = new Log();

            $log->updateInventoryLog($resultado);

            if (isset($_POST["perifericos"])) {

                $existingPerifericos = array_column($perifericos, 'id');
                $postedPerifericos = array_column($_POST["perifericos"], 'id');

                $toDelete = array_diff($existingPerifericos, $postedPerifericos);
                foreach ($toDelete as $id) {
                    $periferico = Perifericos::find($id);

                    if ($periferico) {
                        $periferico->state = 0;
                        $periferico->user_id = null;
                        $periferico->asign_date = null;


                        $periferico->guardar();
                        $log->updatePerLog(Perifericos::find($id), $periferico);
                    }
                }


                foreach ($_POST["perifericos"] as $per) {

                    if ($per["id"]) {
                        $periferico = Perifericos::find($per['id']);
                        $periferico->sync($per);
                        $log->updatePerLog(Perifericos::find($periferico->id), $periferico);
                        $periferico->guardar();
                    } else {

                        $periferico = new Perifericos($per);
                        $periferico->user_id = $inv->user_id;
                        $periferico->state = 1;
                        $per->asign_date = date('Y-m-d H:i:s');

                        $perId = $periferico->guardar();
                        $log->newPerLog($perId);
                    }
                }
            } else {
                foreach ($perifericos as $per) {
                    $per->state = 0;
                    $per->user_id = null;
                    $per->asign_date = null;

                    $per->guardar();
                    $log->updatePerLog(Perifericos::find($per->id), $per);
                }
            }

            if ($resultado) {
               header("Location: /admin/inventario?result=1");
            }
        }


        $router->render("admin/inventario/actualizar", [
            "inv" => $inv,
            "perifericos" => $perifericos,
            "users" => $users,
            'techs' => $techs
        ]);
    }


    public static function actions()
    {



        $data = json_decode(file_get_contents("php://input"), true);


        $inv = Inventory::find($data["id"]);
        $log = new Log();


        if ($data["action"] === "stock") {
            $inv->setStock();
            $log->updateInventoryLog($data->id);
        }
        if ($data["action"] === "delete") {

            $pers = Perifericos::filter("computer_id", "=", $inv->id);

            foreach ($pers as $per) {
                $per->eliminar();
            }


            $inv->eliminar();

            $log->deleteInventoryLog($data->id);
        }

        echo json_encode(["msg" => "1"]);
        exit;
    }


    public static function dashboard(Router $router)
    {

        $inv = Inventory::all();
        $stock = Inventory::filter("state", "=", "0");
        $asigned = Inventory::filter("state", "=", "1");



        $router->render("/admin/inventario/dashboard", [
            "inv" => $inv,
            "stock" => $stock,
            "asigned" => $asigned
        ]);
    }
}
