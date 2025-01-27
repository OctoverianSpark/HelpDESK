<?php



namespace Models;


class ObjectCreator{



    protected static function crearObjeto($registro){
        $objeto = new static;
        

        foreach ($registro as $key => $value) {
            if(property_exists( $objeto, $key ) ){
                $objeto->$key = strtoupper($value);
            }
        }

        return $objeto;
    }


}




?>