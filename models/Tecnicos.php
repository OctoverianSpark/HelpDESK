<?php

namespace Models;


class Tecnicos extends ActiveRecord{
    
    protected static $columnasDB = ["id","nombre","apellido","correo"];


    protected static $tabla = "tecnico";

    public $id;
    public $nombre;
    public $apellido;
    public $correo;

    public function __construct($args= []){

        $this->id = $args["id"] ?? null;
        $this->nombre = $args["nombre"] ?? "";
        $this->apellido = $args["apellido"] ?? "";
        $this->correo = $args["correo"] ?? "";

    }


    public static function searchByName($nombre){
        $query = "SELECT * FROM " . static::$tabla . " WHERE CONCAT(nombre,' ',apellido) LIKE '%$nombre%'";

        $resultado = self::consultarSQL($query);

        return array_shift( $resultado );
    }


}