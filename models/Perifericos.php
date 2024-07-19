<?php



namespace Models;


class Perifericos extends ActiveRecord{

    
    protected static $columnasDB = ["id","tipo","marca","modelo","color","serial","computer_id"];

    protected static $tabla = "perifericos";

    public $id,$tipo,$marca,$modelo,$color,$serial,$computer_id;


    public function __construct($args=[]){


        $this->id = $args["id"] ?? null;
        $this->tipo = $args["tipo"] ?? null;
        $this->marca = $args["marca"] ?? null;
        $this->modelo = $args["modelo"] ?? null;
        $this->color = $args["color"] ?? null;
        $this->serial = $args["serial"] ?? null;
        $this->computer_id = $args["computer_id"] ?? null;


    }


    public static function findGroup($id){

        $query = "SELECT * FROM " . static::$tabla . " WHERE computer_id = $id";
        $resultado = self::consultarSQL($query);

        return $resultado;



    }

    public function validar(){

        if(!$this->marca){
            self::$errores[] = "Debes colocar la marca del periferico";
        }
        if(!$this->modelo){
            self::$errores[] = "Debes colocar el modelo del periferico";
        }
        if(!$this->color){
            self::$errores[] = "Debes colocar el color del periferico";
        }
        if($this->tipo === "MONITOR" && !$this->serial){
            self::$errores[] = "Debes colocar el serial del equipo en caso de tenerlo";
        }


    }


    
    public function actualizar(){
        
        $atributos = $this->sanitizarAtributos();


        $valores = [];

        foreach($atributos as $key=>$value){
            $valores[] = "$key='$value'";
        }

        $query = "UPDATE ". static::$tabla." SET "  ;
        $query.= join(",",$valores);
        $query.= " WHERE computer_id = '". self::$db->escape_string($this->computer_id) . "' AND id = '". self::$db->escape_string($this->id) . "'";
        $query.= " LIMIT 1";

        $resultado = self::$db->query($query);

        return $resultado;


    }

    public function eliminar(){

        $query = "DELETE FROM ". static::$tabla . " where id = '$this->id'";

        self::$db->query($query);




    }
    public function deleteByGroup(){

        $query = "DELETE FROM ". static::$tabla . " where computer_id = '$this->computer_id'";

        self::$db->query($query);




    }




}



?>