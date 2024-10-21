<?php

namespace Models;


class Tecnicos extends ActiveRecord{
    
    protected static $columnasDB = ["id","nombre","apellido","correo","cargo"];


    protected static $tabla = "tecnico";

    public $id;
    public $nombre;
    public $apellido;
    public $correo;

    public $cargo;

    public function __construct($args= []){

        $this->id = $args["id"] ?? null;
        $this->nombre = $args["nombre"] ?? "";
        $this->apellido = $args["apellido"] ?? "";
        $this->correo = $args["correo"] ?? "";
        $this->cargo = $args["cargo"] ?? "";

    }


    public static function searchByName($nombre){
        $query = "SELECT * FROM " . static::$tabla . " WHERE CONCAT(nombre,' ',apellido) LIKE '%$nombre%'";

        $resultado = self::consultarSQL($query);

        return array_shift( $resultado );
    }

    public static function all(){
        $query = "SELECT * FROM " . static::$tabla . " ORDER BY id DESC";
        $resultado = self::consultarSQL($query);

        return $resultado;
    }
    public static function getTecnicals(){
        $query = "SELECT * FROM " . static::$tabla . " where cargo = 'ATI' ORDER BY id DESC";
        $resultado = self::consultarSQL($query);

        return $resultado;
    }

}