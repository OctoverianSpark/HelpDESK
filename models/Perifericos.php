<?php



namespace Models;


class Perifericos extends ActiveRecord
{


    protected static $columnasDB = ["id", "tipo", "marca", "modelo", "color", "serial", "user_id", "state","mod_date","asign_date"];

    protected static $tabla = "perifericos";

    public $user_id = null;


    public function __construct($args = [])
    {
        parent::__construct($args);

        $this->user_id = $args['user_id'] ?? null;
    }



    public static function findGroup($id)
    {

        $query = "SELECT * FROM " . static::$tabla . " WHERE computer_id = '$id'";
        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    public function actualizar()
    {

        $atributos = $this->sanitizarAtributos();


        $valores = [];

        foreach ($atributos as $key => $value) {

            if($key === 'mod_date') continue;

            if (is_null($value) || $value === '') {

                $valores[] = "$key=NULL";
            } else {

                $valores[] = "$key='$value'";
            }
        }

        $query = "UPDATE " . static::$tabla . " SET ";
        $query .= join(",", $valores);
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "'";
        $resultado = self::$db->query($query);
        return $resultado;
    }


    public function getAsignedName()
    {


        if ($this->user_id) {

            $user = Personal::find($this->user_id);
            return $user->first_name . " " . $user->last_name;
        } else {
            return "Sin Asignar";
        }
    }


    public function eliminar()
    {

        $query = "DELETE FROM " . static::$tabla . " where id = '$this->id'";

        self::$db->query($query);
    }
    public function toArray()
    {

        $array = [];
        foreach (static::$columnasDB as $col) {
            if (isset($this->$col)) {
                $array[$col] = $this->$col;
            }
        }
        return $array;
    }
}
