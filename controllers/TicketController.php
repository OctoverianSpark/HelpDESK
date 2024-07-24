<?php



namespace Controllers;



use MVC\Router;
use Models\Tickets;
use Models\Tecnicos;
use Models\Inventario;
use Models\Comments;
use Models\Encuestas;

class TicketController{




    public static function index(Router $router){


        $tickets = Tickets::filter($_GET["type"],$_GET["query"]);
        $tecnicos = Tecnicos::all();
        $router->render("admin/tickets/index",[
            "tickets" => $tickets,
            "tecnicos"=>$tecnicos
        ]);
    }


    public static function options(){

    }


    public static function ticket(Router $router){
        $id = validarID();

        $tickets = Tickets::find($id);

        $tecnicos = Tecnicos::all();

        $usuario = Inventario::getInventory("nombre",$tickets->usuario);
        
        $usuario = array_shift( $usuario );

        $comentarios = Comments::history($id);




        if($_SERVER["REQUEST_METHOD"] === "POST"){
            if(isset($_POST["comentarios"])){
                
                $_POST["comentarios"]["cargado_por"] = $_SESSION["name"];
                $comentario = new Comments($_POST["comentarios"]);

                $comentario->guardar();


                header("Location: /admin/tickets/ticket?id=" . $tickets->id ,true);
                


            }
            if(isset($_POST["tickets"])){
                

                $tecnico = Tecnicos::find($_POST["tickets"]["tecnico_id"]);
                switch($_POST["tickets"]["estado"]){


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


                        break;
                    case "pendiente":

                        if($tickets->estado === "sin asignar"){
                            $_POST["tickets"]["fecha_pendiente"] = null;
                            $_POST["tickets"]["tiempo_en_pendiente"] = 0;
                            
                        }else if($tickets->estado === "en proceso"){
                            $_POST["tickets"]["fecha_pendiente"] = date("Y-m-d h:i:s");
                            $pendingTime = (strtotime($_POST["tickets"]["fecha_pendiente"]) - (strtotime($tickets->fecha_asignada))) /1000;
                            $pendingTime = ($pendingTime <0)?$pendingTime * -1:$pendingTime *1;
                            $_POST["tickets"]["tiempo_en_pendiente"] = $pendingTime;
                            
                        }



                        break;
                    case "completado":


                        if($tickets->estado === "en proceso"){
                            $_POST["tickets"]["fecha_completacion"] = date("Y-m-d h:i:s");
                            $completedTime = (strtotime(date("Y-m-d h:i:s")) - (strtotime($tickets->fecha_asignada))) /1000;
                            $completedTime = ((strtotime($tickets->fecha_asignada)-strtotime(date("Y-m-d h:i:s")) )) /1000;
                            $completedTime =  ($completedTime <0)?$completedTime * -1:$completedTime *1;
                            $_POST["tickets"]["tiempo_en_completar"] = $completedTime;
                        
                            
                        }else if($tickets->estado === "pendiente"){
                            
                            $_POST["tickets"]["fecha_completacion"] = date("Y-m-d h:i:s");
                            $completedTime = (strtotime($_POST["tickets"]["fecha_completacion"]) - (strtotime($tickets->fecha_pendiente))) /1000;
                            $completedTime = ((strtotime($tickets->fecha_asignada)-strtotime(date("Y-m-d h:i:s")) )) /1000;
                            $completedTime =  ($completedTime <0)?$completedTime * -1:$completedTime *1;
                            $_POST["tickets"]["tiempo_en_completar"] = $completedTime;
                        }

                        $_POST["encuesta"]["ticket_id"] = $id;
                        $encuesta = new Encuestas($_POST["encuesta"]);


                        $encuesta->guardar();

                        break;


                    default:
                        break;
                    
                }
                






                $ticket = new Tickets($_POST["tickets"]);
                $ticket->guardar();

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
            "comentarios" => $comentarios
        ]);
    }


    public static function actualizar(Router $router){

    }




}








?>