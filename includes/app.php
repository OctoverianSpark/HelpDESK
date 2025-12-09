<?php
header('Content-Type: text/html; charset=UTF-8');


require "funciones.php";
require "components/inputs.php";
require "config/mail.php";
require "config/drive.php";
require "config/database.php";
require "config/webhook_calls.php";
require __DIR__ . "/../vendor/autoload.php";

define("BUILD_ROUTE", __DIR__ . "\\..\\public\\build");


use Models\ActiveRecord;
use Models\Log;

ActiveRecord::setDB();

$log = new Log();
