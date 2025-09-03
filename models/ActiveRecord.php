<?php



namespace Models;





abstract class ActiveRecord extends ObjectCreator
{

    protected static $columnasDB = [];

    protected static $db;

    protected static $schema = "ti";

    protected static $tabla = "";

    protected static $errores = [];


    public function __construct($args = [])
    {

        foreach (static::$columnasDB as $column) {
            $this->$column = $args[$column] ?? null;
        }
    }



    public static function setDB()
    {
        self::$db = conectarDB(static::$schema);
    }
    public static function all($limit = null, $offset = null)
    {
        $query = "SELECT * FROM " . static::$tabla;

        if ($limit !== null) {
            $query .= " LIMIT " . (int)$limit;
        }

        if ($offset !== null) {
            $query .= " OFFSET " . (int)$offset;
        }



        return self::consultarSQL($query);
    }

    public static function count()
    {
        $query = "SELECT COUNT(*) as total FROM " . static::$tabla;
        $resultado = self::$db->query($query);
        $row = $resultado->fetch_assoc();
        return (int)$row['total'];
    }


    public static function get($limit)
    {
        $query = "SELECT * FROM " . static::$tabla . " LIMIT " . $limit;

        $resultado = self::consultarSQL($query);

        return $resultado;
    }




    public static function find($id)
    {

        $query = "SELECT * FROM " . static::$tabla . " WHERE id = $id";
        $resultado = self::consultarSQL($query);

        return array_shift($resultado);
    }

    //Buscar un registro por su ID



    public static function consultarSQL($query)
    {
        //Consultar
        $resultado = self::$db->query($query);


        //Iterar
        $array = [];
        while ($registro = $resultado->fetch_assoc()) {

            $array[] = static::crearObjeto($registro);

            # code...
        }

        //Liberar
        $resultado->free();

        //Retornar
        return $array;
    }




    public function guardar()
    {

        if (!$this->id) {
            $this->crear();

            $resultado = self::$db->insert_id;
        } else {
            $this->actualizar();
            $resultado = $this->id;
        }

        return $resultado;
    }

    public function crear()
    {

        //Sanitizar
        $atributos = $this->sanitizarAtributos();

        if (isset($atributos['id'])) {
            unset($atributos['id']);
        }


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


    public static function getLastId()
    {


        return self::$db->insert_id;
    }

    public function eliminar()
    {
        $query = "DELETE FROM " . static::$tabla . " WHERE id = '$this->id' ";


        self::$db->query($query);
    }

    public function atributos()
    {
        $atributos = [];
        foreach (static::$columnasDB as $columna) {
            $atributos[$columna] = $this->$columna;
        }

        return $atributos;
    }


    public function sanitizarAtributos()
    {

        $atributos = $this->atributos();

        $sanitizado = [];

        foreach ($atributos as $key => $value) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        return $sanitizado;
    }

    public function actualizar()
    {

        $atributos = $this->sanitizarAtributos();

        $valores = [];

        foreach ($atributos as $key => $value) {
            if ($key === "id") continue;
            if ($atributos[$key] === "" || $atributos[$key] === null) continue;
            if ($key === "creado") continue;
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

    public function sync($args = [])
    {

        foreach ($args as $key => $value) {

            $this->$key = $value;
        }
    }

    //Validacion
    public static function getErrores()
    {
        return static::$errores;
    }

    public function validar()
    {

        static::$errores = [];







        return static::$errores;
    }



    public static function filter($column, $operator, $value)
    {

        $query = "SELECT * FROM " . static::$tabla . " WHERE $column $operator '$value'";

        $resultado = self::consultarSQL($query);

        return $resultado;
    }
}
