<?php





namespace Controllers\LAPI;

use Models\Encuestas;
use Models\Users;

class API_POLLS
{



   public static function GET_POLLS()
   {



      $polls = Encuestas::all();




      foreach ($polls as $poll) {

         $poll->individual_test = json_decode($poll->individual_test, true);
         $poll->general_test = json_decode($poll->general_test);

         foreach ($poll->individual_test as $key => $value) {

            $tech = Users::find($key);

            $poll->individual_test[$key]["name"] = "$tech->first_name $tech->last_name";
         }
      }

      echo json_encode($polls);
      exit;
   }

   public static function GET_POLLS_ID()
   {

      $DATA = json_decode(file_get_contents("php://input"));

      $id = filter_var($DATA->id, FILTER_VALIDATE_INT);

      $poll = Encuestas::find($id);

      $poll->individual_test = json_decode($poll->individual_test, true);
      $poll->general_test = json_decode($poll->general_test);

      foreach ($poll->individual_test as $key => $value) {

         $tech = Users::find($key);

         $poll->individual_test[$key]["name"] = "$tech->first_name $tech->last_name";
      }

      echo json_encode($poll);
      exit;
   }
}
