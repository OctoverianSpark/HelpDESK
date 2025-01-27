<?php 




   namespace Controllers\LAPI;

   use Models\Inventory;
   use Models\Perifericos;

   class API_Inventory{



      public static function PERSSEARCH(){

            $DATA = json_decode(file_get_contents("php://input"));

            $id = filter_var($DATA->computer_id,FILTER_VALIDATE_INT);

            $pers = Perifericos::findGroup($id);

            echo json_encode($pers);
            exit;

      }

      public static function INVENTORYSEARCH(){

         $DATA = json_decode(file_get_contents("php://input"));

         $id = filter_var($DATA->id,FILTER_VALIDATE_INT);


         $inv = Inventory::find($id);
         $pers = Perifericos::findGroup($inv->id);

         $data = [
            "inv"=>$inv??[],
            "pers"=>$pers??[]
         ];


         echo json_encode($data);


      }
   }






?>