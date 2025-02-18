<?php


require "funciones.php";
require "components/inputs.php";
require "config/mail.php";
require "config/drive.php";
require "config/database.php";
require __DIR__ . "/../vendor/autoload.php";

define("BUILD_ROUTE",__DIR__ . "\\..\\public\\build");


use Models\ActiveRecord;
ActiveRecord::setDB();





?>