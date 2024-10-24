<?php
require_once  __DIR__."/../includes/app.php";

date_default_timezone_set("America/Bogota");

use Controllers\AdminController;
use Controllers\LoginController;
use Controllers\PagesController;
use Controllers\InventoryController;
use Controllers\TicketController;
use Controllers\PollController;
use Controllers\EntrieController;
use Controllers\OrderController;
use MVC\Router;
use Models\Encuestas;



    $router = new Router;

    Encuestas::setUncompleted();

    //Publicas
    $router->get("/",[PagesController::class,"index"]);
    $router->get("/ticket",[PagesController::class,"ticket"]);

    $router->get("/tickets/crear",[PagesController::class,"crear"]);
    $router->post("/tickets/crear",[PagesController::class,"crear"]);

    $router->get("/tickets/ver",[PagesController::class,"tickets"]);
    $router->get("/ordenes/ver",[PagesController::class,"ordenes"]);

    $router->get("/equipos",[PagesController::class,"equipos"]);
    $router->post("/equipos",[PagesController::class,"equipos"]);

    $router->get("/encuesta",[PagesController::class,"encuesta"]);
    $router->post("/encuesta",[PagesController::class,"encuesta"]);


    //Autenticacion
    $router->get("/login",[LoginController::class,"login"]);
    $router->post("/login",[LoginController::class,"login"]);

    $router->get("/redirect",[LoginController::class,"redirect"]);

    $router->get("/logout",[LoginController::class,"logout"]);



    /* Portal */
    
    $router->get("/admin",[AdminController::class,"index"]);
    $router->post("/admin",[AdminController::class,"index"]);

    /* * Inventario * */
    $router->get("/admin/inventario",[InventoryController::class,"index"]);
    $router->post("/admin/inventario",[InventoryController::class,"index"]);

    $router->get("/admin/inventario/crear",[InventoryController::class,"crear"]);
    $router->post("/admin/inventario/crear",[InventoryController::class,"crear"]);

    $router->get("/admin/inventario/actualizar",[InventoryController::class,"actualizar"]);
    $router->post("/admin/inventario/actualizar",[InventoryController::class,"actualizar"]);

    $router->get("/admin/inventario/ver",[InventoryController::class,"ver"]);

    $router->get("/admin/ordenes",[OrderController::class,"index"]);
    $router->post("/admin/ordenes",[OrderController::class,"index"]);
    $router->get("/admin/ordenes/crear",[OrderController::class,"crear"]);
    $router->post("/admin/ordenes/crear",[OrderController::class,"crear"]);
    
    $router->get("/orden",[OrderController::class,"orden"]);
    $router->post("/orden",[OrderController::class,"orden"]);
    $router->get("/orden/print",[OrderController::class,"print"]);
    $router->post("/orden/print",[OrderController::class,"print"]);


    /* * Tickets * */
    $router->get("/admin/tickets",[TicketController::class,"index"]);
    $router->post("/admin/tickets",[TicketController::class,"index"]);
    $router->get("/admin/tickets",[TicketController::class,"index"]);
    $router->post("/admin/tickets",[TicketController::class,"index"]);
    $router->get("/admin/tickets/ticket",[TicketController::class,"ticket"]);
    $router->post("/admin/tickets/ticket",[TicketController::class,"ticket"]);

    /* * Encuestas * */
    $router->get("/admin/encuestas",[PollController::class,"index"]);
    $router->post("/admin/encuestas",[PollController::class,"index"]);
    $router->post("/admin/encuestas/ver",[PollController::class,"ver"]);

    /* * Entradas * */
    $router->get("/admin/entradas",[EntrieController::class,"index"]);
    $router->post("/admin/entradas",[EntrieController::class,"index"]);
    $router->get("/admin/entradas/crear",[EntrieController::class,"crear"]);
    $router->post("/admin/entradas/crear",[EntrieController::class,"crear"]);
    $router->get("/admin/entradas/actualizar",[EntrieController::class,"actualizar"]);
    $router->post("/admin/entradas/actualizar",[EntrieController::class,"actualizar"]);




    $router->get("/notificaciones",[PagesController::class,"notificaciones"]);



    $router->comprobarRutas();

?>
