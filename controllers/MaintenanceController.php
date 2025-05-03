<?php



namespace Controllers;

use Models\Inventory;
use Models\Maintenance;
use Models\Users;
use MVC\Router;

class MaintenanceController
{

  public static function index(Router $router)
  {


    $agenda = Maintenance::all();


    $router->render('admin/inventario/mantenimientos/index', [
      'agenda' => $agenda,
    ]);
  }
}
