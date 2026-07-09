<?php




namespace Models;



class Personal extends ActiveRecord
{

    protected static $schema = "ti";

    protected static $tabla = "personal";

    protected static $columnasDB =
    [
        "id",
        "first_name",
        "last_name",
        "id_type",
        "nat_id",
        "phone_number",
        "email",
        "job_title",
        "area",
        "mod_date",
        "state",
        "location",
        "contract_type"

    ];




    public static function separateAll()
    {

        $resultado = [];

        $query = "SELECT * FROM " . static::$schema . "." . static::$tabla . "ORDER BY id DESC";
        $resultado = static::consultarSQL($query);

        return $resultado;
    }



    public static function filter($column, $operator, $value)
    {




        $query = "SELECT * FROM " . static::$schema .  "." . static::$tabla  . " WHERE $column $operator '$value' ORDER BY id DESC";
        $resultado = static::consultarSQL($query);


        return $resultado;
    }



    public static function findByDocumento($nat_id)
    {
        $nat_id = self::$db->escape_string($nat_id);

        $query = "SELECT * FROM " . static::$schema . "." . static::$tabla . " WHERE nat_id = '$nat_id' LIMIT 1";

        $resultado = self::consultarSQL($query);

        return array_shift($resultado);
    }

    public static function PIVOTFINDER($id)
    {

        $query = "SELECT * FROM " . static::$schema . "." . static::$tabla . " WHERE id = $id";

        $resultado = self::consultarSQL($query);



        return array_shift($resultado);
    }
}
