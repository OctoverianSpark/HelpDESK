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

         $tempDir = sys_get_temp_dir() . "\\user_" . session_id(); // Directorio temporal único

         // Crear el directorio si no existe
         if (!file_exists($tempDir)) {
            mkdir($tempDir, 0777, true);
         }

         // Ruta completa del archivo
         $tempPath = $tempDir . "\\" . basename($file["name"]);

         move_uploaded_file($file["tmp_name"], $tempPath);

         $_SESSION["sign_name"] = $tempPath;





         exit;
      }
      $order = Ordenes::find($post->order_id);

      $eq = Inventory::find($order->computer_id);
      $usr = Personal::PIVOTFINDER($order->user_id);


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


      $parent = '';

      if(str_contains($order->order_id,'ODS')) $parent = '1nuTmqj-4EDISnuoAzaPhrIbWvDaPvuEk';
      if(str_contains($order->order_id,'ODE')) $parent = '1Fge4xth-vc0GAd8HDkUDUUbJYOW17lcj';
      if(str_contains($order->order_id,'ODR')) $parent = '1X1sHy_OGV5tyhCnQL2dsLGwM-babMM0G';


      $phpWord->getCompatibility()->setOoxmlVersion(15);
      $objWriter = new Word2007($phpWord);
      $name = "$order->order_id.docx";
      $objWriter->save($name);


      $id = saveData($name,$parent);

      unlink($_SESSION["sign_name"]);
      unlink($name);
      $_SESSION["sign_name"] = null;

      echo json_encode(["msg" => "Done!!!!", "link" => "https://docs.google.com/document/d/$id"]);
      exit;
   }


   public static function GET()
   {

      $data = json_decode(file_get_contents("php://input"));
      $orders = Ordenes::all();

      if ($data->mode === "graphs") {

         $graph = [
            "entrega" => 0,
            "salida" => 0,
            "recepcion" => 0
         ];

         foreach ($orders as $order) {

            if (str_contains($order->order_id, "ODE")) $graph["entrega"] += 1;
            if (str_contains($order->order_id, "ODS")) $graph["salida"] += 1;
            if (str_contains($order->order_id, "ODR")) $graph["recepcion"] += 1;
         }
         echo json_encode($graph);
         exit;
      } else {
         echo json_encode($orders);
         exit;
      }
   }


   public static function ACTUALS()
   {

      $orders = Ordenes::actuals();

      $graph = [
         "entrega" => 0,
         "salida" => 0,
         "recepcion" => 0
      ];

      foreach ($orders as $order) {

         if (str_contains($order->order_id, "ODE")) $graph["entrega"] += 1;
         if (str_contains($order->order_id, "ODS")) $graph["salida"] += 1;
         if (str_contains($order->order_id, "ODR")) $graph["recepcion"] += 1;
      }

      echo json_encode($graph);
      exit;
   }
}
