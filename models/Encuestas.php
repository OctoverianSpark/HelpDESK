<?php


namespace Models;



class Encuestas extends ActiveRecord
{



    protected static $columnasDB = ["id", "date", "name", "area", "individual_test", "general_test", "suggestions"];


    protected static $tabla = "encuestas";


    protected static function crearObjeto($registro)
    {
        $objeto = new static;


        foreach ($registro as $key => $value) {
            if (property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }

        return $objeto;
    }
}
