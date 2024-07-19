<?php




namespace Models;



class Entradas extends ActiveRecord{


    protected static $columnasDB = ["id","fecha","titulo","contenido","imagen","tipo","mostrar","cargado_por"];

    protected static $tabla = "entradas";

    public $id;
    public $fecha;
    public $titulo;
    public $contenido;
    public $imagen;
    public $tipo;
    public $mostrar;
    public $cargado_por;



    public function __construct($args=[]){

        $this->id = $args["id"] ?? null;
        $this->fecha = $args["fecha"] ?? date("Y-m-d H:i:s");
        $this->titulo = $args["titulo"]?? "";
        $this->contenido = $args["contenido"] ?? "";
        $this->imagen = $args["imagen"] ?? null;
        $this->tipo = $args["tipo"] ?? "";
        $this->mostrar = $args["mostrar"] ?? "si";
        $this->cargado_por = $_SESSION["name"];

    }



    public static function getNovedades(){

        $query = "SELECT * FROM " . self::$tabla . " WHERE tipo = 'novedad' and mostrar='si'";
        
        $resultado = self::consultarSQL($query);


        return $resultado;

    }
    public static function getRecomendaciones(){

        $query = "SELECT * FROM " . self::$tabla . " WHERE tipo = 'recomendacion' and mostrar='si'";
        
        $resultado = self::consultarSQL($query);


        return $resultado;

    }

    



}











?>