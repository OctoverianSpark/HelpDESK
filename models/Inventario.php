<?php



namespace Models;


class Inventario extends ActiveRecord{

    
    protected static $columnasDB = ["id","nombre","apellido","tipo_documento","documento","telefono","anydesk","password_anydesk","tipo","marca","modelo","color","nombre_equipo","serial","usuarioPC","correo","propietario","sede"];


    protected static $tabla = "inventario";
    
    protected static $errores = [];

    public $id,$nombre,$apellido,$tipo_documento,$documento,$telefono,$anydesk,$password_anydesk,$tipo,$marca,$modelo,$color,$serial,$nombre_equipo,$usuarioPC,$correo,$propietario,$sede;


    public function __construct($args = []){
        $this->id = $args["id"] ?? null;
        $this->nombre = $args["nombre"] ?? "";
        $this->apellido = $args["apellido"] ?? "";
        $this->tipo_documento = $args["tipo_documento"] ?? "";
        $this->documento = $args["documento"] ?? "";
        $this->telefono = $args["telefono"] ?? "";
        $this->anydesk = $args["anydesk"] ?? "";
        $this->password_anydesk = $args["password_anydesk"] ?? "";
        $this->tipo = $args["tipo"] ?? "";
        $this->marca = $args["marca"] ?? "";
        $this->modelo = $args["modelo"] ?? "";
        $this->color = $args["color"] ?? "";
        $this->nombre_equipo = $args["nombre_equipo"] ?? "";
        $this->serial = $args["serial"] ?? "";
        $this->correo = $args["correo"] ?? "";
        $this->usuarioPC = $args["usuarioPC"] ?? "";
        $this->propietario = $args["propietario"] ?? "";
        $this->sede = $args["sede"] ?? "";
    }


    public static function search($mail=null,$user=null,$pcname=null){


        if(!is_null($mail)){
            $query = "SELECT * FROM " . self::$tabla . " WHERE correo = '$mail'";
    
            $resultado = self::consultarSQL($query);

        }else if(!is_null($pcname)){

            $query = "SELECT * FROM " . self::$tabla . " WHERE nombre_equipo = '$pcname'";

            $resultado = self::consultarSQL($query);
            return array_shift($resultado);
            
        }
        else{

            $query = "SELECT * FROM " . self::$tabla . " WHERE usuarioPC = '". $user ." '" ;

            $resultado = self::consultarSQL($query);
        }

        

        return $resultado;


    }


    public function validar(){

        if(!$this->nombre || !$this->apellido){
            self::$errores[] = "Los campos nombre y apellido no pueden estar vacios";
        }
        if(!$this->tipo_documento || !$this->documento){
            self::$errores[] = "El documento del asistente es obligatorio, debes registrar ambos cambos";
        }
        if(!$this->correo){
            self::$errores[] = "El correo es obligatorio, cada asistente al entrar se le crea un correo corporativo";
        }
        if(!$this->nombre_equipo){
            self::$errores[] = "Cada computador tiene un nombre asignado, no puede estar en blanco";
        }
        if(!$this->tipo){
            self::$errores[] = "Define el tipo de equipo";
        }
        if(!$this->marca){
            self::$errores[] = "Debes colocar la marca del equipo";
        }
        if(!$this->modelo){
            self::$errores[] = "Debes colocar el modelo del equipo";
        }
        if(!$this->color){
            self::$errores[] = "Debes colocar el color del equipo";
        }
        if(!$this->serial){
            self::$errores[] = "Debes colocar el serial del equipo, cada equipo tiene un codigo serial que debes ingresar";
        }
        if(!$this->usuarioPC){
            self::$errores[] = "El computador debe tener un usuario de dominio";
        }

        return self::$errores;



    }

    
    public static function getInventory($column = null,$param = null){
        
        if ($column == "nombre") {
            $query  = "SELECT * FROM ". static::$tabla . " WHERE CONCAT(nombre,' ',apellido) LIKE '%$param%'";
            $resultado = self::consultarSQL($query);
    
            return $resultado;
            


        }else{
            $query  = "SELECT * FROM ". static::$tabla . " WHERE $column LIKE '%$param%'";
            $resultado = self::consultarSQL($query);
            return $resultado;

        }





    }


}



?>