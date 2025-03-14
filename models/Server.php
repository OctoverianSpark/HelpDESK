<?php


namespace Models;



class Server extends ActiveRecord
{



   protected static $tabla = 'v_servers';
   protected static $columnasDB = ["id", "ip", "agent", "user_limit", "users_in_use", "maintenance", "maintenance_start","cost"];




   protected static function crearObjeto($registro)
   {
      $objeto = new static;


      foreach ($registro as $key => $value) {
         if (property_exists($objeto, $key)) {
            $objeto->$key = $value;
         }
      }

      return $objeto;
   }
}
