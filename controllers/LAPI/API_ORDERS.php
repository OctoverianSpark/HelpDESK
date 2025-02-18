<?php


namespace Controllers\LAPI;

use Models\Inventory;
use Models\Ordenes;
use Models\Perifericos;
use Models\Personal;
use TCPDF;
use PhpOffice\PhpWord\Writer\PDF;
use PhpOffice\PhpWord\Writer\Word2007;

class API_ORDERS
{


   public static function printer()
   {



      $post = json_decode(file_get_contents("php://input"));

      if (isset($_FILES["sign"])) {
         
         $file = $_FILES["sign"];

         $path= __DIR__ . "/../../public/build/img";


         move_uploaded_file($file["tmp_name"],$path . "/" . $file["name"]);

         exit;

      }

      $order = Ordenes::find($post->order_id);

      $eq = Inventory::find($order->computer_id);
      $usr = Personal::PIVOTFINDER($order->user_id, "avsas");
      

      $cols = [
         "tipo",
         "marca",
         "modelo",
         "serial",
         "nombre_equipo",
         "observaciones"
      ];


      if (str_contains($order->order_id, "ODS")) include __DIR__ . "/../../includes/scripts/salida.php";
      if (str_contains($order->order_id, "ODE")) include __DIR__ . "/../../includes/scripts/entrega.php";
      if (str_contains($order->order_id, "ODR")) include __DIR__ . "/../../includes/scripts/recepcion.php";





      $phpWord->getCompatibility()->setOoxmlVersion(15);
      $objWriter = new Word2007($phpWord);
      $name = "$order->order_id.docx";
      $objWriter->save($name);

  
      $id = saveData($name);

      unlink(__DIR__ . '/../../public/build/img/sign.png');
      unlink($name);
      
      echo json_encode(["msg"=>"Done!!!!","link"=>"https://docs.google.com/document/d/$id"]);
      exit;
      
      
   }
}
