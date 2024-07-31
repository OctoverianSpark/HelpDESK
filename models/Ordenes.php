<?php 

namespace Models;



class Ordenes extends ActiveRecord{

    
    protected static $columnasDB = ["id","tipo","nombre","equipo","descripcion","estado"];
    protected static $tabla = "ordenes";

    public $id,$tipo,$nombre,$equipo,$descripcion,$estado;
    public function __construct($args=[]){

            $this->id = $args["id"] ?? null;

            $this->tipo = $args["tipo"] ?? "";

            $this->nombre = $args["nombre"] ?? "";

            $this->equipo = $args["equipo"] ?? "";

            $this->descripcion = $args["descripcion"] ?? "";

            $this->estado = $args["estado"] ?? "";



    }





}







?>