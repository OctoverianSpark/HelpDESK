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
            $inv->sync($_POST);



            $resultado  = $inv->guardar();


            if (isset($_POST["perifericos"])) {

                $existingPerifericos = array_column($perifericos, 'id');
                $postedPerifericos = array_column($_POST["perifericos"], 'id');

                $toDelete = array_diff($existingPerifericos, $postedPerifericos);
                $toAdd = array_diff($postedPerifericos, $existingPerifericos);


                foreach ($toDelete as $perId) {
                    $periferico = Perifericos::find($perId);
                    $periferico->eliminar();
                }

                

                foreach ($_POST["perifericos"] as $per) {
                    if (in_array($per['id'], $toAdd)) {
                        $periferico = new Perifericos($per);
                        $periferico->computer_id = $id;
                        $periferico->guardar();
                    } else {
                        $periferico = Perifericos::find($per['id']);
                        
                        $periferico->sync($per);
                        $periferico->guardar();
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
            "users"=>$users
        ]);
    }


    public static function actions(){

            
            
            $data = json_decode(file_get_contents("php://input"),true);

            
            $inv =Inventory::find($data["id"]);
            

            if($data["action"] === "stock") $inv->setStock();
            if($data["action"] === "delete") {

                $pers = Perifericos::filter("computer_id","=",$inv->id);

                foreach($pers as $per){
                    $per->eliminar();
                }

                $inv->eliminar();
            }

            echo json_encode(["msg"=>"1"]);
            exit;





    }


    public static function dashboard(Router $router){



        
        $router->render("/admin/inventario/dashboard");


    }


}
