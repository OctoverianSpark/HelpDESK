<?php




namespace Controllers;

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

        if($_SERVER["REQUEST_METHOD"] === "POST"){

            $mail = conectarCorreo();
            if($_POST["orderType"] === "manual"){

                if($_POST["nombre"] === "same"){

                    $equipo = Inventario::getInventory("nombre_equipo",$_POST["computer"]);


                }else if($_POST["nombre"] !=="same"){
                    $equipo = Inventario::getInventory("nombre",$_POST["nombre"]);

                }

                $equipo = array_shift($equipo);
                $url = $_SERVER["HTTP_ORIGIN"] . "/orden?type=".$_POST["type"]."&computer=". $_POST["computer"] ."&nombre=".$_POST["nombre"];


            }else if($_POST["orderType"] === "request"){


                $orden = Ordenes::getAllFilters("id",$_POST["orders"]["id"]);
                $orden = array_shift($orden);
                
                $equipo = Inventario::getInventory("nombre",$orden->nombre);

                $equipo = array_shift($equipo);


                $_POST["orders"]["estado"] = "generada";

                $orders = new Ordenes($_POST["orders"]);
                $url = $_SERVER["HTTP_ORIGIN"] . "/orden?id=$orden->id";
                
                $orders->guardar();
            }


            $mail->addAddress($equipo->correo);

            $mail->isHTML();

            $mail->Subject = "Orden de " . ucwords((!$_POST["type"]) ? $orden->tipo : $_POST["type"]) . " Generada 👋" ;

            $mail->Body = "<h1>Tu orden ha sido generada</h1>";

            $mail->Body .= "<h2>Para verificar la orden de ". ucwords((!$_POST["type"]) ? $orden->tipo : $_POST["type"]) ."y firmarla debes acceder al siguiente link</h2>";

            $mail->Body .= "<a href=". "'$url'"  . "style='background-color:#4600ff;border:none;border-radius:2rem;color:#fff;display:inline-block;font-weight:600;margin-top:2.5rem;padding:1rem 3rem;text-align:center;text-decoration:none'>Ir a mi orden</a>";
            $mail->Body .= "<br>";

            $mail->send();


            header("Location : /admin/inventario/ordenes");



        }
        

        $router->render("admin/inventario/ordenes/index",[
            "inventario"=>$inventario,
            "ordenes"=>$ordenes
        ]);
    }

    public static function orden(Router $router){


        if(!$_GET["id"]){
            $equipo = Inventario::search(null,null,$_GET["computer"]);
            $perifericos = Perifericos::findGroup($equipo->id);

        }else{
            $id = validarID();
            $orden = Ordenes::find($id);
            if($orden->estado !== "generada" ){
                header("Location: /");
            }
            $equipo = Inventario::getInventory("nombre_equipo",$orden->equipo);
            $equipo = array_shift($equipo);
            $perifericos = Perifericos::findGroup($equipo->id);
        }


        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $html = "<html>" . file_get_contents('../includes/templates/orden.php');
            $css =file_get_contents('build/css/app.css');
            $html = $html . "<style>$css</style></html>";
            $html = str_replace("{ {name} }",$_POST["nameSign"],$html);
            $html = str_replace("{ {fecha} }",date("d / m / Y"),$html);

            $path = 'build/img/LOGO.png';
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);




            $html = str_replace("{ {imagen} }",$base64,$html);


            // reference the Dompdf namespace


            // instantiate and use the dompdf class
            $dompdf = new Dompdf();
            $options = $dompdf->getOptions();
            $options->set('defaultFont', 'Helvetica');
            $options->setIsPhpEnabled(true);
            $dompdf->setOptions($options);
            $dompdf->loadHtml($html);

            // (Optional) Setup the paper size and orientation
            $dompdf->setPaper('letter', 'portrait');

            // Render the HTML as PDF
            $dompdf->render();

            // Output the generated PDF to Browser
            $dompdf->stream("Orden.pdf",[
                "Attachment"=>false
            ]);

        }

        $router->render("admin/inventario/ordenes/orden",[
            "equipo"=>$equipo,
            "perifericos" =>$perifericos,
            "orden"=>$orden??""
        ]);
    }


}






?>