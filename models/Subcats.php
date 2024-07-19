<?php


namespace Models;


class Subcats extends ActiveRecord{


    protected static $columnasDB = ["id","subcategoria","categoria"];
    protected static $tabla = "subcats";
    public $id;
    public $subcategoria;
    public $categoria;

    

    public function __construct($args = []){

        $this->id = $args["id"] ?? null;
        $this->subcategoria = $args["subcategoria"] ?? "";
        $this->categoria = $args["categoria"] ?? "";



    }


    public static function getSubs($cat){
        $query = "SELECT * FROM " . static::$tabla . " WHERE categoria = " . "'$cat'";

        $resultado = self::consultarSQL($query);

        return $resultado;
    }

}