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


      $computer->setStock();

      echo json_encode(["msg" => "1"]);
      exit;
   }
   public static function DELETE_COMPUTER()
   {

      $DATA = json_decode(file_get_contents("php://input"));


      $id = filter_var($DATA->id, FILTER_VALIDATE_INT);


      $computer = Inventory::find($id);


      $computer->eliminar();

      echo json_encode(["msg" => "1"]);
      exit;
   }

   public static function PERSSEARCH()
   {

      $DATA = json_decode(file_get_contents("php://input"));

      $id = filter_var($DATA->user_id, FILTER_VALIDATE_INT);

      $pers = Perifericos::findGroup($id);

      echo json_encode($pers);
      exit;
   }

   public static function INVENTORYSEARCH()
   {

      $DATA = json_decode(file_get_contents("php://input"));

      $id = filter_var($DATA->id, FILTER_VALIDATE_INT);


      $inv = Inventory::find($id);
      if (!$inv->user_id) {
         $inv->setNombre("STOCK");
         $inv->setApellido("Sin asignar");
         $inv->setCorreo("Sin asignar");
         $inv->setTelefono("Sin asignar");
      } else {
         $usr = Personal::PIVOTFINDER($inv->getUserId());
         $inv->area = $usr->area;
         $pers = Perifericos::filter('user_id', '=', $inv->getUserId());
         $pers = array_map(function ($item) {
            return $item->toArray();
         }, $pers);
      }

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
