<?php


namespace Controllers;
//Router
use MVC\Router;

//Models
use Models\Tickets;
use Models\Encuestas;
use Models\Tecnicos;
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

class PagesController{
    

    public static function index(Router $router){


        $tickets = Tickets::findJoinbyUser($_SESSION["name"],1)?? [];
        $tickets = array_shift($tickets);

        if(!empty($tickets)){
            
            $encuestas = Encuestas::findPendingsByUser($tickets->id)??[];
        }
        $entradas = Entradas::randomizeEntries(2);
        $novedades = $entradas["novedades"] ;
        $recomendaciones = $entradas["recomendaciones"];

        $count = 0;
        

        $router->render("pages/index",[
            "tickets"=>$tickets,
            "encuestas"=>$encuestas,
            "novedades"=>$novedades,
            "recomendaciones"=>$recomendaciones,
            "count"=>$count
        ]);

        
        


    }
    public static function crear(Router $router){
        
        $manager = new Manager(new Driver());

        $ticket = new Tickets;
        $tecnicos  = Tecnicos::all();
        $inventario = Inventario::getInventory("nombre",$_SESSION["name"]);
        $inventario =array_shift($inventario);
        $selectedCat = $_GET["cat"] ?? null;
        $cats =["Red","Equipo","Aplicaciones"];
        $subcats = Subcats::getSubs($selectedCat);
        $allsubcats = Subcats::all();
        $limite = 3;
        $errores = Tickets::getErrores();
        $apps = Apps::all();   
        

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if($_POST["tickets"]["categoria"] === "Aplicaciones"){
                
                $_POST["tickets"]["subcategoria"] .= " (" . $_POST['tickets']['selected_app'] . ")";
            }  

            $_POST["tickets"]["usuario"] = $_SESSION["name"];

            $ticket = new Tickets($_POST["tickets"]);

            $errores = $ticket->validar();
            
            
            if (!is_dir(CARPETA_IMAGENES)) {
                mkdir(CARPETA_IMAGENES);
            }
            
            
            if (empty($errores)) {

                $notificacion =[
                    "titulo"=>"Ticket Creado por " . $_SESSION["name"],
                    "contenido"=>"Asunto: " . $_POST["tickets"]["subcategoria"],
                    "destinatario"=>"admin",
                    "url"=>$_SERVER["HTTP_HOST"] . "/admin/tickets" 
                ];

                $nombreImagen = md5(uniqid(rand(),true)) . ".png";

                if($_FILES["tickets"]["tmp_name"]["imagen"]){
                    $image = $manager->read($_FILES["tickets"]["tmp_name"]["imagen"]);
                    $image->resize(width: 300,height:300);


                    $image->toPng()->save(CARPETA_IMAGENES . "/$nombreImagen");
                    $ticket->setImagen($nombreImagen);

                }



                $ticket->guardar();
                notificacion();
                $notificaciones = new Notificaciones($notificacion);
                $notificaciones->guardar();

                
                header("Location: /tickets/ver?resultado=1");
            }



        }









        $router->render("pages/crear",[
            "inventario"=>$inventario,
            "tecnicos"=>$tecnicos,
            "subcats" => $subcats,
            "allsubcats"=>$allsubcats,
            "selectedCat"=>$selectedCat,
            "cats"=>$cats,
            "ticket" => $ticket,
            "errores" => $errores,
            "apps" => $apps,
            "limite"=>$limite
        ]);
        


    }
    public static function ver(Router $router){
        
        $tickets = Tickets::findJoinbyUser($_SESSION["name"]);
        $resultado = $_GET["resultado"] ?? null;
        $router->render("pages/ver",[
            "tickets"=>$tickets,
            "resultado"=>$resultado
        ]);
        


    }
    public static function ticket(Router $router){
        
        $id = validarID();
        $tickets = Tickets::findJoin($id);
        $comments = Comments::history($id);

        $router->render("pages/ticket",[
            "tickets"=>$tickets,
            "comments"=>$comments
        ]);
    }

    public static function equipos(Router $router){

        $equipos = Inventario::search($_SESSION["email"],$_SESSION["username"]);
        $perifericos = [];
        foreach($equipos as $equipo){
            
            $perifericos[] = Perifericos::findGroup($equipo->id);
        }

        





        $router->render("pages/equipos",[
            "equipos" => $equipos,
            "perifericos"=>$perifericos
        ]);

    }

    public static function encuesta(Router $router){




        $id =validarID();

        $encuesta = Encuestas::findJoin($id);
        $ticket= Tickets::findJoin($encuesta->ticket_id);
        
        
        if($encuesta->estado==="completada"){
            header("Location: /");

        }



        if($_SERVER["REQUEST_METHOD"] === "POST"){
            
            $_POST["encuesta"]["estado"] = "completada";
            $encuestas = new Encuestas($_POST["encuesta"]);

            $encuestas->guardar();

            header("Location: /");
        }

        $router->render("pages/encuesta",[
            "encuesta"=>$encuesta,
            "ticket"=>$ticket
        ]);
    }


    public static function notificaciones(){
        

        header('Content-Type: application/json');

        $tecnico = Tecnicos::searchByName($_SESSION["name"]);

        

        if($tecnico){

            $notificaciones = Notificaciones::getAdminUnshowed($_SESSION["name"]);

        }else{

            $notificaciones = Notificaciones::getUnshowed($_SESSION["name"]);

        }
        
        $json= json_encode($notificaciones);

        file_put_contents("build/json/notificaciones.json",$json);
        echo $json;
        foreach($notificaciones as $notificacion){


            $not = new Notificaciones();

            $not->setShowed($notificacion->id);

        }
    }



        
    


}



?>