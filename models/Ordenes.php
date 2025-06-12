<?php

namespace Models;



class Ordenes extends ActiveRecord
{


    protected static $columnasDB = [
        "id",
        "order_id",
        "user_id",
        "computer_id",
        "nombre_equipo",
        "mail",
        "nombre",
        "apellido",
        "description",
        "emitted_date",
        "return_date",
        "comments",
        "state"
    ];


    protected static $tabla = "ordenes";





    public static function find($id)
    {

        $query = "SELECT * FROM ti.ordenes WHERE id = $id";

        $resultado = self::consultarSQL($query);


        $resultado = self::findConn($resultado);

        $resultado = array_shift($resultado);

        return $resultado;
    }

    public static function filter($columna, $operador, $valor)
    {

        $query = "SELECT * FROM ti.ordenes as i WHERE $columna $operador '$valor' order by id DESC";
        $result = self::consultarSQL($query);

        $result = self::findConn($result);

        return $result;
    }

    public static function all()
    {

        $query = "SELECT * FROM ti.ordenes as i ORDER BY id DESC";


        $result = self::consultarSQL($query);

        $result = self::findConn($result);

        return $result;
    }



    public static function findConn($object = [])
    {
        foreach ($object as $data) {
            $info = Personal::PIVOTFINDER($data->user_id);
            $computer = Inventory::find($data->computer_id);
            $data->nombre = $info->first_name;
            $data->apellido = $info->last_name;
            $data->nombre_equipo = $computer->nombre_equipo;
        }
        return $object;
    }

    public function atributos()
    {
        $atributos = [];
        foreach (static::$columnasDB as $col) {

            if (!$this->$col) continue;

            $atributos[$col] = $this->$col;
        }

        return $atributos;
    }


    public function crear()
    {

        //Sanitizar
        $atributos = $this->sanitizarAtributos();



        //Insercion
        $query = "INSERT INTO " . static::$tabla . " (";
        $query .= join(", ", array_keys($atributos));
        $query .= ")VALUES ('";
        $query .= join("' , '", array_values($atributos));
        $query .= "')";


        $query = strtolower($query);
        $resultado = self::$db->query($query);


        return $resultado;
    }






    public function sanitizarAtributos()
    {
        $atributos = $this->atributos();


        $sanitizado = [];

        foreach ($atributos as $key => $value) {

            if ($key === "nombre_equipo" || $key === "nombre" || $key === "apellido") continue;

            $sanitizado[$key] = self::$db->escape_string($value);
        }

        return $sanitizado;
    }
}
