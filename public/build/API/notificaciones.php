<?php 

use Models\Notificaciones as notificaciones;


header('Content-Type: application/json');

$notificaciones = notificaciones::getUnshowed($_SESSION["name"]);


echo json_encode($notificaciones);


?>