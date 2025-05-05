<?php




namespace Controllers\LAPI;

use Models\Inventory;
use Models\Perifericos;
use Models\Personal;

class API_Inventory
{



   public static function SET_STOCK()
   {

      $DATA = json_decode(file_get_contents("php://input"));


      $id = filter_var($DATA->id, FILTER_VALIDATE_INT);


      $computer = Inventory::find($id);

      $computer->user_id = 0;

      $computer->guardar();
   }

   public static function PERSSEARCH()
   {

      $DATA = json_decode(file_get_contents("php://input"));

      $id = filter_var($DATA->computer_id, FILTER_VALIDATE_INT);

      $pers = Perifericos::findGroup($id);

      echo json_encode($pers);
      exit;
   }

   public static function INVENTORYSEARCH()
   {

      $DATA = json_decode(file_get_contents("php://input"));

      $id = filter_var($DATA->id, FILTER_VALIDATE_INT);


      $inv = Inventory::find($id);
      $pers = Perifericos::findGroup($inv->id);

      $data = [
         "inv" => $inv ?? [],
         "pers" => $pers ?? []
      ];


      echo json_encode($data);
   }

   public static function INVENTORY_GET()
   {


      $inv = Inventory::all();

      foreach ($inv as $eq) {



         if ($eq->user_id === "0") {
            $eq->nombre = 'STOCK';
            $eq->apellido = 'STOCK';
            $eq->correo = 'STOCK';
            $eq->area = 'STOCK';
            continue;
         }

         $usr = Personal::PIVOTFINDER($eq->user_id, $eq->sede);

         $eq->area = $usr->area;
      }


      echo json_encode($inv);
   }
}
