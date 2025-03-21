<?php

namespace Controllers;

use MVC\Router;

use Models\Encuestas;
use Models\Users;

class PollController{




    public static function index(Router $router){


        $polls = Encuestas::all();



        $router->render("admin/encuestas/dashboard",[
        ]);
    }

    public static function show(Router $router){

        $polls = Encuestas::all();


        foreach($polls as $poll){
            $poll->individual_test = json_decode($poll->individual_test,true);
            $poll->general_test = json_decode($poll->general_test,true);
        }


        $router->render("admin/encuestas/index",[
            'polls' => $polls
        ]);
    }





}







?>