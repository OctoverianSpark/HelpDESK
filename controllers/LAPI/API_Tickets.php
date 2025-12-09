<?php




namespace Controllers\LAPI;

use Models\Tickets;
use Models\Subcats;
use Models\Users;

class API_Tickets
{


   public static function INDEXER()
   {



      $data = json_decode(file_get_contents("php://input"));


      $tickets = [];
      if (!$data->from || !$data->to) {
         $info = Tickets::all();
      } else {
         $info = Tickets::getByDate("$data->from",  "$data->to");
      }

      if ($data->tech) {

         $filter = array_filter($info, function ($ticket) use ($data) {
            return $ticket->tecnico_id == $data->tech;
         });

         $info = [];

         foreach ($filter as $data) {

            $info[] = $data;
         }
      }


      foreach ($info as $ticket) {


         if ($ticket->categoria != "") {
            if ($ticket->tecnico != 'SIN ASIGNAR') {
               $tickets[] = $ticket;
            }
         }
      }





      echo json_encode($tickets);

      exit;
   }



   public static function TICKETSEARCH()
   {

      $DATA = json_decode(file_get_contents("php://input"));

      $id = filter_var($DATA->id, FILTER_VALIDATE_INT);

      $ticket = Tickets::find($id);

      echo json_encode($ticket);
      exit;
   }

   public static function SUBCATSSEARCH()
   {

      $DATA = json_decode(file_get_contents("php://input"));


      $subcats = Subcats::filter("categoria", "=", $DATA->cat);


      echo json_encode($subcats);
      exit;
   }

   public static function TICKETSGET()
   {
      $porPagina = 50; // cantidad de tickets por página
      $pagina = isset($_GET['page']) ? (int) $_GET['page'] : 1;
      if ($pagina < 1) $pagina = 1;

      // Total de tickets para calcular las páginas
      $totalTickets = Tickets::count();
      $totalPaginas = ceil($totalTickets / $porPagina);
      // Calcular offset
      $offset = ($pagina - 1) * $porPagina;

      // Obtener los tickets de la página actual
      $tickets = Tickets::all($porPagina, $offset);

      if (count($tickets) < $porPagina && $pagina > 1) {
         $totalPaginas = $pagina;
      }
      if (count($tickets) == 0 && $pagina > 1) {
         $offset = ($pagina - 2) * $porPagina;
         $tickets = Tickets::all($porPagina, $offset);
      }


      echo json_encode([
         'data' => $tickets,
         'total' => $totalTickets,
         'pages' => $totalPaginas,
         'page' => $pagina
      ]);
      exit;
   }

   public static function TICKET_CREATE_BY_API()
   {



      $ticket = new Tickets($_POST);

      $ticket->guardar();
      echo json_encode($ticket);
      exit;
   }

