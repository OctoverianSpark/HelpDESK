<?php




namespace Controllers;

use Dompdf\Canvas;
use Exception;
use MVC\Router;

use Models\Inventario;
use Models\Perifericos;
use Models\Ordenes;

use Dompdf\Dompdf;

class  OrderController{




    public static function index(Router $router){
        
        $inventario = Inventario::all();
        $ordenes = Ordenes::getAllFilters("estado",(!$_GET["state"] )? "pendiente" : $_GET["state"]);


        $router->render("admin/inventario/ordenes/index",[
            "inventario"=>$inventario,
            "ordenes"=>$ordenes
        ]);
    }

    public static function orden(Router $router){

        $id = validarID();

        $orden = Ordenes::find($id);

        $equipo = Inventario::getInventory("nombre_equipo",$orden->equipo);
        $equipo = array_shift( $equipo );
        $perifericos = Perifericos::findGroup($equipo->id);
        
        if($orden->estado !== "generada"){


            header("Location : /");
        }


        $router->render("admin/inventario/ordenes/orden",[
            "equipo"=>$equipo,
            "perifericos" =>$perifericos,
            "orden"=>$orden??""
        ]);
    
    
    }

    public static function crear(Router $router){

        $inventario = Inventario::all();



        if($_SERVER["REQUEST_METHOD"] === "POST"){

            

            $_POST["fecha_salida"] = str_replace("T", " " , $_POST["fecha_salida"]);
            $_POST["fecha_retorno"] = str_replace("T", " " , $_POST["fecha_retorno"]);
            $_POST["estado"] = "generada";
            $orden = new Ordenes($_POST);
            $orden->guardar();

            $id = $orden::getLastId();

            $html = file_get_contents("../views/templates/mail/orden-de-salida.html");


            $orderLink =  $_SERVER["HTTP_ORIGIN"] . "/orden?id=$id";

            $html = str_replace("{ {link} }",$orderLink,$html);
            $html = str_replace("{ {salida} }",$_POST["fecha_salida"],$html);
            $html = str_replace("{ {retorno} }",$_POST["fecha_retorno"],$html);

            $inventario = Inventario::getInventory("nombre_equipo",$_POST["equipo"]);
            $usuario = Inventario::getInventory("nombre",$_POST["nombre"]);
            $usuario = array_shift($usuario);
    
            enviarCorreo($html ,"Orden Generada",[$usuario->correo]);



        }


        $router->render("/admin/inventario/ordenes/crear",[
            "inventario"=>$inventario
        ]);



    }
    public static function print(Router $router){

        $id = validarID();
        $orden = Ordenes::find($id);
        $equipo = Inventario::getInventory("nombre_equipo",$orden->equipo);
        $equipo = array_shift( $equipo );
        $usuario = Inventario::getInventory("nombre",$orden->nombre);
        $usuario = array_shift( $usuario );


        $perifericos = Perifericos::findGroup($equipo->id);


        $router->render("pages/ordenes/orden",[
            "usuario"=>$usuario,
            "equipo"=>$equipo,
            "orden"=>$orden
        ]);


    }


}






?>