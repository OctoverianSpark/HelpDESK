<?php




namespace Controllers\LAPI;

use Models\Tickets;
use Models\Subcats;
use Models\Users;

class API_Tickets
{  


   public static function INDEXER(){



      $data = json_decode(file_get_contents("php://input"));


      if (!$data->from || !$data->to) {
         $tickets = Tickets::all();
      }else{
         $tickets= Tickets::getByDate("$data->from" ,  "$data->to");
      }

      if($data->tech){

         $filter = array_filter($tickets, function($ticket) use ($data) {
            return $ticket->tecnico_id == $data->tech;
         });

         $tickets = [];

         foreach($filter as $data) {
            
            $tickets[] = $data;

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

   public static function TICKETSGET(){



      
      echo json_encode(Tickets::all());
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

         $mail = enviarCorreo($body, "Ticket Asignado",["jean.pr@asistentevirtualsas.com"] );


         echo json_encode(["status" => "1", "message" => "Ticket actualizado correctamente","data"=>$ticket,"mail"=>$mail]);
      } catch (\Exception $e) {

         echo json_encode(["status" => "0", "message" => $e->getMessage()]);
      }
   }
}
