<?php





namespace Models;




class Log extends ActiveRecord
{



   protected static $columnasDB = ["id", "type", "action", "date", "description", "data_id"];
   protected static $tabla = "logs";



   public function newInventoryLog($data_id)
   {

      $target = Inventory::find($data_id);

      $this->date = date("Y-m-d H:i:s");
      $this->type = "inventory";
      $this->action = "create";
      $this->description = "El usuario " . $_SESSION["name"] . " ha registrado un computador en la base de datos con el nombre $target->nombre_equipo";
      $this->data_id = $data_id;

      $this->crear();
   }

   public function updateInventoryLog($data_id)
   {
      $target = Inventory::find($data_id);
      $this->id = null;
      $this->date = date("Y-m-d H:i:s");
      $this->type = "inventory";
      $this->action = "update";
      $this->description = "El usuario " . $_SESSION["name"] . " ha actualizado un computador en la base de datos con el nombre $target->nombre_equipo";
      $this->data_id = $data_id;

      $this->guardar();
   }

   public function deleteInventoryLog($data_id)
   {


      $this->date = date("Y-m-d H:i:s");
      $this->type = "inventory";
      $this->action = "delete";
      $this->description = "El usuario " . $_SESSION["name"] . " ha eliminado un computador en la base de datos";
      $this->data_id = $data_id;

      $this->crear();
   }


   public function newPerLog($data_id)
   {

      $target = Perifericos::find($data_id);

      $this->date = date("Y-m-d H:i:s");
      $this->type = "peripheral";
      $this->action = "create";
      $this->description = "El usuario " . $_SESSION["name"] . " añadio un $target->tipo al equipo";
      $this->data_id = $data_id;

      $this->crear();
   }

   public function updatePerLog(Perifericos $old, Perifericos $new)
   {



      $this->date = date("Y-m-d H:i:s");
      $this->type = "peripheral";
      $this->action = "update";
      $this->description = "El usuario " . $_SESSION["name"] . " cambio un periferico del equipo ($old->tipo a $new->tipo  ) ";
      $this->data_id = $new->id;
      $this->crear();
   }

   public function delPerLog(Perifericos $target)
   {


      $this->date = date("Y-m-d H:i:s");
      $this->type = "peripheral";
      $this->action = "delete";
      $this->description = "El usuario " . $_SESSION["name"] . " elimino un $target->tipo del equipo";
      $this->data_id = 0;

      $this->crear();
   }



   public static function getLogs($type = "", $data_id = null, $action = "")
   {
      $query = "SELECT * FROM " . self::$tabla . " WHERE type = '$type'";

      $ID = function () use (&$query, $data_id) {
         $query .= " AND data_id = $data_id";
      };

      $CREATED = function () use (&$query) {
         $query .= " AND action = 'create'";
      };

      $UPDATED = function () use (&$query) {
         $query .= " AND action = 'update'";
      };

      $DELETED = function () use (&$query) {
         $query .= " AND action = 'delete'";
      };


      if ($data_id) $ID($data_id);
      if ($action === 'create') $CREATED();
      if ($action === 'update') $UPDATED();
      if ($action === 'delete') $DELETED();


      $result = self::consultarSQL($query);

      debuguear($result);

      return $result;
   }
}
