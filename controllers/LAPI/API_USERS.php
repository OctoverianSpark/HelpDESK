<?php 


namespace Controllers\LAPI;

use Models\Users;

class API_USERS{





   public static function USERSEARCH(){


      $DATA = json_decode(file_get_contents("php://input"));


      $id = filter_var($DATA->id,FILTER_VALIDATE_INT);


      $user = Users::find($id);


      echo json_encode($user);



   }

   public static function USERS_SAVE(){



      $DATA = json_decode(file_get_contents("php://input"));

      
      if ($DATA->id) {
         
         $usr = Users::find($DATA->id);

         $usr->sync($DATA);

      }else{
         $usr = new Users((array)$DATA);


      }


      $id = $usr->guardar();

      $usr->id = $id;
      
      

      echo json_encode($usr);



   }

   public static function USER_DELETE(){



      $DATA = json_decode(file_get_contents("php://input"));

      $usr = Users::find($DATA->id);

      $usr->eliminar();


      echo json_encode(["msg"=>"Datos Eliminados"]);

   }


}








?>