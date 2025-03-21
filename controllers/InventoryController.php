<?php



namespace Controllers;


use MVC\Router;

use Models\Inventory;
use Models\Log;
use Models\Perifericos;
use Models\Personal;

class InventoryController
{


    public static function index(Router $router)
    {

        if ($_GET["type"] && !$_GET["query"] == "") {
            $equipos = Inventory::filter($_GET["type"], "=", $_GET["query"]);
        } else {
            $equipos = Inventory::all();
        }








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


        $users = Personal::separateAll();
        $log = new Log();


        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $inv = new Inventory($_POST);

            if(!empty(Inventory::filter("nombre_equipo","=",$inv->nombre_equipo))){

                header("Location: /admin/inventario/crear?err=4");
                exit;

            }

            $id = $inv->guardar();
            $log->newInventoryLog($id);



            foreach ($_POST["perifericos"] as $per) {

                $periferico = new Perifericos($per);

                $periferico->computer_id = $id;

                $periferico->guardar();
            }
        }


        $router->render("admin/inventario/crear", [
            "users" => $users[$_GET["sede"]],
            "inv" => $inv
        ]);
    }

    public static function actualizar(Router $router)
    {

        $id = validarID();
        $inv = Inventory::find($id);
        $perifericos = Perifericos::findGroup($id);
        $users = Personal::all();


        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $inv->sync($_POST);



            $resultado  = $inv->guardar();

            $log = new Log();

            $log->updateInventoryLog($resultado);

            if (isset($_POST["perifericos"])) {

                $existingPerifericos = array_column($perifericos, 'id');
                $postedPerifericos = array_column($_POST["perifericos"], 'id');

                $toDelete = array_diff($existingPerifericos, $postedPerifericos);
                $toAdd = array_diff($postedPerifericos, $existingPerifericos);


                foreach ($toDelete as $perId) {
                    $periferico = Perifericos::find($perId);
                    $periferico->eliminar();
                    $log->delPerLog($periferico);
                }


                foreach ($_POST["perifericos"] as $per) {

                    if($per["id"]){
                        $periferico = Perifericos::find($per['id']);
                        $periferico->sync($per);
                        $log->updatePerLog(Perifericos::find($periferico->id), $periferico);
                        $periferico->guardar();

                    }else{
                    
                        $periferico = new Perifericos($per);
                        $periferico->computer_id = $id;
                        $perId = $periferico->guardar();
                        $log->newPerLog($perId);

                    }
                }
            }

            if ($resultado) {
                header("Location: /admin/inventario?result=1");
            }
        }

        $router->render("admin/inventario/actualizar", [
            "inv" => $inv,
            "perifericos" => $perifericos,
            "users" => $users
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
        $stock = Inventory::filter("user_id", "=", "0");
        $asigned = Inventory::filter("NOT user_id", "=", "0");



        $router->render("/admin/inventario/dashboard", [
            "inv" => $inv,
            "stock" => $stock,
            "asigned" => $asigned
        ]);
    }
}
