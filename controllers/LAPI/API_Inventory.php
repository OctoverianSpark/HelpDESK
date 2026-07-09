<?php




namespace Controllers\LAPI;

use Models\Inventory;
use Models\Log;
use Models\Perifericos;
use Models\Personal;

class API_Inventory
{

   // POST /admin/inventario/bulk
   // Body: { "ids": [1,2,3], "action": "stock" | "delete" }
   public static function BULK_ACTION()
   {
      $DATA = json_decode(file_get_contents("php://input"), true);

      $ids = array_values(array_unique(array_filter(array_map('intval', $DATA['ids'] ?? []))));
      $action = $DATA['action'] ?? null;

      if (empty($ids) || !in_array($action, ['stock', 'delete'], true)) {
         http_response_code(400);
         echo json_encode(["ok" => false, "error" => "Faltan ids o la accion no es valida"]);
         exit;
      }

      $log = new Log();
      $resultados = [];

      foreach ($ids as $id) {
         $inv = Inventory::find($id);

         if (!$inv) {
            $resultados[] = ["id" => $id, "ok" => false, "error" => "No encontrado"];
            continue;
         }

         if ($action === 'stock') {
            $inv->setStock();
            $log->updateInventoryLog($id);
         } else {
            $inv->eliminar();
            $log->deleteInventoryLog($id);
         }

         $resultados[] = ["id" => $id, "ok" => true];
      }

      echo json_encode([
         "ok" => true,
         "total" => count($resultados),
         "results" => $resultados
      ]);
      exit;
   }

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



      $id = validarID();


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

   public static function GET_PERS()
   {

      $porPagina = 20; // cantidad de tickets por página
      $state = $_GET['state'] ?? 1;
      $pagina = isset($_GET['page']) ? (int) $_GET['page'] : 1;
      if ($pagina < 1) $pagina = 1;

      // Total de tickets para calcular las páginas
      $totalPerifericos = Perifericos::count($state);
      $totalPaginas = ceil($totalPerifericos / $porPagina);
      // Calcular offset
      $offset = ($pagina - 1) * $porPagina;

      // Obtener los tickets de la página actual
      $perifericos = Perifericos::all($porPagina, $offset, $state);

      if (count($perifericos) < $porPagina && $pagina > 1) {
         $totalPaginas = $pagina;
      }
      if (count($perifericos) == 0 && $pagina > 1) {
         $offset = ($pagina - 2) * $porPagina;
         $perifericos = Perifericos::all($porPagina, $offset);
      }


      echo json_encode([
         'data' => $perifericos,
         'total' => $totalPerifericos,
         'pages' => $totalPaginas,
         'page' => $pagina
      ]);
      exit;
   }

   public static function INVENTORYSEARCH()
   {


      $id = filter_var($_GET['id'], FILTER_VALIDATE_INT);


      $inv = Inventory::find($id);
      if (!$inv->user_id) {
         $inv->setNombre("STOCK");
         $inv->setApellido("Sin asignar");
         $inv->setCorreo("Sin asignar");
         $inv->setTelefono("Sin asignar");
      } else {
         $pers = Perifericos::filter('user_id', '=', $inv->getUserId());
         $pers = array_map(function ($item) {
            return $item->toArray();
         }, $pers);
      }

      $data = [
         "computer" => $inv->toArray() ?? [],
         "pers" => $pers ?? []
      ];


      echo json_encode($data);
   }

   public static function INVENTORY_GET()
   {
      $porPagina = 20; // cantidad de tickets por página
      $state = $_GET['state'] ?? 1;
      $pagina = isset($_GET['page']) ? (int) $_GET['page'] : 1;
      if ($pagina < 1) $pagina = 1;

      // Total de tickets para calcular las páginas
      $totalInventory = Inventory::count($state);
      $totalPaginas = ceil($totalInventory / $porPagina);
      // Calcular offset
      $offset = ($pagina - 1) * $porPagina;
      $allowedCols = ['tipo', 'marca', 'modelo', 'serial', 'nombre_equipo', 'nombre'];
      $col = $_GET['col'] === 'null' ? 'nombre' : $_GET['col'];
      $value = $_GET['value'] ?? null;

      if ($col && $value) {
         if (in_array($col, $allowedCols)) {
            $inventory = Inventory::filter($col, 'LIKE', "$value%", $state, $limit, $offset);
         } else {
            // si mandan col inválida, ignoro o devuelvo error
            $inventory = [];
         }
      } else {
         $inventory = Inventory::all($porPagina, $offset, $state);
      }

      if (count($inventory) < $porPagina && $pagina > 1) {
         $totalPaginas = $pagina;
      }
      if (count($inventory) == 0 && $pagina > 1) {
         $offset = ($pagina - 2) * $porPagina;
         $inventory = Inventory::all($porPagina, $offset);
      }


      echo json_encode([
         'data' => $inventory,
         'total' => $totalInventory,
         'pages' => $totalPaginas,
         'page' => $pagina
      ]);
      exit;
   }

   public static function INVENTORY_ALL()
   {
      $inv = Inventory::all();

      echo json_encode($inv);
   }
}
