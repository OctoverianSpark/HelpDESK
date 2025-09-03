<?php


namespace Models;


class Maintenance extends ActiveRecord
{


  protected static $columnasDB = ['id', 'latest', 'next', 'tech', 'computer'];

  protected static $tabla = 'maintenance';


  public static function all($limit = null, $offset = null)
  {
    $query = "SELECT m.*,i.nombre_equipo as computer FROM " . static::$tabla . " m LEFT JOIN inv i ON m.computer = i.id";

    if ($limit !== null) {
      $query .= " LIMIT " . (int)$limit;
    }

    if ($offset !== null) {
      $query .= " OFFSET " . (int)$offset;
    }



    return self::consultarSQL($query);
  }
}
