<?php



namespace Controllers;


use MVC\Router;

use Models\Inventory;
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

        
        if($_SERVER["REQUEST_METHOD"] === "POST"){


            $inv = new Inventory($_POST);


            $id = $inv->guardar();


            foreach($_POST["perifericos"] as $per){

                $periferico = new Perifericos($per);

                $periferico->computer_id = $id;

                $periferico->guardar();
                

            }



        }


        $router->render("admin/inventario/crear", [
            "users"=>$users[$_GET["sede"]],
            "inv"=>$inv
        ]);
    }

    public static function actualizar(Router $router)
    {

        $id = validarID();
        $inv = Inventory::find($id);
        $perifericos = Perifericos::findGroup($id);
        $users = Personal::all();


        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $inv = $inv->sync($_POST);

            $_POST["inventario"]["id"] = $id;
            $per = new Perifericos($_POST["perifericos"]);


            $resultado  = $inv->guardar();


            if (isset($_POST["perifericos"])) {
                foreach ($_POST["perifericos"] as $periferico) {

                    $periferico["computer_id"] = $resultado;

                    $per = new Perifericos($periferico);

                    $per->eliminar();

                    $per->guardar();
                }
            }

            if ($resultado) {
                header("Location: /admin/inventario?result=1");
            }
        }

        $router->render("admin/inventario/actualizar", [
            "inv" => $inv,
            "perifericos" => $perifericos,
            "users"=>$users
        ]);
    }


    public static function actions(){

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            
            
            $data = json_decode(file_get_contents("php://input"),true);

            
            $inv =Inventory::find($data["id"]);
            

            if($data["action"] === "stock") $inv->setStock();
            if($data["action"] === "delete") $inv->eliminar();

            echo json_encode(["msg"=>"1"]);
            exit;



        }


    }
}
