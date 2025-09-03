<?php

namespace Controllers\LAPI;

use Models\Comments;
use Models\Users;

class API_Documentations
{

   public static function DOCUMENTATIONSEARCH()
   {

      $DATA = json_decode(file_get_contents("php://input"));

      $id = filter_var($DATA->id, FILTER_VALIDATE_INT);

      $documentation = Comments::history($id);

      echo json_encode($documentation);

      exit;
   }

   public static function DOCUMENTATIONCREATE()
   {

      $DATA = json_decode(file_get_contents("php://input"), true);



      $comment = new Comments($DATA);


      $comment->guardar();

      echo json_encode(["data" => $comment]);
      exit;
   }
}