   public static function GRAPH_CONFIG()
   {
      $byTech = [];
      $byCategory = [];
      $byPriority = [];
      $byStatus = [];
      $ticketsByDate = [];
      $resolutionTimeByDate = [];
      $resolutionTimeByTech = []; // NUEVO: promedio de resolución por técnico
      $ticketCycle = []; // NUEVO: estados por técnico (stacked bar)
      $closedWithBreaks = 0;
      $firstContactClosed = 0;
      $tickets = empty($_GET) ? Tickets::all() : Tickets::filterByGraph($_GET['from'], $_GET['to'], $_GET['tech']);
      $totalTickets = count($tickets);
      $openTickets = 0;
      $pendingTickets = 0;
      $avgCompletionTime = 0;
      $avgPendingTime = 0;
      $avgAsignedTime = 0;
      $lowPriority = 0;
      $mediumPriority = 0;
      $highPriority = 0;

      foreach ($tickets as $ticket) {

         // ---- Por técnico ----
         if ($ticket->tecnico != 'SIN ASIGNAR') {
            if (!isset($byTech[$ticket->tecnico])) {
               $byTech[$ticket->tecnico] = 0;
            }
            $byTech[$ticket->tecnico]++;
         }

         // ---- Por categoría ----
         if ($ticket->categoria != '') {
            if (!isset($byCategory[$ticket->categoria])) {
               $byCategory[$ticket->categoria] = 0;
            }
            $byCategory[$ticket->categoria]++;
         }

         // ---- Por prioridad ----
         if ($ticket->prioridad != '') {
            if (!isset($byPriority[$ticket->prioridad])) {
               $byPriority[$ticket->prioridad] = 0;
            }
            $byPriority[$ticket->prioridad]++;
         }

         // ---- Por estado ----
         if ($ticket->estado != '') {
            if (!isset($byStatus[$ticket->estado])) {
               $byStatus[$ticket->estado] = 0;
            }
            $byStatus[$ticket->estado]++;
         }

         // ---- Tickets por fecha ----
         if (!empty($ticket->fecha)) {
            $date = date('Y-m-d', strtotime($ticket->fecha));
            if (!isset($ticketsByDate[$date])) {
               $ticketsByDate[$date] = 0;
            }
            $ticketsByDate[$date]++;
         }

         // ---- Tiempo promedio de resolución por fecha ----
         if (!empty($ticket->fecha) && !empty($ticket->fecha_completacion)) {
            $date = date('Y-m-d', strtotime($ticket->fecha));

            $start = strtotime($ticket->fecha);
            $end = strtotime($ticket->fecha_completacion);
            $diffHours = ($end - $start) / 3600;

            if (!isset($resolutionTimeByDate[$date])) {
               $resolutionTimeByDate[$date] = ['total' => 0, 'count' => 0];
            }
            $resolutionTimeByDate[$date]['total'] += $diffHours;
            $resolutionTimeByDate[$date]['count']++;

            // ---- Tiempo promedio por técnico ----
            if ($ticket->tecnico != 'SIN ASIGNAR') {
               if (!isset($resolutionTimeByTech[$ticket->tecnico])) {
                  $resolutionTimeByTech[$ticket->tecnico] = ['total' => 0, 'count' => 0];
               }
               $resolutionTimeByTech[$ticket->tecnico]['total'] += $diffHours;
               $resolutionTimeByTech[$ticket->tecnico]['count']++;
            }
         }

         if (strtolower($ticket->estado) === 'pendiente') {
            $pendingTickets++;
         }
         if (strtolower($ticket->estado) === 'completado' && $ticket->fecha_pendiente) {
            $closedWithBreaks++;
         }
         if (strtolower($ticket->estado) === 'completado' && !$ticket->fecha_pendiente) {
            $firstContactClosed++;
         }
         if (strtolower($ticket->estado) === 'sin asignar' || strtolower($ticket->estado) === 'en proceso') {
            $openTickets++;
         }

         $avgCompletionTime += abs(floatval($ticket->ep_c) - floatval($ticket->p_c));
         $avgPendingTime += floatval($ticket->ep_p);
         $avgAsignedTime += floatval($ticket->sa_ep);

         switch (strtolower($ticket->prioridad)) {
            case 'baja':
               $lowPriority++;
               break;
            case 'media':
               $mediumPriority++;
               break;
            case 'alta':
               $highPriority++;
               break;
         }
      }

      $avgCompletionTime = $avgCompletionTime / max($totalTickets, 1);
      $avgPendingTime = $avgPendingTime / max($totalTickets, 1);
      $avgAsignedTime = $avgAsignedTime / max($totalTickets, 1);

      // Promedios finales
      $avgResolutionByDate = [];
      foreach ($resolutionTimeByDate as $date => $values) {
         $avgResolutionByDate[$date] = $values['count'] > 0
            ? round($values['total'] / $values['count'], 2)
            : 0;
      }

      $avgResolutionByTech = [];
      foreach ($resolutionTimeByTech as $tech => $values) {
         $avgResolutionByTech[$tech] = $values['count'] > 0
            ? round($values['total'] / $values['count'], 2)
            : 0;
      }


      echo json_encode([
         'byTech' => $byTech,
         'byCategory' => $byCategory,
         'byPriority' => $byPriority,
         'byStatus' => $byStatus,
         'ticketsByDate' => $ticketsByDate,
         'avgResolutionByDate' => $avgResolutionByDate,
         'avgResolutionByTech' => $avgResolutionByTech,
         'ticketCycle' => $ticketCycle,
         'briefData' => [
            'totalTickets' => $totalTickets,
            'openTickets' => $byStatus['sin asignar'] + $byStatus['en proceso'],
            'pendingTickets' => $pendingTickets,
            'closedWithBreaks' => $closedWithBreaks,
            'firstContactClosed' => $firstContactClosed,
            'avgCompletionTime' => round($avgCompletionTime, 2),
            'avgPendingTime' => round($avgPendingTime, 2),
            'avgAsignedTime' => round($avgAsignedTime, 2),
            'lowPriority' => $lowPriority,
            'mediumPriority' => $mediumPriority,
            'highPriority' => $highPriority
         ]

      ]);
      exit;
   }




   public static function ACTUALTICKETS()
   {

      echo json_encode(Tickets::actuals());
      exit;
   }

   public static function TICKETUPDATE()
   {


      $DATA = json_decode(file_get_contents("php://input"));

      try {


         $ticket = Tickets::find($DATA->id);

         $ticket->sync($DATA);

         if ($ticket->estado === "completado" && !$ticket->fecha_completacion) {
            $ticket->fecha_completacion = date("Y-m-d H:i:s");
         }
         if ($ticket->estado === "pendiente" && !$ticket->fecha_pendiente) {
            $ticket->fecha_pendiente = date("Y-m-d H:i:s");
         }
         if ($ticket->estado === "en proceso" && !$ticket->fecha_asignada) {
            $ticket->fecha_asignada = date("Y-m-d H:i:s");
         }


         $ticket->guardar();

         if ($ticket->estado == 'completado') {
            notifyToWebhook(Tickets::find($ticket->id), 'ticket_closed');
         }





         echo json_encode(["status" => "1", "message" => "Ticket actualizado correctamente", "data" => $ticket]);
      } catch (\Exception $e) {

         echo json_encode(["status" => "0", "message" => $e->getMessage()]);
      }
   }
}
