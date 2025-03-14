<?php 






namespace Controllers;

use Models\Server;
use Models\Server_Users;
use MVC\Router;

class ServersController{


   public static function index(Router $router){


      $servers= Server::all();

      foreach ($servers as $server) {
         
         $server->users = Server_Users::filter("server_id","=",$server->id);

      }


      $router->render("admin/servers/index",[
         "servers"=>$servers
      ]);


   }



}








?>