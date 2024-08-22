<?php


namespace Models;


class  Notificaciones extends ActiveRecord{


    protected static $columnasDB = ["id","fecha","titulo","contenido","destinatario","mostrado","url"];
    protected static $tabla = "notificaciones";

    public $id,$fecha,$titulo,$contenido,$destinatario,$mostrado,$url;
    public function __construct($args =[]){

        $this->id  = $args["id"]?? null;
        $this->fecha = date("Y-m-d H:i:s");
        $this->titulo  = $args["titulo"]?? "";
        $this->contenido  = $args["contenido"]?? "";
        $this->destinatario  = $args["destinatario"]?? "";
        $this->mostrado  = $args["mostrado"]?? "no";
        $this->url  = $args["url"]?? "";

    }

    public function setShowed($id){
        $query = "UPDATE ". static::$tabla . " SET mostrado = 'si' WHERE id = $id";


        self::$db->query($query);
    }

    public static function getUnshowed($user){
        $query = "SELECT * FROM ". static::$tabla . " WHERE mostrado = 'no'";


        if($user === "admin"){
            $query .=  " AND destinatario = 'admin'";
        }else{
            $query .=  " AND destinatario = '$user'";
        }
        


        $data = self::consultarSQL($query);

        return $data;

    }
    public static function getAdminUnshowed($user){
        $query = "SELECT * FROM ". static::$tabla . " WHERE mostrado = 'no' AND (destinatario= '$user' OR destinatario = 'admin') ";

        

        $data = self::consultarSQL($query);
        
        return $data;

    }

    
    public static function getAll($user){

        $query = "SELECT * FROM " . static::$tabla . " WHERE destinatario = '$user' ORDER BY fecha DESC";



        $resultado = self::consultarSQL($query);


        return $resultado;


    }

    public static function getAdmins($user){
        $query = "SELECT * FROM " . static::$tabla . " WHERE destinatario = '$user' OR destinatario = 'admin' ORDER BY fecha DESC";


        $resultado = self::consultarSQL($query);


        return $resultado;

    }

}









?>
