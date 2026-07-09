<?php

namespace Controllers\LAPI;

use Models\Inventory;
use Models\Log;

class API_TracerSync
{

   private static function checkApiKey()
   {
      $key = $_SERVER['HTTP_X_API_KEY'] ?? '';

      if ($key === '' || !hash_equals(TRACER_SYNC_API_KEY, $key)) {
         http_response_code(401);
         echo json_encode(["ok" => false, "error" => "API key invalida o ausente"]);
         exit;
      }
   }

   // Crea o actualiza un equipo de "inv" a partir de un registro de tracer (computers)
   private static function upsertMachine($machine, Log $log)
   {
      $serial = trim((string)($machine['serial_number'] ?? ''));

      if ($serial === '') {
         return ["ok" => false, "error" => "serial_number requerido", "raw" => $machine];
      }

      $datos = array_filter([
         'serial'        => $serial,
         'nombre_equipo' => $machine['hostname'] ?? null,
         'marca'         => $machine['machineBrand'] ?? null,
         'modelo'        => $machine['machineModel'] ?? null,
         'usuarioPC'     => $machine['username'] ?? null,
      ], function ($valor) {
         return $valor !== null && $valor !== '';
      });

      $existente = Inventory::findBySerial($serial);

      if ($existente) {
         $existente->sync($datos);
         $existente->actualizar();

         return ["ok" => true, "action" => "updated", "id" => $existente->id, "serial" => $serial];
      }

      // "inv" tiene columnas varchar NOT NULL sin default (tipo, marca, modelo, color,
      // usuarioPC, etc.); si tracer no trae el dato hay que mandar algo igual o el INSERT
      // truena en modo estricto de MySQL. $datos ya tiene prioridad sobre estos defaults.
      // OJO: Inventory::atributos() usa "== null" para decidir que omitir, y en PHP
      // '' == null es true, asi que el relleno NO puede ser string vacio o se descarta.
      $datos += [
         'tipo'           => 'COMPUTADOR',
         'marca'          => 'SIN DATO',
         'modelo'         => 'SIN DATO',
         'color'          => 'SIN DATO',
         'usuarioPC'      => 'SIN ASIGNAR',
         'correo_dominio' => 'SIN ASIGNAR',
         'propietario'    => 'SIN ASIGNAR',
         'area'           => 'SIN ASIGNAR',
      ];
      $datos['state'] = 1;

      $nuevo = new Inventory($datos);
      $nuevo->crear();
      $id = Inventory::getLastId();

      $log->newInventoryLog($id);

      return ["ok" => true, "action" => "created", "id" => $id, "serial" => $serial];
   }

   private static function summarize($resultados)
   {
      $creados = 0;
      $actualizados = 0;
      $errores = 0;

      foreach ($resultados as $r) {
         if (empty($r['ok'])) {
            $errores++;
         } elseif ($r['action'] === 'created') {
            $creados++;
         } else {
            $actualizados++;
         }
      }

      return [
         "ok" => true,
         "total" => count($resultados),
         "created" => $creados,
         "updated" => $actualizados,
         "errors" => $errores,
         "results" => $resultados
      ];
   }

   // POST /api/tracer/sync
   // Llamado por tracer-ingestor (u otro proceso externo) para empujar el inventario.
   // Header requerido: X-Api-Key
   // Body esperado: { "machines": [ { "serial_number": "...", "hostname": "...", "machineBrand": "...", "machineModel": "..." }, ... ] }
   public static function PUSH()
   {
      self::checkApiKey();

      if (empty($_SESSION["name"])) {
         $_SESSION["name"] = "Tracer Sync (API)";
      }

      $body = json_decode(file_get_contents("php://input"), true);
      $machines = $body['machines'] ?? (is_array($body) ? $body : []);

      if (empty($machines)) {
         http_response_code(400);
         echo json_encode(["ok" => false, "error" => "No se recibieron equipos"]);
         exit;
      }

      $log = new Log();
      $resultados = [];

      foreach ($machines as $machine) {
         $resultados[] = self::upsertMachine((array)$machine, $log);
      }

      echo json_encode(self::summarize($resultados));
      exit;
   }

   // POST /admin/inventario/sync/tracer
   // Boton manual desde el panel de administracion: HelpDESK llama a tracer-ingestor
   // (GET {TRACER_INGESTOR_URL}/machines) y sincroniza el resultado contra "inv".
   public static function PULL()
   {
      $url = rtrim(TRACER_INGESTOR_URL, '/') . '/machines';

      $headers = "Content-Type: application/json\r\n";

      if (TRACER_INGESTOR_API_KEY !== '') {
         $headers .= "Authorization: Bearer " . TRACER_INGESTOR_API_KEY . "\r\n";
      }

      $contexto = stream_context_create([
         "http" => [
            "method"        => "GET",
            "header"        => $headers,
            "timeout"       => 15,
            "ignore_errors" => true
         ]
      ]);

      $respuesta = @file_get_contents($url, false, $contexto);

      if ($respuesta === false) {
         http_response_code(502);
         echo json_encode(["ok" => false, "error" => "No se pudo contactar a tracer-ingestor"]);
         exit;
      }

      $machines = json_decode($respuesta, true);

      if (!is_array($machines)) {
         http_response_code(502);
         echo json_encode(["ok" => false, "error" => "Respuesta invalida de tracer-ingestor"]);
         exit;
      }

      $log = new Log();
      $resultados = [];

      foreach ($machines as $machine) {
         $resultados[] = self::upsertMachine((array)$machine, $log);
      }

      echo json_encode(self::summarize($resultados));
      exit;
   }
}
