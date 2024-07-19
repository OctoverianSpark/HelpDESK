<?php


namespace Models;


class Apps extends ActiveRecord{


    protected static $columnasDB = ["id","app"];
    protected static $tabla = "apps";
    public $id;
    public $app;

    

    public function __construct($args = []){

        $this->id = $args["id"] ?? null;
        $this->app = $args["app"] ?? "";



    }

}