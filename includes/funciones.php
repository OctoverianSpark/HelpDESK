<?php

use Models\Tecnicos;

define("CARPETA_IMAGENES",$_SERVER["DOCUMENT_ROOT"]."/referencias");
define("CARPETA_SRC",$_SERVER["DOCUMENT_ROOT"]."/blog");

function debuguear($dump){
    
    echo '<pre>';
    var_dump($dump);
    echo '</pre>';
    exit;
    

}


function s($html){
    $s = htmlspecialchars($html);
    return $s;
}


function mostrarNotificacion($resultado){
    $mensaje = "";
    switch ($resultado) {
        case 1:
            $mensaje = "Los Datos se han registrado correctamente";
            break;
        case 2:
            $mensaje = "Los datos fueron eliminados correctamente";
        case 3:
            $mensaje = "Los datos fueron actualizados correctamente";
        
        default:
            
            break;
    }
    return $mensaje;
    
}

function mostrarError($resultado){

    $mensaje = "";
    switch($resultado){

        case 1:
            $mensaje = "Ningun campo puede permanecer vacio";
            break;

        case 2:
            $mensaje = "Usuario / Contraseña Incorrecto/s";
            break;

        default:
            break;
    }

    return $mensaje;


}


function validarID(){
    $id = $_GET["id"];

    $id = filter_var($id,FILTER_VALIDATE_INT);

    if(!$id){
        header("Location: /");
    }else{
        return $id;
    }
}


function estaLogueado(){
    if(is_null($_SESSION["login"])){
        
        return false;
    }else{
        return true;
    }

}


function admin(){

    $tecnicos = Tecnicos::all();

    foreach($tecnicos as $tecnico){
        if($_SESSION["log_type"] == "email"){
            if($tecnico->correo == $_SESSION["email"]){
                $auth = true;
                break;
            }else{
                $auth = false;
                continue;   
            }
        }else{
            if($tecnico->correo == $_SESSION["username"] . "@asistentevirtualsas.com"){
                $auth = true;
                break;
            }else{
                $auth = false;
                continue;   
            }

        }

        

    }
    return $auth;



}


function fechaActual(){
    


    $fecha = new DateTime();
    $timestamp = $_SERVER["REQUEST_TIME"]; // Cambiar este valor según corresponda.
    $fecha->setTimestamp($timestamp);

    debuguear($fecha->format('Y-m-d H:i:s'));

}

?>