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
      $pers = Perifericos::findGroup($inv->getID());
      $pers = array_map(function ($item) {
         return $item->toArray();
      }, $pers);

      $data = [
         "inv" => $inv->toArray() ?? [],
         "pers" => $pers ?? []
      ];


      echo json_encode($data);
   }

   public static function INVENTORY_GET()
   {


      $inv = Inventory::all();

      foreach ($inv as $eq) {



         if ($eq->getUserId() === "0") {
            $eq->setNombre("STOCK");
            $eq->setApellido("Sin asignar");
            $eq->setCorreo("Sin asignar");
            $eq->setTelefono("Sin asignar");
            continue;
         }

         $usr = Personal::PIVOTFINDER($eq->getUserId());

         $eq->area = $usr->area;
      }


      $inv = array_map(function ($item) {
         return $item->toArray();
      }, $inv);



      echo json_encode($inv);
   }
}
