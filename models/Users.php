<?php

namespace Models;


class Users extends ActiveRecord
{

    protected static $columnasDB = [
        "id",
        "first_name",
        "last_name",
        "ad_user",
        "mail",
        "role",
        "area"
    ];


    protected static $tabla = "users";


    public static function searchByName($nombre)
    {
        $query = "SELECT * FROM " . static::$tabla . " WHERE CONCAT(first_name,' ',last_name) = '$nombre'";
        $resultado = self::consultarSQL($query);

        return array_shift($resultado);
    }

    public static function getTecnicals()
    {
        $query = "SELECT * FROM " . static::$tabla . " where area = 'ATI' ORDER BY id DESC";
        $resultado = self::consultarSQL($query);

        return $resultado;
    }




    public static function PIVOTFINDER($id, $area)
    {

        $query = "SELECT * FROM " . static::$tabla . " WHERE id = $id AND area = '$area'";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado);
    }
}
