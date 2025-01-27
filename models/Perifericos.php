<?php



namespace Models;


class Perifericos extends ActiveRecord{

    
    protected static $columnasDB = ["id","tipo","marca","modelo","color","serial","computer_id"];

    protected static $tabla = "perifericos";



    public static function findGroup($id){

        $query = "SELECT * FROM " . static::$tabla . " WHERE computer_id = '$id'";
        $resultado = self::consultarSQL($query);
        
        return $resultado;



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