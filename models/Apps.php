<?php


namespace Models;


class Apps extends ActiveRecord{


    protected static $columnasDB = ["id","app"];
    protected static $tabla = "apps";
    public $id;
    public $app;

    
}