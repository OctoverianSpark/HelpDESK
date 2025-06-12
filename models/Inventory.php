<?php

namespace Models;

class Inventory extends ActiveRecord
{

    protected static $schema = "ti";

    protected static $tabla = "inv";

    protected static $columnasDB =
    [
        "id",
        "user_id",
        "nombre",
        "apellido",
        "tipo_documento",
        "documento",
        "telefono",
        "correo",
        "tipo",
        "marca",
        "modelo",
        "color",
        "nombre_equipo",
        "serial",
        "correo_dominio",
        "usuarioPC",
        "propietario",
        "state"
    ];

    public function __construct($args = [])
    {
        parent::__construct($args);

        $this->user_id = $args['user_id'] ?? 0;
    }



    public static function all()
    {

        $query = "SELECT * FROM ti.inv as i ORDER BY id DESC";


        $result = self::consultarSQL($query);

        $result = self::findUser($result);

        return $result;
    }


    public function setStock()
    {


        $query = "UPDATE " . static::$tabla . " SET state = 0 WHERE id=$this->id";

        static::$db->query($query);
    }


    public function atributos()
    {
        $atributos = [];
        foreach (static::$columnasDB as $col) {

            if ($this->$col == null || in_array($col, ["nombre", "apellido", "tipo_documento", "documento", "telefono", "correo",])) continue;

            $atributos[$col] = $this->$col;
        }
        return $atributos;
    }


    public static function find($id)
    {

        $query = "SELECT i.*, p.first_name as nombre, p.last_name as apellido, p.id_type as tipo_documento, p.nat_id as documento, p.phone_number as telefono, p.email as correo
        FROM inv i
        LEFT JOIN rh.personal p ON i.user_id = p.id
        WHERE i.id = $id";


        $resultado = self::consultarSQL($query);

        $resultado = array_shift($resultado);

        return $resultado;
    }

    public static function filter($columna, $operador, $valor)
    {

        $query = "SELECT i.*, p.first_name as nombre, p.last_name as apellido, p.id_type as tipo_documento, p.nat_id as documento, p.phone_number as telefono, p.email as correo
        FROM inv i
        LEFT JOIN rh.personal p ON i.user_id = p.id
        WHERE i.$columna $operador $valor
        ORDER BY i.id DESC";
        $result = self::consultarSQL($query);


        return $result;
    }

    public static function filter_by_location($columna, $operador, $valor, $location)
    {
        $query = "SELECT * FROM ti.inv as i WHERE $columna $operador '$valor' and sede = '$location' order by id DESC";

        $result = self::consultarSQL($query);

        $result = self::findUser($result);

        return $result;
    }



    protected static function findUser($object = [])
    {

        foreach ($object as $data) {

            if ($data->user_id === "0") {
                $data->nombre = strtoupper("STOCK");
                $data->correo = strtoupper("Sin asignar");
                $data->telefono = strtoupper("Sin asignar");
                $data->tipo_documento = strtoupper("Sin asignar");
                $data->documento = strtoupper("Sin asignar");
            } else {
                $info = Personal::PIVOTFINDER($data->user_id, $data->sede);

                $data->nombre = $info->nombre;
                $data->apellido = $info->apellido;
                $data->correo = $info->correo;
                $data->telefono = $info->telefono;
                $data->tipo_documento = $info->tipo_documento;
                $data->documento = $info->documento;
            }
        }
        return $object;
    }
}
