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

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

      $mantenimiento = Maintenance::find($_POST['id']);

      $mantenimiento->eliminar();
      header('Location: /admin/mantenimientos');
    }

    $router->render('admin/inventario/mantenimientos/index', [
      'agenda' => $agenda,
    ]);
  }


  public static function update(Router $router)
  {

    $id = validarID();
    $maintenance = Maintenance::find($id);
    $techs = Users::filter('area', '=', 'ATI');
    $computers = Inventory::all();


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

      $maintenance->sync($_POST);

      $maintenance->guardar();
      $computer = Inventory::find($maintenance->computer);



      header('Location: /admin/mantenimientos');
    }

    $router->render('admin/inventario/mantenimientos/update', [
      'maintenance' => $maintenance,
      'techs' => $techs,
      'computers' => $computers
    ]);
  }
}
