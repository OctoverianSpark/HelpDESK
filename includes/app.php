<?php


require "funciones.php";
require "config/mail.php";
require "config/database.php";
require __DIR__ . "/../vendor/autoload.php";



$db = conectarDB();
use Models\ActiveRecord;

ActiveRecord::setDB($db);




?>