<?php


function conectarDB(){
    $db = new mysqli("localhost","root","jprz28009301.","ti",3306);
    return $db;
}



?>