<?php

use Models\Tecnicos;
use Models\Notificaciones as notificaciones;

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

    $tecnico = Tecnicos::searchByName($_SESSION["name"]);

    if($tecnico->cargo == "ATI"){
        $auth = true;
    }else{
        $auth = false;
    }


    return $auth;

}


function getCharge(){

    $tecnico = Tecnicos::searchByName($_SESSION["name"]);

    $_SESSION["charge"] = $tecnico->cargo;


}

function fechaActual(){
    


    $fecha = new DateTime();
    $timestamp = $_SERVER["REQUEST_TIME"]; // Cambiar este valor según corresponda.
    $fecha->setTimestamp($timestamp);

    debuguear($fecha->format('Y-m-d H:i:s'));

}

?>