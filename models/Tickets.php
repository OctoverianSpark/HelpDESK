<?php

namespace Models;


class Tickets extends ActiveRecord{
    
    protected static $columnasDB = ["id","fecha","usuario","categoria","subcategoria","descripcion","anydesk","imagen","estado","tecnico_id","fecha_asignada","fecha_pendiente","fecha_completacion","tiempo_en_asignar","tiempo_en_pendiente","tiempo_en_completar"];


    protected static $tabla = "tickets";


    public $id;
    public $fecha;
    public $usuario;
    public $categoria;

    public $subcategoria;
    public $descripcion;
    public $anydesk;
    public $imagen;
    public $estado;
    public $tecnico;
    public $fecha_asignada;
    public $fecha_pendiente;
    public $fecha_completacion;
    public $tiempo_en_asignar;
    public $tiempo_en_pendiente;
    public $tiempo_en_completar;
    public $tecnico_id;




    public function __construct($args=[]){
        $this->id = $args["id"] ?? null;
        $this->fecha = date("Y/m/d h:i:s");
        $this->usuario = $args["usuario"] ?? "";
        $this->categoria = $args["categoria"] ?? null;
        $this->subcategoria = $args["subcategoria"];
        $this->descripcion = $args["descripcion"] ?? "";
        $this->anydesk = $args["anydesk"] ?? "";
        $this->imagen = $args["imagen"] ?? "";
        $this->estado = $args["estado"] ?? "";
        $this->tecnico = $args["tecnico"] ?? "";
        $this->fecha_asignada = $args["fecha_asignada"] ?? null;
        $this->fecha_pendiente = $args["fecha_pendiente"] ?? null;
        $this->fecha_completacion = $args["fecha_completacion"] ?? null;
        $this->tiempo_en_asignar = $args["tiempo_en_asignar"] ?? null;
        $this->tiempo_en_pendiente = $args["tiempo_en_pendiente"] ?? null;
        $this->tiempo_en_completar = $args["tiempo_en_completar"] ?? null;
        $this->tecnico_id = $args["tecnico_id"] ?? "4";


    }

    public static function getJoin($limite = 0){
        $query = "SELECT " . static::$tabla . ".*,CONCAT(nombre,' ', apellido) as tecnico FROM ". static::$tabla;
        $query .= " INNER JOIN tecnico on tecnico_id = tecnico.id";
        if ($limite >0){
            $query .= " LIMIT $limite";


        }

        $resultado = static::consultarSQL($query);
        return $resultado;
    }

    public static function findJoin($id){

        $query = "SELECT " . static::$tabla . ".*, CONCAT(nombre,' ', apellido) as tecnico FROM ". static::$tabla;
        $query .= " INNER JOIN tecnico on tecnico_id = tecnico.id";
        $query .= " WHERE " . static::$tabla .".id = $id";
        $resultado = self::consultarSQL($query);

        return array_shift( $resultado );
    }
    public static function findJoinbyData($id,$userData){

        $query = "SELECT " . static::$tabla . ".id ,fecha,usuario, ". static::$tabla .".categoria,subcategoria, CONCAT(nombre,' ', apellido) as tecnico,descripcion,estado,imagen FROM ". static::$tabla;
        $query .= " INNER JOIN tecnico on tecnico_id = tecnico.id";
        $query .= " WHERE " . static::$tabla .".id = $id AND usuario = '$userData'";
        $resultado = self::consultarSQL($query);
        return array_shift( $resultado );
    }
    public static function findJoinbyUser($userData,$limit=0){

        $query = "SELECT " . static::$tabla . ".id ,fecha,usuario, ". static::$tabla .".categoria,subcategoria, CONCAT(nombre,' ', apellido) as tecnico,descripcion,estado,imagen FROM ". static::$tabla;
        $query .= " INNER JOIN tecnico on tecnico_id = tecnico.id";
        $query .= " WHERE usuario LIKE '%$userData%'";


        if($limit>0){

            $query.= " LIMIT $limit";

        }

        $resultado = self::consultarSQL($query);
        

        return $resultado  ;
    }



    public static function filter($column = null, $param =null){
        
        if($column === null || $param === null){

            $resultado = static::getJoin();
            
        }else{
            $query = "SELECT " . static::$tabla . ".id ,fecha,usuario, ". static::$tabla .".categoria,subcategoria, CONCAT(nombre,' ', apellido) as tecnico,anydesk,descripcion,estado,imagen FROM ". static::$tabla;
            $query .= " INNER JOIN tecnico on tecnico_id = tecnico.id";
            $query .= " WHERE $column LIKE '%$param%'";
            $resultado = self::consultarSQL($query);
            
        }

        return $resultado  ;



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
    public function actualizar(){
        
        $atributos = $this->sanitizarAtributos();


        $valores = [];

        foreach($atributos as $key=>$value){
            if ($atributos[$key] === null || $atributos[$key] === "" || $key == "fecha") continue;
            $valores[] = "$key='$value'";
        }

        $query = "UPDATE ". static::$tabla." SET "  ;
        $query.= join(",",$valores);
        $query.= " WHERE id = '". self::$db->escape_string($this->id) . "'";
        $query.= " LIMIT 1";

        $resultado = self::$db->query($query);

        return $resultado;


    }


    public function validar(){
        
        if(!$this->descripcion){
            static::$errores[] = "Debes de colocar una descripcion";
        }
        if (!$this->subcategoria) {
            static::$errores[] = "No puedes enviar un asunto vacio";
        }
        return static::$errores;


    }





}







?>