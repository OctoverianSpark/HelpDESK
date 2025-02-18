<?php 



namespace Controllers\LAPI;


class API_BASE{



   static function COOKIESGET(){


      echo json_encode($_SESSION);

      
   }
   static function CONVERT(){



      



      echo json_encode(["a"=>"A"]);

   }

}