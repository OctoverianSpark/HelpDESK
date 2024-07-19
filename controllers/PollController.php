<?php

namespace Controllers;

use MVC\Router;

use Models\Encuestas;

class PollController{




    public static function index(Router $router){

        if($_GET["state"]){
            $encuestas=Encuestas::getJoinbyState(0,$_GET["state"]);
        }else{
            $encuestas = Encuestas::getJoin();
        }


        $router->render("admin/encuestas/index",[
            "encuestas"=>$encuestas
        ]);
    }





}







?>