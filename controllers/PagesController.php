<?php


namespace Controllers;
//Router
use MVC\Router;

//Models
use Models\Tickets;
use Models\Encuestas;
use Models\Users;
use Models\Subcats;
use Models\Apps;
use Models\Inventario;
use Models\Perifericos;
use Models\Entradas;
use Models\Comments;
use Models\Notificaciones;



//Libs
use Intervention\Image\ImageManager as Manager;
use Intervention\Image\Drivers\Gd\Driver;
use Models\Inventory;
use Models\Ordenes;
use Models\Personal;

class PagesController{
    

    public static function index(Router $router){

        $ticket = Tickets::filter("usuario","=",$_SESSION["name"])?? [];
        $ticket = array_shift($ticket);

        if(!empty($tickets)){
            
            $encuestas = Encuestas::findPendingsByUser($tickets->id)??[];
        }
        $entradas = Entradas::all();
        
        $novedades = array_filter($entradas,function($entrada){
            return $entrada->tipo === "novedad";
        });
        $recomendaciones = array_filter($entradas,function($entrada){
            return $entrada->tipo === "recomendacion";
        });

        $router->render("pages/index",[
            "ticket"=>$ticket,
            "encuestas"=>$encuestas,
            "novedades"=>$novedades,
            "recomendaciones"=>$recomendaciones
        ]);

        
        


    }
    public static function crear(Router $router){
        
        $manager = new Manager(new Driver());

        $ticket = new Tickets;
        $inventario = ($_SESSION["log_type"]==="email")?Inventory::filter("usuarioPC","=",$_SESSION["username"]):Inventory::filter("correo_dominio","=",$_SESSION["username"]);
        $inventario =array_shift($inventario);
        

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $_POST["usuario"] = $_SESSION["name"];
            $_POST["fecha"] = date("Y-m-d H:i:s");

            $ticket = new Tickets($_POST);

            $ticket->tecnico_id = 0;
            
            if (!is_dir(CARPETA_IMAGENES)) {
                mkdir(CARPETA_IMAGENES);
            }
            
            

            $nombreImagen = md5(uniqid(rand(),true)) . ".png";

            if($_FILES["imagen"]["tmp_name"]){
                $image = $manager->read($_FILES["imagen"]["tmp_name"]);
                $image->resize(width: 300,height:300);


                $image->toPng()->save(CARPETA_IMAGENES . "/$nombreImagen");
                $ticket->setImagen($nombreImagen);

            }

            $resultado = $ticket->guardar();
            

            $notificacion =[
                "titulo"=>"Ticket Creado por " . $_SESSION["name"],
                "destinatario"=>"admin",
                "url"=>"/admin/tickets/ticket?id=$resultado"  
            ];
            notificacion();
            $notificaciones = new Notificaciones($notificacion);
            $notificaciones->guardar();

            
            header("Location: /tickets/ver?result=1");



        }





        $router->render("pages/tickets/crear",[
            "inventario"=>$inventario,
            "ticket" => $ticket,
        ]);
        


    }
    public static function tickets(Router $router){
        
        $tickets = Tickets::filter("usuario","=",$_SESSION["name"]);
        $resultado = $_GET["resultado"] ?? null;
        $router->render("pages/tickets/index",[
            "tickets"=>$tickets,
            "resultado"=>$resultado
        ]);
        


    }
    public static function ticket(Router $router){
        
        $id = validarID("");
        $tickets = Tickets::find($id);
        $comments = Comments::history($id);

        $router->render("pages/tickets/ticket",[
            "tickets"=>$tickets,
            "comments"=>$comments
        ]);
    }

    public static function equipos(Router $router){

        $equipos = ($_SESSION["log_type"]==="user")?Inventory::filter("usuarioPC","=",$_SESSION["username"]):Inventory::filter("correo_dominio","=",$_SESSION["username"]);
        
        
        
        
        $perifericos = [];
        foreach($equipos as $equipo){
            
            $perifericos[] = Perifericos::findGroup($equipo->id);
        }




        $router->render("pages/equipos/index",[
            "equipos" => $equipos,
            "perifericos"=>$perifericos,
        ]);

    }

    public static function encuesta(Router $router){





        $router->render("pages/tickets/encuesta",[
        ]);
    }


    public static function notificaciones(){
        

        header('Content-Type: application/json');

        $tecnico = Users::searchByName($_SESSION["name"]);

        

        if($tecnico){

            $notificaciones = Notificaciones::getAdminUnshowed($_SESSION["name"]);

        }else{

            $notificaciones = Notificaciones::getUnshowed($_SESSION["name"]);

        }
        
        $json= json_encode($notificaciones);

        echo $json;
        foreach($notificaciones as $notificacion){


            $not = new Notificaciones();

            $not->setShowed($notificacion->id);

        }
    }


    public static function ordenes(Router $router){

        
        
        $usrs = Personal::separateAll();
        $inv = Inventory::filter("user_id","!=","0");


        if($_SERVER["REQUEST_METHOD"] === "POST"){

            $orden = new Ordenes($_POST);

            $orderCount = count(Ordenes::filter("order_id","LIKE","ODS#%"));

            $orden->order_id = "ODS#" . ($orderCount === 0 ? 1 : ++$orderCount);
            $orden->state = "pendiente";
            $orden->emitted_date = date("Y-m-d",strtotime($orden->emitted_date));
            $orden->return_date = date("Y-m-d",strtotime($orden->return_date));
            

            $subject = "ORDEN DE SALIDA SOLICITADA";
            $body = file_get_contents(__DIR__ . "/../views/templates/mail/solicitud-orden.html");
            $body = str_replace("{{ return }}",date("d / m / Y",strtotime($orden->return_date)),$body);
            $body = str_replace("{{ emition }}",date("d / m / Y",strtotime($orden->emitted_date)),$body);
            $body = str_replace("{{ order_id }}",$orden->order_id,$body);
            $body = str_replace("{{ name }}",$_SESSION["name"],$body);

            $body = str_replace("{{ description }}",$orden->description,$body);
            


            $orden->guardar();

            // Send email logic here
            enviarCorreo(
                $body,
                $subject,
                ["ati@asistentevirtualsas.com"]
                
            );
            
            header("Location: /equipos?result=1");
            exit();


        }


        $router->render("pages/ordenes/index",[
            "usrs"=>$usrs[$_GET["sede"]],
            "inv"=>$inv
        ]);
    }



        
    


}



?>