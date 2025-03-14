<?php 



namespace Controllers\LAPI;

use Models\Server;
use Models\Server_Users;

class API_SERVERS{





   public static function FIND_USERS(){


      $data = json_decode(file_get_contents("php://input"));

      $user = Server_Users::find($data->id);

      $server = Server::find($user->server_id);


      echo json_encode(["user"=>$user,"server"=>$server]);




   }

   public static function SAVE_USERS(){

      $data = json_decode(file_get_contents("php://input"),true);


      if($data["id"] != "") {
         $user = Server_Users::find($data["id"]);
         $data["updated_at"] = Date("Y-m-d H:i:s");
         $user->sync($data);
      }else{
         $data["created_at"] = Date("Y-m-d H:i:s");
         $data["updated_at"] = Date("Y-m-d H:i:s");

         $user = new Server_Users($data);

         $server= Server::find($user->server_id);

         $server->users_in_use += 1;
         $server->guardar();
         
      }


      $user->guardar();

      echo json_encode(["msg"=>"Guardado Completo!!!"]);
      exit;

   }
   public static function DELETE_USERS(){


      $data = json_decode(file_get_contents("php://input"));


      $user = Server_Users::find($data->id);

      $server = Server::find($user->server_id);

      $server->users_in_use -= 1;

      $user->eliminar();

      $server->guardar();

      echo json_encode($user);




   }


   public static function SAVE_SERVER(){


      $data = json_decode(file_get_contents("php://input"),true);



      if ($data["id"] != "") {
         $server = Server::find($data["id"]);
         $server->sync($data);
      }
      else $server = new Server($data);


      $server->guardar();


      echo json_encode(["msg"=>"Actualizacion Completada"]);

   }

   public static function FIND_SERVER(){


      $data = json_decode(file_get_contents("php://input"));


      $server = Server::find($data->id);


      

      echo json_encode($server);




   }
   public static function DELETE_SERVER(){


      $data = json_decode(file_get_contents("php://input"));


      $server = Server::find($data->id);


      $server->eliminar();


      echo json_encode($server);




   }









}


?>