<?php 




namespace Models;



class Personal extends ActiveRecord{

    protected static $schema = "rh";

    protected static $tables = ["avsas","avca","ops"];

    protected static $columnasDB = 
    [
        "id",
        "nombre",
        "apellido",
        "tipo_documento",
        "documento",
        "telefono",
        "correo",
        "cargo",
        "area"
    ];


    public static function all(){

        $results  = [];

        foreach (static::$tables as $table) {
            
            $query = "SELECT * FROM " . static::$schema . ".$table"  . " ORDER BY id DESC";
            $resultado = static::consultarSQL($query);
            
            foreach($resultado as $r){

                $results[] = $r;
            }

        }

        return $results;


    }

    public static function separateAll(){
        
        $resultado = [];

        foreach (static::$tables as $table) {
            
            $query = "SELECT * FROM " . static::$schema . ".$table"  . " ORDER BY id DESC";
            $resultado[$table] = static::consultarSQL($query);
            

        }

        return $resultado;

    }

    


    public static function PIVOTFINDER($id,$table){

        $query = "SELECT * FROM " . static::$schema . ".$table" . " WHERE id = '$id'";
        $resultado = self::consultarSQL($query);

        

        return array_shift($resultado);

    }


}
