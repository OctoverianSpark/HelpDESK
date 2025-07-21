<?php

namespace Models;


class Tickets extends ActiveRecord
{

    protected static $columnasDB = ["id", "fecha", "usuario", "categoria", "subcategoria", "descripcion", "anydesk", "imagen", "estado", "tecnico_id", "tecnico", "prioridad", "fecha_asignada", "fecha_pendiente", "fecha_completacion", "tiempo_en_asignar", "tiempo_en_pendiente", "tiempo_en_completar", "solucion"];


    protected static $tabla = "tickets";



    protected static function findConn($obj = [])
    {

        foreach ($obj as $data) {

            if ($data->tecnico_id == 0) {

                $data->tecnico = "SIN ASIGNAR";
            } else {

                $info = Users::PIVOTFINDER($data->tecnico_id, "ATI");

                $data->tecnico = $info->first_name . " " . $info->last_name;
            }
        }

        return $obj;
    }

    public static function getByDate($from, $to)
    {


        $query = "SELECT * FROM ti.tickets WHERE fecha BETWEEN '$from' AND '$to' ORDER BY id DESC";



        $result = self::consultarSQL($query);
        $result = static::findConn($result);

        return $result;
    }
    public static function actuals()
    {


        $query = "SELECT 
                    *
                FROM
                    ti.tickets
                WHERE
                    MONTHNAME(fecha) = MONTHNAME(now()) AND YEAR(fecha) = YEAR(now())";

        $result = self::consultarSQL($query);
        $result = static::findConn($result);

        return $result;
    }



    public static function all()
    {
        $query = "SELECT * FROM " . static::$tabla . " ORDER BY id DESC";
        $result = self::consultarSQL($query);
        $result = static::findConn($result);

        return $result;
    }

    public static function find($id)
    {

        $query = "SELECT * FROM " . static::$tabla . " WHERE ID = $id";
        $resultado = self::consultarSQL($query);
        $resultado = static::findConn($resultado);

        return array_shift($resultado);
    }

    public static function filter($column, $operator, $value)
    {

        $query = "SELECT * FROM " . static::$tabla;
        $query .= " WHERE $column $operator '$value' ORDER BY id DESC";


        $result = self::consultarSQL($query);

        $result = static::findConn($result);

        return $result;
    }


    public function setImagen($imagen)
    {
        //Asignar el atributo de imagen el nombre de la imagen
        if ($imagen) {
            $this->imagen = $imagen;
        }
    }

    public function crear()
    {

        //Sanitizar
        $atributos = $this->sanitizarAtributos();
        $finalAttrib = [];

        foreach ($atributos as $key => $value):
            if ($atributos[$key] === null || $atributos[$key] === "") continue;
            if ($key === "tecnico") continue;
            $finalAttrib[$key] = $value;


        endforeach;

        //Insercion
        $query = "INSERT INTO " . static::$tabla . " (";
        $query .= join(", ", array_keys($finalAttrib));
        $query .= ")VALUES ('";
        $query .= join("' , '", array_values($finalAttrib));
        $query .= "')";


        $resultado = self::$db->query($query);

        return $resultado;
    }



    public function actualizar()
    {

        $atributos = $this->sanitizarAtributos();

        $valores = [];

        foreach ($atributos as $key => $value) {
            if ($atributos[$key] === "" || $atributos[$key] === null) continue;
            if ($key === "creado") continue;
            if ($key === "tecnico") continue;
            $valores[] = "$key='$value'";
        }

        $query = "UPDATE " . static::$tabla . " SET ";
        $query .= join(",", $valores);
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "'";
        $query .= " LIMIT 1";


        $query = strtolower($query);

        $resultado = self::$db->query($query);
        return $resultado;
    }
}
