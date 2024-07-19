<?php



namespace Controllers;

use MVC\Router;


use Models\Entradas;
use Intervention\Image\ImageManager as Manager;
use Intervention\Image\Drivers\Gd\Driver;

class EntrieController{

        
    public static function index(Router $router){
        
        $entradas =Entradas::all();
        $count=0;



        if($_SERVER["REQUEST_METHOD"] === "POST"){
            
            
            

            
            if(isset($_POST["entradas"])){
                $entrada = new Entradas($_POST["entradas"]);
                $datos = Entradas::find($_POST["entradas"]["id"]);
                $manager = new Manager(new Driver());

                
                $png =CARPETA_SRC."/".$datos->imagen . ".png";
                $webp = CARPETA_SRC."/".$datos->imagen . ".webp";
                
                unlink($png);
                unlink($webp);


                

                


                $entrada->eliminar();
    
                header("Location: /admin/entradas");

            }else if(isset($_POST["entrada"])){

                $entrada= new Entradas($_POST["entrada"]);

                $entrada->mostrar = (isset($_POST["entrada"]["mostrar"]))? "si":"no";


                $entrada->actualizar();


                header("Location: /admin/entradas");



            }

        }




        $router->render("admin/entradas/index",[
            "entradas"=>$entradas,
            "count"=>$count
        ]);
    }


    public static function crear(Router $router){
        $manager = new Manager(new Driver());
        



        

        if ($_SERVER["REQUEST_METHOD"] == "POST") {


            $entrada = new Entradas($_POST["entrada"]);


            $errores = $entrada->validar();
            
            
            if (!is_dir(CARPETA_IMAGENES)) {
                mkdir(CARPETA_IMAGENES);
            }
            
            
            if (empty($errores)) {


                $nombreImagen = md5(uniqid(rand(),true));

                if($_FILES["entrada"]["tmp_name"]["imagen"]){
                    $image = $manager->read($_FILES["entrada"]["tmp_name"]["imagen"]);
                    $image->resize(width: 500,height:500);


                    $image->toPng()->save(CARPETA_SRC . "/$nombreImagen" . ".png");
                    $image->toWebp()->save(CARPETA_SRC . "/$nombreImagen" . ".webp");
                    $entrada->setImagen($nombreImagen);

                }



                $entrada->guardar();

                
                header("Location: /admin/entradas?resultado=1");
            }



        }





        $router->render("admin/entradas/crear");

    }


    public static function actualizar(Router $router){

        $id = validarID();
        $entrada = Entradas::find($id);
        
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            
            $entradas = new Entradas($_POST["entrada"]);
            if(!isset($_FILES["entrada"]["tmp_name"]["imagen"])){


                $entradas->guardar();

            }else{
                $manager = new Manager(new Driver());


                $png =CARPETA_SRC."/".$entrada->imagen . ".png";
                $webp = CARPETA_SRC."/".$entrada->imagen . ".webp";
                
                unlink($png);
                unlink($webp);

                $nombreImagen = md5(uniqid(rand(),true));

                if($_FILES["entrada"]["tmp_name"]["imagen"]){
                    $image = $manager->read($_FILES["entrada"]["tmp_name"]["imagen"]);
                    $image->resize(width: 500,height:500);


                    $image->toPng()->save(CARPETA_SRC . "/$nombreImagen" . ".png");
                    $image->toWebp()->save(CARPETA_SRC . "/$nombreImagen" . ".webp");
                    $entradas->setImagen($nombreImagen);

                }
                $entradas->guardar();



            }








        }

        $router->render("admin/entradas/actualizar",[
            "entrada"=>$entrada
        ]);


        
    }


}




?>