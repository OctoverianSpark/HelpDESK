<?php

namespace Models;


class Encuestas extends ActiveRecord{
        
    protected static $columnasDB = ["id","ticket_id","resolucion","asertividad","rapidez","calidad","promedio","comentarios","creado","vencimiento","estado","subcategoria","usuario"];


    protected static $tabla = "encuestas";


    public $id;
    public $ticket_id;
    public $resolucion;
    public $asertividad;
    public $rapidez;
    public $calidad;
    public $comentarios;
    public $creado;
    public $vencimiento;
    public $estado;
    public $promedio;

    public $subcategoria;

    public $usuario;

    public function __construct($args=[]){
        $this->id = $args["id"] ?? null;
        $this->ticket_id = $args["ticket_id"] ?? null;
        $this->resolucion = $args["resolucion"] ?? null;
        $this->asertividad = $args["asertividad"] ?? null;
        $this->rapidez = $args["rapidez"] ?? null;
        $this->calidad = $args["calidad"] ?? null;
        $this->comentarios =$args["comentarios"];
        $this->creado = date("Y/m/d h:i:s");
        $this->vencimiento = date_format(date_add(date_create_from_format("Y/m/d h:i:s",date("Y/m/d h:i:s")),date_interval_create_from_date_string('24 hour')),"Y/m/d h:i:s");
        $this->estado = $args["estado"] ?? "pendiente";
        $this->promedio = $args["promedio"];


    }


    public function crear(){

        //Sanitizar
        $atributos = $this->sanitizarAtributos();
        $finalAttrib = [];
        
        foreach($atributos as $key => $value):
            if ($atributos[$key] === null || $atributos[$key] === "") continue;
            $finalAttrib[$key] = $value;
                
            
        endforeach;

        //Insercion
        $query = "INSERT INTO ". static::$tabla ." ("  ;
        $query .= join(", ",array_keys($finalAttrib));
        $query .= ")VALUES ('";
        $query .= join("' , '",array_values($finalAttrib));
        $query.= "')";
        
        $resultado = self::$db->query($query);

        return $resultado;
    }




    public static function findPendings($limit=1,$where=null){
        $actualDate = date("Y-m-d H:i:s");


        $query = "SELECT * FROM " . static::$tabla . " WHERE vencimiento <= '$actualDate' AND estado = 'pendiente' ";

        
        $resultado = self::consultarSQL($query);

        return $resultado;

    }

    public static function findPendingsByUser($ticket_id){
        $actualDate = date("Y-m-d H:i:s");


        $query = "SELECT * FROM " . static::$tabla . " WHERE ticket_id=$ticket_id";

        
        $resultado = self::consultarSQL($query);

        return array_shift( $resultado );
    }

    protected static function allPendings(){
        

        $query = "SELECT * FROM " . static::$tabla . " WHERE estado is null";
        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    public static function setUncompleted(){

        $encuestas = static::allPendings();



        foreach($encuestas as $encuesta){

            $actualidad = date_create_from_format("Y/m/d h:i:s",date("Y/m/d h:i:s"));
            $vencimiento = date_create($encuesta->vencimiento);
            if($actualidad > $vencimiento){
                $query = "UPDATE ". static::$tabla . " SET estado = 'vencida' WHERE id = $encuesta->id";
                $resultado = self::$db->query($query);

            }

            
        }

        

    }

    
    public static function getJoin($limite = 0){
        $query = "SELECT " . static::$tabla . ".id, ticket_id,resolucion,asertividad,rapidez,calidad,promedio,". static::$tabla .".comentarios,creado,vencimiento,". static::$tabla .".estado, subcategoria, usuario  FROM ". static::$tabla;
        $query .= " INNER JOIN tickets on ticket_id = tickets.id";
        if ($limite >0){
            $query .= " LIMIT $limite";


        }

        $resultado = static::consultarSQL($query);
        return $resultado;
    }
    public static function getJoinbyState($limite = 0,$estado){
        $query = "SELECT " . static::$tabla . ".id, ticket_id,resolucion,asertividad,rapidez,calidad,promedio,". static::$tabla .".comentarios,creado,vencimiento,". static::$tabla .".estado, subcategoria, usuario  FROM ". static::$tabla;
        $query .= " INNER JOIN tickets on ticket_id = tickets.id";
        $query .= " WHERE " . static::$tabla . ".estado = '$estado'";
        if ($limite >0){
            $query .= " LIMIT $limite";


        }

        $resultado = static::consultarSQL($query);
        return $resultado;
    }

    
    public static function findJoin($id){
        $query = "SELECT " . static::$tabla . ".*  FROM ". static::$tabla;
        $query .= " INNER JOIN tickets on ticket_id = tickets.id WHERE ticket_id = $id";


        $resultado = static::consultarSQL($query);
        return array_shift($resultado);
    }






}




?>