<?php



namespace Controllers;

use Models\Apps;
use MVC\Router;
use Models\Tickets;
use Models\Users;
use Models\Inventario;
use Models\Comments;
use Models\Encuestas;
use Models\Notificaciones;
use Models\Subcats;

class TicketController{




    public static function index(Router $router){


        $tickets = Tickets::all();
        $tecnicos = Users::filter("area","=","ATI");
        
        $router->render("admin/tickets/index",[
            "tickets" => $tickets,
            "tecnicos"=> $tecnicos
        ]);
    }


    public static function options(){

    }


    public static function ticket(Router $router){
        $id = validarID();

        $tickets = Tickets::find($id);

        $tecnicos = Tecnicos::getTecnicals();
        $subcats = Subcats::getSubs($tickets->categoria);
        $apps = Apps::all();
        $usuario = Inventario::getInventory("nombre",$tickets->usuario);
        
        $usuario = array_shift( $usuario );

        $comentarios = Comments::history($id);

        $notificacion = null;

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            
            if(isset($_POST["comentarios"])){
                
                $_POST["comentarios"]["usuario"] = $_SESSION["name"];
                $comentario = new Comments($_POST["comentarios"]);

                $comentario->guardar();


                $notificacion = [
                    "titulo" =>"Han actualizado tu ticket",
                    "contenido"=>"Tu tarea ha recibido un comentario",
                    "destinatario"=>$tickets->usuario,
                    "url"=>"/ticket?id=".$id
                ];
                $notificaciones = new Notificaciones($notificacion);
                $notificaciones->guardar();

                header("Location: /admin/tickets/ticket?id=" . $tickets->id ,true);
                

            }
            if(isset($_POST["tickets"])){
                
                $notificacion["id"]= null;


                $tecnico = Tecnicos::find($_POST["tickets"]["tecnico_id"]);
                
                if($tickets->categoria == "Aplicaciones"){
                    
                    $_POST["tickets"]["subcategoria"] .= " (" . $_POST['tickets']['selected_app'] . ")";
                }  
                switch($tickets->estado){


                    case "sin asignar":



                        break;
                    case "en proceso":
                        if($tickets->estado =="sin asignar"){

                            
                                
                            $_POST["tickets"]["fecha_asignada"] = date("Y-m-d h:i:s");
                            $asignTime = (strtotime($_POST["tickets"]["fecha_asignada"]) - (strtotime($tickets->fecha))) /1000;
                            $asignTime =  ($asignTime <0)?$asignTime * -1:$asignTime *1;
                            $_POST["tickets"]["tiempo_en_asignar"] = $asignTime;
                        }else{

                            
                            $_POST["tickets"]["fecha_asignada"] = null;
                            $_POST["tickets"]["tiempo_en_asignar"] = 0;
                        }


                        $notificacion =[
                            "id"=>null,
                            "titulo"=>"Ticket Asignado",
                            "contenido"=>"El tecnico asignado a tu ticket fue " . $_POST["tickets"]["tecnico_asignado"],
                            "destinatario"=>$_POST["tickets"]["usuario"],
                            "url"=>"/ticket?id=".$id
                        ];

                        break;
                    case "pendiente":

                        if($tickets->estado === "sin asignar"){
                            $_POST["tickets"]["fecha_pendiente"] = date("Y-m-d h:i:s");
                            $pendingTime = (strtotime($_POST["tickets"]["fecha_pendiente"]) - (strtotime($tickets->fecha))) /1000;
                            $pendingTime =  ($pendingTime <0)?$pendingTime * -1:$pendingTime *1;
                            $_POST["tickets"]["tiempo_en_asignar"] = $pendingTime;

                            
                        }else if($tickets->estado === "en proceso"){
                            $_POST["tickets"]["fecha_pendiente"] = date("Y-m-d h:i:s");
                            $pendingTime = (strtotime($_POST["tickets"]["fecha_pendiente"]) - (strtotime($tickets->fecha_asignada))) /1000;
                            $pendingTime = ($pendingTime <0)?$pendingTime * -1:$pendingTime *1;
                            $_POST["tickets"]["tiempo_en_pendiente"] = $pendingTime;
                            
                        }

                        $notificacion =[
                            "id"=>null,
                            "titulo"=>"Ticket Suspendido",
                            "contenido"=>"El ticket fue suspendido, entra a la vista detallada para validar la razon de la suspension",
                            "destinatario"=>$_POST["tickets"]["usuario"],
                            "url"=>"/ticket?id=".$id
                        ];
                        break;
                    case "completado":
                        
                        $_POST["tickets"]["fecha_completacion"] = date("Y-m-d h:i:s");

                        if($tickets->estado === "en proceso"){
                            $completedTime = (strtotime(date("Y-m-d h:i:s")) - (strtotime($tickets->fecha_asignada))) /1000;
                            $completedTime = (strtotime($tickets->fecha_asignada)-strtotime(date("Y-m-d h:i:s")) ) /1000;
                            $completedTime =  ($completedTime <0)?$completedTime * -1:$completedTime *1;
                            $_POST["tickets"]["tiempo_en_completar"] = $completedTime;
                        
                            
                        }else if($tickets->estado === "pendiente"){
                            
                            $completedTime = (strtotime($_POST["tickets"]["fecha_completacion"]) - (strtotime($tickets->fecha_pendiente))) /1000;
                            $completedTime = ((strtotime($tickets->fecha_asignada)-strtotime(date("Y-m-d h:i:s")) )) /1000;
                            $completedTime =  ($completedTime <0)?$completedTime * -1:$completedTime *1;
                            $_POST["tickets"]["tiempo_en_completar"] = $completedTime;

                        }else if($tickets->estado === "sin asignar"){
                           
                            $completedTime = (strtotime($_POST["tickets"]["fecha_completacion"]) - (strtotime($tickets->fecha))) /1000;
                            $completedTime =  ($completedTime <0)?$completedTime * -1:$completedTime *1;
                            $_POST["tickets"]["tiempo_en_completar"] = $completedTime;
                       
                        }
                        
                        $notificacion =[
                            "id"=>null,
                            "titulo"=>"Ticket Completado",
                            "contenido"=>"El ticket fue completado, entra a el para realizar la encuesta de satisfaccion",
                            "destinatario"=>$_POST["tickets"]["usuario"],
                            "url"=>"/ticket?id=".$id
                        ];

                        $_POST["encuesta"]["ticket_id"] = $id;
                        $encuesta = new Encuestas($_POST["encuesta"]);
                        $encuesta->guardar();
                        
                        break;
                        
                        
                    default:
                        break;
                        
                    }
                    
                    
                    
                    
                    
                    
                    
                    $ticket = new Tickets($_POST["tickets"]);
                    
                    
                    $ticket->guardar();
                    $notificaciones = new Notificaciones($notificacion);
                    $notificaciones->guardar();

                
                if($_POST["tickets"]["estado"] === "en proceso"){
                    asignado($tecnico,$tickets);
                }
                notificacion($_POST["tickets"],$tecnico,$usuario,$comentarios);









                header("Location: /admin/tickets/ticket?id=" . $tickets->id ,true);
            }

            
        }

        $router->render("admin/tickets/ticket",[
            "tickets"=>$tickets,
            "tecnicos" => $tecnicos,
            "comentarios" => $comentarios,
            "subcats"=>$subcats,
            "apps" => $apps
        ]);
    }


    public static function dashboard(Router $router){




        $router->render("admin/tickets/dashboard");

    }




}








?>