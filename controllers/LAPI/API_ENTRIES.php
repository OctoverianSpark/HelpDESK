<?php 



namespace Controllers\LAPI;

use Models\Entradas;

class API_ENTRIES{

   public static function SETSHOWED(){

      $post = json_decode(file_get_contents("php://input"));

      
      $entry = Entradas::find($post->id);

      $entry->sync(["mostrar"=>$post->mostrar]);

      $entry->guardar();

      echo json_encode(["msg"=>$entry]);
   
      

   }


   public static function FIND_ENTRY(){

      $post = json_decode(file_get_contents("php://input"));

      $entry = Entradas::find($post->id);

      echo json_encode($entry);

      exit;


   }


   public static function SAVE_ENTRY(){
      $post = json_decode(file_get_contents("php://input"),true);

      $id = filter_var($post["id"],FILTER_VALIDATE_INT);
      $entry = new Entradas($post);

      if($id){
         $entry = Entradas::find($id);


         $entry->sync($post);


      }

      $entry->guardar();


      echo json_encode(["success"=>true]);

      exit;


   }

   public static function DELETE_ENTRY(){
      $post = json_decode(file_get_contents("php://input"),true);

      $id = filter_var($post["id"],FILTER_VALIDATE_INT);

      $entry = Entradas::find($id);


      $entry->eliminar();

      echo json_encode(["success"=>true]);

      exit;




      exit;


   }


}