<?php



namespace Controllers;



use Models\Inventory;
use Models\Log;
use Models\Perifericos;



use Models\Personal;

use MVC\Router;

class PersController
{

  public static function index(Router $router)
  {

    if (isset($_GET['state']) && $_GET['state'] !== '') {
      $pers = Perifericos::filter('state', '=', $_GET['state']);
    } else {
      $pers = Perifericos::all();
    }

    $router->render("admin/pers/index", [
      "pers" => $pers
    ]);
  }

  public static function create(Router $router)
  {

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $periferico = new Perifericos($_POST);
      $periferico->guardar();
      header('Location: /admin/pers');
    } else {
      $periferico = new Perifericos();
    }

    $router->render("admin/pers/create", [
      "periferico" => $periferico
    ]);
  }

  public static function update(Router $router)
  {
    $id = validarID();
    $per = Perifericos::find($id);
    $users = Personal::all();
    if (!$per) {
      header('Location: /admin/pers');
      return;
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $per->sync($_POST);

      if ($per->user_id) {
        $per->user_id = filter_var($per->user_id, FILTER_VALIDATE_INT);
        $per->state = 1;
        $per->asign_date = date('Y-m-d H:i:s');
      }

      $per->guardar();


      header('Location: /admin/pers');
    }


    $router->render("admin/pers/create", [
      "per" => $per,
      "users" => $users
    ]);
  }
}
