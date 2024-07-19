<?php




namespace Controllers;

use Exception;
use MVC\Router;

use Models\Inventario;
use Models\Perifericos;
use Dompdf\Dompdf;


class  OrderController{




    public static function index(Router $router){
        
        $inventario = Inventario::all();

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            
            $equipo = Inventario::search(null,null,$_POST["computer"]);
            
            if(!$_POST["nombre"] === "same"){
                $equipo = Inventario::getInventory("nombre",$_POST["nombre"]);
            }

            try{
                $mail = conectarCorreo();
                
                $mail->setFrom("helperbot@asistentevirtualsas.com","EQUIPO DE ASISTENTE VIRTUAL");
    
                $mail->addAddress($equipo->correo);
    
                $url = "http://localhost:3000/orden?type=".$_POST["type"] . "&computer=" .$_POST["computer"]. "&nombre=".$_POST["nombre"];

                $mail->isHTML(true);
                $mail->Subject = 'Orden de ' . $_POST["type"];
                $mail->Body    = "Tienes una orden de salida, a continuacion accede a ella por medio del link que te compartimos abajo de este mensaje <br>". "<a href='$url' style='background-color:#4600ff;border:none;border-radius:2rem;color:#fff;display:inline-block;font-weight:600;margin-top:2.5rem;padding:1rem 3rem;text-align:center;text-decoration:none'>Ir a la orden</a>" ;
                
                
                $mail->send();

            }catch(Exception $e){
                debuguear($mail->ErrorInfo);
            }
        }
        

        $router->render("admin/inventario/ordenes/index",[
            "inventario"=>$inventario
        ]);
    }

    public static function orden(Router $router){

        $equipo = Inventario::search(null,null,$_GET["computer"]);
        $perifericos = Perifericos::findGroup($equipo->id);


        if($_SERVER["REQUEST_METHOD"] === "POST"){
            

            try{
                $mail = conectarCorreo();
                
                
                $mail->setFrom("helperbot@asistentevirtualsas.com","EQUIPO DE ASISTENTE VIRTUAL");
    
                $mail->addAddress("jean.pr@asistentevirtualsas.com");
    
                
                $mail->Subject = 'ORDEN DE ' . $_POST["nameSign"];
                $mail->Body    = 'La orden del asistente';

                $mail->send();

            }catch(Exception $e){
                debuguear($mail->ErrorInfo);
            }
        }

        $router->render("admin/inventario/ordenes/orden",[
            "equipo"=>$equipo,
            "perifericos" =>$perifericos 
        ]);
    }


}






?>