<?php




namespace Controllers;

use MVC\Router;

use Models\Inventory;
use Models\Perifericos;
use Models\Ordenes;
use Models\Personal;
use Models\Users;

class  OrderController{




    public static function index(Router $router){
        
        $orders = Ordenes::all();
        $router->render("admin/inventario/ordenes/index",[
            "orders"=>$orders,
        ]);
    }

    public static function orden(Router $router){


        $router->render("admin/inventario/ordenes/orden",[
        ]);
    
    
    }

    public static function crear(Router $router){

        $inv = Inventory::all();
        $users = Personal::separateAll();
        
        $orders = Ordenes::filter("state","=","pendiente");
        
        foreach($orders as $order){

        }

        $router->render("/admin/inventario/ordenes/crear",[
            "inv"=>$inv,
            "users"=>$users[$_GET["sede"]],
            "orders"=>$orders
        ]);



    }
    public static function print(Router $router){

        $computer_id = filter_var($_POST["computer"],FILTER_VALIDATE_INT);
        $user_id = filter_var($_POST["user"],FILTER_VALIDATE_INT);
        $emission_date = date("Y-m-d",strtotime($_POST["emitted-date"]));
        if ($_POST["type"] === "entrega") {
            
            $eq = Inventory::find($computer_id);
            $usr = Personal::PIVOTFINDER($user_id,$_POST["sede"]);
            $orderCount = count(Ordenes::filter("order_id","LIKE","ODE#%"));
            
            $args = [
                "order_id"=>"ODE#".($orderCount === 0 ? 1 : ++$orderCount),
                "user_id"=>$usr->id,
                "computer_id"=>$eq->id,
                "description"=>"Ordenada por correo",
                "emitted_date"=>$emission_date,
                "return_date"=>"no return",
                "state"=>"generada"

            ];

            $pers= $_POST["pers"];

            $order = new Ordenes($args);


        }if($_POST["type"] === "salida"){

            $order = Ordenes::filter("order_id","=",$_POST["order_id"]);
            
            $order = array_shift($order);

            $args = ["state"=>"generada"];
            $order->sync($args);
            $eq = Inventory::find($order->computer_id);
            $usr = Personal::PIVOTFINDER($order->user_id,"avsas");

            $pers = $_POST["pers"];



        }if($_POST["type"] === "recepcion"){

            $eq = Inventory::find($computer_id);
            $usr = Personal::PIVOTFINDER($user_id,$_POST["sede"]);
            $orderCount = count(Ordenes::filter("order_id","LIKE","ODR#%"));
            
            $args = [
                "order_id"=>"ODR#".($orderCount === 0 ? 1 : ++$orderCount),
                "user_id"=>$usr->id,
                "computer_id"=>$eq->id,
                "description"=>"Ordenada por correo",
                "emitted_date"=>$emission_date,
                "return_date"=>"No Return",
                "state"=>"generada"

            ];
            $pers= $_POST["pers"];

            $order = new Ordenes($args);


        }

        $order->guardar();


        $router->render("pages/ordenes/orden",[
            "eq"=>$eq,
            "usr"=>$usr,
            "pers"=>$pers,
            "order"=>$order,
            "type"=>$_POST["type"],
        ]);
        




            

    }


}






?>