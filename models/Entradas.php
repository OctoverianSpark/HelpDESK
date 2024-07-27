<?php




namespace Models;



class Entradas extends ActiveRecord{


    protected static $columnasDB = ["id","fecha","titulo","contenido","imagen","tipo","mostrar","cargado_por"];

    protected static $tabla = "entradas";

    public $id;
    public $fecha;
    public $titulo;
    public $contenido;
    public $imagen;
    public $tipo;
    public $mostrar;
    public $cargado_por;



    public function __construct($args=[]){

        $this->id = $args["id"] ?? null;
        $this->fecha = $args["fecha"] ?? date("Y-m-d H:i:s");
        $this->titulo = $args["titulo"]?? "";
        $this->contenido = $args["contenido"] ?? "";
        $this->imagen = $args["imagen"] ?? null;
        $this->tipo = $args["tipo"] ?? "";
        $this->mostrar = $args["mostrar"] ?? "si";
        $this->cargado_por = $_SESSION["name"];

    }



    public static function getNovedades($limit = 0){

        $query = "SELECT * FROM " . self::$tabla . " WHERE tipo = 'novedad' and mostrar='si'";
        if($limit >0){
            $query .= " LIMIT $limit";
        }

        
        $resultado = self::consultarSQL($query);
        
        return $resultado;

    }
    public static function getRecomendaciones($limit = 0){

        $query = "SELECT * FROM " . self::$tabla . " WHERE tipo = 'recomendacion' and mostrar='si'";
        if($limit >0){
            $query .= " LIMIT $limit";
        }
        
        $resultado = self::consultarSQL($query);
        

        return $resultado;

    }

    public static function randomizeEntries($limit = 0){

        $noveltiesCount = count(static::getNovedades()) - 1;
        $recomendationsCount = count(static::getRecomendaciones()) - 1;


        $allNovelties = static::getNovedades();
        $allRecoms = static::getRecomendaciones();
        


        $recomendations = [];
        $novelties = [];
        $i = 1;

        do{ 
            $novIndex = rand(0,$noveltiesCount);
            $recIndex = rand(0,$recomendationsCount);
            
            
            $noveltie = $allNovelties[$novIndex];
            $recomendation = $allRecoms[$recIndex];






            $novelties[] = $noveltie;


            $recomendations[] = $recomendation;

            

            unset($allNovelties[$novIndex]);
            unset($allRecoms[$recIndex]);

            sort($allNovelties);
            sort($allRecoms);




            $recomendationsCount--;
            $noveltiesCount--;

            $i++;
        }while($i <= $limit);

        
        $result = ["recomendaciones"=>$recomendations,
                   "novedades"=>$novelties];


        return $result;


    }



    


}











?>