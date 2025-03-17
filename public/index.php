<?php
require_once  __DIR__ . "/../includes/app.php";

date_default_timezone_set("America/Bogota");

use Controllers\AdminController;
use Controllers\LoginController;
use Controllers\PagesController;
use Controllers\InventoryController;
use Controllers\TicketController;
use Controllers\PollController;
use Controllers\EntrieController;
use Controllers\LAPI;
use Controllers\LAPI\API_BASE;
use Controllers\LAPI\API_Documentations;
use Controllers\LAPI\API_ENTRIES;
use Controllers\LAPI\API_Inventory;
use Controllers\LAPI\API_ORDERS;
use Controllers\LAPI\API_SERVERS;
use Controllers\LAPI\API_Tickets;
use Controllers\LAPI\API_USERS;
use Controllers\OrderController;
use Controllers\ServersController;
use MVC\Router;
use Models\Encuestas;



$router = new Router;

Encuestas::setUncompleted();

//Publicas
$router->get("/", [PagesController::class, "index"]);
$router->get("/ticket", [PagesController::class, "ticket"]);

$router->get("/tickets/crear", [PagesController::class, "crear"]);
$router->post("/tickets/crear", [PagesController::class, "crear"]);

$router->get("/tickets/ver", [PagesController::class, "tickets"]);

$router->get("/ordenes/crear", [PagesController::class, "ordenes"]);
$router->post("/ordenes/crear", [PagesController::class, "ordenes"]);

$router->get("/equipos", [PagesController::class, "equipos"]);
$router->post("/equipos", [PagesController::class, "equipos"]);

$router->get("/encuesta", [PagesController::class, "encuesta"]);
$router->post("/encuesta", [PagesController::class, "encuesta"]);


//Autenticacion
$router->get("/login", [LoginController::class, "login"]);
$router->post("/login", [LoginController::class, "login"]);

$router->get("/redirect", [LoginController::class, "redirect"]);

$router->get("/logout", [LoginController::class, "logout"]);



/* Portal */

$router->get("/admin", [AdminController::class, "index"]);
$router->post("/admin", [AdminController::class, "index"]);
$router->get("/admin/users", [AdminController::class, "usrs"]);
$router->post("/admin/users", [AdminController::class, "usrs"]);
$router->get("/admin/export", [AdminController::class, "export"]);
$router->post("/admin/export", [AdminController::class, "export"]);

/* * Inventario * */
$router->get("/admin/inventario", [InventoryController::class, "index"]);
$router->post("/admin/inventario", [InventoryController::class, "index"]);
$router->get("/admin/inventario/dashboard", [InventoryController::class, "dashboard"]);


$router->get("/admin/inventario/crear", [InventoryController::class, "crear"]);
$router->post("/admin/inventario/crear", [InventoryController::class, "crear"]);

$router->get("/admin/inventario/actualizar", [InventoryController::class, "actualizar"]);
$router->post("/admin/inventario/actualizar", [InventoryController::class, "actualizar"]);

$router->get("/admin/inventario/ver", [InventoryController::class, "ver"]);

$router->get("/admin/ordenes", [OrderController::class, "index"]);
$router->post("/admin/ordenes", [OrderController::class, "index"]);
$router->get("/admin/ordenes/crear", [OrderController::class, "crear"]);
$router->post("/admin/ordenes/crear", [OrderController::class, "send"]);
$router->post("/admin/ordenes/print", [API_ORDERS::class, "printer"]);

$router->get("/orden", [OrderController::class, "orden"]);
$router->post("/orden", [OrderController::class, "orden"]);
$router->get("/order/see", [OrderController::class, "sign"]);
$router->post("/order/see", [OrderController::class, "sign"]);


/* * Tickets * */
$router->get("/admin/tickets", [TicketController::class, "index"]);
$router->post("/admin/tickets", [TicketController::class, "index"]);
$router->get("/admin/tickets/dashboard", [TicketController::class, "dashboard"]);
$router->post("/admin/tickets/update", [API_Tickets::class, "TICKETUPDATE"]);
$router->get("/admin/tickets/ticket", [TicketController::class, "ticket"]);
$router->post("/admin/tickets/ticket", [TicketController::class, "ticket"]);

/* * Encuestas * */
$router->get("/admin/encuestas", [PollController::class, "index"]);
$router->post("/admin/encuestas", [PollController::class, "index"]);
$router->post("/admin/encuestas/ver", [PollController::class, "ver"]);

/* * Entradas * */
$router->get("/admin/entradas", [EntrieController::class, "index"]);
$router->post("/admin/entradas", [EntrieController::class, "index"]);


/* Servidores */

$router->get("/admin/servers",[ServersController::class, "index"]);
$router->post("/admin/server_users/find",[API_SERVERS::class, "FIND_USERS"]);
$router->post("/admin/server_users/save",[API_SERVERS::class, "SAVE_USERS"]);
$router->post("/admin/server_users/delete",[API_SERVERS::class, "DELETE_USERS"]);
$router->post("/admin/servers/find",[API_SERVERS::class, "FIND_SERVER"]);
$router->post("/admin/servers/save",[API_SERVERS::class, "SAVE_SERVER"]);
$router->post("/admin/servers/delete",[API_SERVERS::class, "DELETE_SERVER"]);


$router->get("/notificaciones", [PagesController::class, "notificaciones"]);
$router->post("/admin/inventario/actions", [InventoryController::class, "actions"]);








//NOTE: LAPI FUNCTIONS
$router->post("/admin/pers/find",[API_Inventory::class,"PERSSEARCH"]);
$router->post("/admin/inventory/find",[API_Inventory::class,"INVENTORYSEARCH"]);
$router->post("/admin/inventory/actions",[API_Inventory::class,"actions"]);
$router->post("/admin/inventory/get",[API_Inventory::class,"INVENTORY_GET"]);
$router->post("/admin/orders/get",[API_ORDERS::class,"GET"]);

$router->post("/tickets/find",[API_Tickets::class,"TICKETSEARCH"]);
$router->post("/tickets/get",[API_Tickets::class,"TICKETSGET"]);
$router->post("/admin/subcats/get",[API_Tickets::class,"SUBCATSSEARCH"]);
$router->post("/admin/cookies/get",[API_BASE::class,"COOKIESGET"]);
$router->post("/admin/documentations/find",[API_Documentations::class,"DOCUMENTATIONSEARCH"]);
$router->post("/admin/documentations/create",[API_Documentations::class,"DOCUMENTATIONCREATE"]);


$router->post("/admin/usrs/find",[API_USERS::class,"USERSEARCH"]);
$router->post("/admin/usrs/save",[API_USERS::class,"USERS_SAVE"]);
$router->post("/admin/usrs/delete",[API_USERS::class,"USER_DELETE"]);

$router->post("/admin/entradas/set",[API_ENTRIES::class,"SETSHOWED"]);
$router->post("/admin/entradas/find",[API_ENTRIES::class,"FIND_ENTRY"]);
$router->post("/admin/entradas/save",[API_ENTRIES::class,"SAVE_ENTRY"]);
$router->post("/admin/entradas/delete",[API_ENTRIES::class,"DELETE_ENTRY"]);

//NOTE: INDEXERS
$router->post("/admin/tickets/indexer",[API_Tickets::class,"INDEXER"]);

$router->post("/admin/convert",[API_BASE::class,"CONVERT"]);


$router->comprobarRutas();
