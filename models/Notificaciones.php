<?php


namespace Models;


class  Notificaciones extends ActiveRecord{


    protected static $columnasDB = ["id","titulo","contenido","destinatario","mostrado"];
    protected static $tabla = "notificaciones";

    public $id,$titulo,$contenido,$destinatario,$mostrado;
    public function __construct($id=null,$titulo="",$contenido="",$destinatario="",$mostrado="no"){

        $this->id  = $id;
        $this->titulo  = $titulo;
        $this->contenido  = $contenido;
        $this->destinatario  = $destinatario;
        $this->mostrado  = $mostrado;
    }

    public function setShowed(){
        $query = "UPDATE ". static::$tabla . " SET mostrado = 'si' WHERE id = $this->id";


        self::$db->query($query);
    }

    public static function getUnshowed($user){
        $query = "SELECT * FROM ". static::$tabla . " WHERE mostrado = 'no'";


        if($user === "admin"){
            $query .=  " AND destinatario = 'admin'";
        }else{
            $query .=  " AND destinatario = '$user'";
        }
        

        $query .= "LIMIT 1";

        $data = self::consultarSQL($query);

        return array_shift($data);

    }







}






?>
