<?php


function conectarDB($schema = "ti"){
    $db = new mysqli("localhost","root","jprz28009301.",$schema,3306);
    return $db;
}



?>