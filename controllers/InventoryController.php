<?php



namespace Controllers;


use MVC\Router;

use Models\Inventario;
use Models\Perifericos;

class InventoryController{


    public static function index(Router $router){

        if($_GET["type"] && !$_GET["query"]==""){
            $equipos = Inventario::getInventory($_GET["type"],$_GET["query"]);

        }else{
            $equipos = Inventario::all();
        }




        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $inventario = new Inventario($_POST["equipo"]);

            $perifericos = new Perifericos;
            $perifericos->computer_id = $_POST["equipo"]["id"];

            
            $perifericos->deleteByGroup();
            $inventario->eliminar();


            header("Location: /admin/inventario?resultado=3");
        }


        $router->render("admin/inventario/index",[
            "equipos"=>$equipos
        ]);


    }

    public static function ver(Router $router){

        $id = validarID();

        $equipo = Inventario::find($id);

        $perifericos = Perifericos::findGroup($id);

        $router->render("admin/inventario/equipo",[
            "equipo" => $equipo,
            "perifericos" => $perifericos
        ]);
    }
    public static function crear(Router $router){


        if($_SERVER["REQUEST_METHOD"] === "POST"){

            $inventario = new Inventario($_POST["inventario"]);


            $errores = $inventario->validar();

            if(empty($errores)){
                $resultado = $inventario->guardar();
    
                $id = $inventario->search(null,null,$_POST["inventario"]["nombre_equipo"]);
    
                if(isset($_POST["perifericos"])){
                    foreach($_POST["perifericos"] as $periferico){
                        $periferico["computer_id"] = $id->id;
                        $perifericos = new Perifericos($periferico);
        
                        $perifericos->guardar();
                    }
                }
                if($resultado){
                    header("Location: /admin/inventario?resultado=1");
                }

                

            }

            















        }



        $router->render("admin/inventario/crear",[
            "errores"=>$errores,
            "inventario"=>$inventario,
            "perifericos"=>$perifericos,
        ]);


    }

    public static function actualizar(Router $router){

        $id = validarID();
        $inventario = Inventario::find($id);
        $perifericos = Perifericos::findGroup($id);


        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $_POST["inventario"]["id"] = $id;
            $inv = new Inventario($_POST["inventario"]);
            $per = new Perifericos($_POST["perifericos"]);


            
            $errores = $inventario->validar();

            if(empty($errores)){
                
                $resultado  = $inv->guardar();
    
    
                if(isset($_POST["perifericos"])){
                    foreach($_POST["perifericos"] as $periferico){
                        
                        $periferico["computer_id"] = $id;

                        $per = new Perifericos($periferico);

                        $per->eliminar();

                        $per->guardar();
                        }
        
                    }
                }

                if($resultado){
                    header("Location: /admin/inventario?resultado=1");
                }

            }

        $router->render("admin/inventario/actualizar",[
            "inventario" => $inventario,
            "perifericos" => $perifericos
        ]);
    }








}




?>