<?php

namespace Models;


class Tickets extends ActiveRecord
{

    protected static $columnasDB = ["id", "fecha", "usuario", "categoria", "subcategoria", "descripcion", "imagen", "estado", "tecnico_id", "tecnico", "prioridad", "fecha_asignada", "fecha_pendiente", "fecha_completacion", "solucion"];



    protected static $tabla = "tickets";

    public ?int $id;
    public string $fecha;
    public string $usuario;
    public string $categoria;
    public string $subcategoria;
    public string $descripcion;
    public string $imagen;
    public string $estado;
    public int $tecnico_id;
    public string $tecnico;
    public string $prioridad;
    public ?string $fecha_asignada;
    public ?string $fecha_pendiente;
    public ?string $fecha_completacion;
    public string $solucion;

    public string $sa_ep; //Suma de sin asignar a pendiente
    public string $ep_c; //Suma de en proceso a completado
    public string $p_c; //Suma de pendiente a completado
    public string $ep_p; //Suma de en proceso a pendiente


    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->fecha = $args['fecha'] ?? date('Y-m-d H:i:s');
        $this->usuario = $args['usuario'] ?? '';
        $this->categoria = $args['categoria'] ?? '';
        $this->subcategoria = $args['subcategoria'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->estado = $args['estado'] ?? 'Pendiente';
        $this->tecnico_id = $args['tecnico_id'] ?? 0;
        $this->prioridad = $args['prioridad'] ?? 'Baja';
        $this->fecha_asignada = $args['fecha_asignada'] ?? null;
        $this->fecha_pendiente = $args['fecha_pendiente'] ?? null;
        $this->fecha_completacion = $args['fecha_completacion'] ?? null;
        $this->tecnico = $args['tecnico'] ?? '';
        $this->solucion = $args['solucion'] ?? '';
        $this->sa_ep = $args['sa_ep'] ?? 0;
        $this->ep_c = $args['ep_c'] ?? 0;
        $this->p_c = $args['p_c'] ?? 0;
        $this->ep_p = $args['ep_p'] ?? 0;
    }

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
    public static function all($limit = null, $offset = null)
    {
        $query = "SELECT tickets.*,ABS(TIMESTAMPDIFF(MINUTE, fecha_asignada, fecha)) AS sa_ep,
                ABS(TIMESTAMPDIFF(MINUTE, fecha_completacion, fecha_asignada)) AS ep_c,
                ABS(TIMESTAMPDIFF(MINUTE, fecha_completacion, fecha_pendiente)) AS p_c,
                ABS(TIMESTAMPDIFF(MINUTE, fecha_pendiente, fecha_asignada)) AS ep_p, CONCAT(users.first_name,' ' , users.last_name) as tecnico FROM " . static::$tabla . " LEFT JOIN users on tickets.tecnico_id = users.id";
        $query .= " ORDER BY id DESC ";

        if ($limit !== null) {
            $query .= " LIMIT " . (int)$limit;
        }

        if ($offset !== null) {
            $query .= " OFFSET " . (int)$offset;
        }


        return self::consultarSQL($query);
    }

    public static function filterByGraph($from = null, $to = null, $tech = null)
    {

        $query = "SELECT tickets.*,ABS(TIMESTAMPDIFF(MINUTE, fecha_asignada, fecha)) AS sa_ep,
                ABS(TIMESTAMPDIFF(MINUTE, fecha_completacion, fecha_asignada)) AS ep_c,
                ABS(TIMESTAMPDIFF(MINUTE, fecha_completacion, fecha_pendiente)) AS p_c,
                ABS(TIMESTAMPDIFF(MINUTE, fecha_pendiente, fecha_asignada)) AS ep_p, CONCAT(users.first_name,' ' , users.last_name) as tecnico FROM " . static::$tabla . " LEFT JOIN users on tickets.tecnico_id = users.id";

        if ($from && $to && $tech) {
            $query .= " WHERE fecha BETWEEN '$from' AND '$to' AND tecnico_id = $tech";
        } elseif ($from && $to) {
            $query .= " WHERE fecha BETWEEN '$from 00:00:00' AND '$to 23:59:59'";
        } elseif ($from && $tech) {
            $query .= " WHERE fecha >= '$from 00:00:00' AND tecnico_id = $tech";
        } elseif ($to && $tech) {
            $query .= " WHERE fecha <= '$to 23:59:59' AND tecnico_id = $tech";
        } elseif ($from) {
            $query .= " WHERE fecha >= '$from 00:00:00'";
        } elseif ($to) {
            $query .= " WHERE fecha <= '$to 23:59:59'";
        } elseif ($tech) {
            $query .= " WHERE tecnico_id = $tech";
        }

        $result = self::consultarSQL($query);

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
