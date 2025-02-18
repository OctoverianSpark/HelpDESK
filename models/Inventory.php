<?php

namespace Models;

class Inventory extends ActiveRecord
{

    protected static $schema = "ti";

    protected static $tabla = "inv";

    protected static $columnasDB =
    [
        "id",
        "user_id",
        "nombre",
        "apellido",
        "tipo_documento",
        "documento",
        "telefono",
        "correo",
        "tipo",
        "marca",
        "modelo",
        "color",
        "nombre_equipo",
        "serial",
        "correo_dominio",
        "usuarioPC",
        "propietario",
        "anydesk",
        "password_anydesk",
        "sede"
    ];



    public static function all()
    {

        $query = "SELECT * FROM ti.inv as i ORDER BY id DESC";


        $result = self::consultarSQL($query);

        $result = self::findUser($result);

        return $result;


    }


    public function setStock(){


        $query = "UPDATE " . static::$tabla . " SET user_id = 0 WHERE id=$this->id";

        static::$db->query($query);

    }

    
    public function atributos(){
        $atributos = [];
        foreach(static::$columnasDB as $col){

            if($this->$col == null) continue;

            $atributos[$col] = $this->$col;



        }
        return $atributos;
    }


    public static function find($id){
        
        $query = "SELECT * FROM ti.inv WHERE id = $id";
        
        
        $resultado = self::consultarSQL($query);
        
        $resultado = self::findUser($resultado);
        $resultado = array_shift( $resultado );

        return $resultado;
    }

    public static function filter($columna,$operador,$valor){

        $query = "SELECT * FROM ti.inv as i WHERE $columna $operador '$valor' order by id DESC";

        $result = self::consultarSQL($query);

        $result = self::findUser($result);

        return $result;
    }


    protected static function findUser($object = []){

        foreach ($object as $data) {
            
            if ($data->user_id === "0") {
                $data->nombre = strtoupper("STOCK");
                $data->correo = strtoupper("Sin asignar");
                $data->telefono = strtoupper("Sin asignar");
                $data->tipo_documento = strtoupper("Sin asignar");
                $data->documento = strtoupper("Sin asignar");
            }else{
                $info = Personal::PIVOTFINDER($data->user_id,$data->sede);
    
                $data->nombre = $info->nombre;
                $data->apellido = $info->apellido;
                $data->correo = $info->correo;
                $data->telefono = $info->telefono;
                $data->tipo_documento = $info->tipo_documento;
                $data->documento = $info->documento;

            }


        }
        return $object;
    }

}
