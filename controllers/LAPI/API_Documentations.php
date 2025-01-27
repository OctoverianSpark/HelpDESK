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

         $DATA = json_decode(file_get_contents("php://input"),true);

         

         $comment = new Comments($DATA);


         $LOG_TYPE = $_SESSION["log_type"];
         
         if($LOG_TYPE == "user"){
            $USR = array_shift(Users::filter("ad_user","=",$_SESSION["username"]));
         }else{
            $USR = array_shift(Users::filter("mail","=",$_SESSION["email"]));

         }

         $comment->cargado_por = $USR->mail;

         $comment->guardar();

         echo json_encode(["data"=>$comment]);
         exit;
      }

   }













?>