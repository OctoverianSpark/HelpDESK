<?php


namespace Models;



class Encuestas extends ActiveRecord
{



    protected static $columnasDB = ["id", "answers", "area", "date", "comment", "name"];


    protected static $tabla = "rh.poll";




    protected static function crearObjeto($registro)
    {
        $objeto = new static;


        foreach ($registro as $key => $value) {
            if (property_exists($objeto, $key)) {
                if ($key === 'answers') {
                    $objeto->$key = json_decode($value);
                } else {
                    $objeto->$key = $value;
                }
            }
        }

        return $objeto;
    }

    public static function all($limit = null, $offset = null)
    {
        $query = "SELECT * FROM " . static::$tabla . " WHERE area = 'ati'";

        if ($limit !== null) {
            $query .= " LIMIT " . (int)$limit;
        }

        if ($offset !== null) {
            $query .= " OFFSET " . (int)$offset;
        }



        return self::consultarSQL($query);
    }
}
