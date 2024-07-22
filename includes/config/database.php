<?php


function conectarDB(){
    $db = new mysqli("192.104.1.11","HelpApp","","ti",3306);
    return $db;
}



?>