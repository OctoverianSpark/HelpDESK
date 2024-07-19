<?php





namespace Models;



class Comments extends ActiveRecord{




    
    protected static $columnasDB = ["id","ticket_id","fecha","comentario","cargado_por"];

    protected static $tabla = "comments";


    public $id;
    public $ticket_id;
    public $fecha;
    public $comentario;
    public $cargado_por;


    public function __construct($args = []){

        $this->id = $args["id"] ?? null;
        $this->ticket_id = $args["ticket_id"] ?? null;
        $this->fecha = $args["fecha"] ?? date("Y/m/d h:i:s");
        $this->comentario = $args["comentario"] ?? "";
        $this->cargado_por = $args["cargado_por"] ?? "";

    }



    
    public static function history($id){

        $query = "SELECT * FROM " . static::$tabla . " WHERE ticket_id = $id ";


        $resultado = self::consultarSQL($query);
        
        return  $resultado;
    }



}













?>