<?php 

namespace Models;



class Ordenes extends ActiveRecord{

    
    protected static $columnasDB = ["id","fecha","tipo","nombre","fecha_salida","fecha_retorno","equipo","descripcion","estado","observaciones"];
    protected static $tabla = "ordenes";

    public $id,$fecha,$tipo,$nombre,$fecha_salida,$fecha_retorno,$equipo,$descripcion,$estado,$observaciones;
    public function __construct($args=[]){

            $this->id = $args["id"] ?? null;

            $this->fecha = date("Y/m/d H:i:s");

            $this->tipo = $args["tipo"] ?? "salida";

            $this->nombre = $args["nombre"] ?? $_SESSION["name"];

            $this->fecha_salida = $args["fecha_salida"]?? null;

            $this->fecha_retorno = $args["fecha_retorno"]?? null;

            $this->equipo = $args["equipo"] ?? "";

            $this->descripcion = $args["descripcion"] ?? "";

            $this->estado = $args["estado"] ?? "pendiente";

            $this->observaciones = $args["observaciones"] ?? "";

    }
    public function validar(){


        self::$errores = [];


        if(!$this->descripcion){
            self::$errores[] = "Debes colocar una descripcion a tu solicitud";
        }
        if(!$this->fecha_salida ){
            self::$errores[] = "Debes colocar una la fecha de tu salida";

        }
        if(!$this->fecha_retorno ){
            self::$errores[] = "Debes colocar una la fecha de retorno";

        }


        return self::$errores;

    }   




}








?>