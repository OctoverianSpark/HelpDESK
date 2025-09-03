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


      echo json_encode([
         'tickets' => $tickets,
         'total' => $totalTickets,
         'pages' => $totalPaginas,
         'page' => $pagina
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

         $ticket->guardar();


         $ticket = Tickets::find($DATA->id);


         $tech = Users::filter("id", "=", $ticket->tecnico_id);
         $tech = array_shift($tech);


         $body = file_get_contents(__DIR__ . "/../../views/templates/mail/asignacion-ticket-usuario.html");

         str_replace("{{ id }}", $DATA->id, $body);
         str_replace("{{ tech }}", $tech->first_name . " " . $tech->last_name, $body);

         $mail = enviarCorreo($body, "Ticket Asignado", ["jean.pr@asistentevirtualsas.com"]);


         echo json_encode(["status" => "1", "message" => "Ticket actualizado correctamente", "data" => $ticket, "mail" => $mail]);
      } catch (\Exception $e) {

         echo json_encode(["status" => "0", "message" => $e->getMessage()]);
      }
   }
}
