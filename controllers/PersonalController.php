<?php


namespace Controllers;

use Models\Personal;
use MVC\Router;



class PersonalController
{

  public static function index(Router $router)
  {

    if (isset($_GET['state']) && $_GET['state'] !== '') {
      $personal = Personal::filter('state', '=', $_GET['state']);
    } else {
      $personal = Personal::all();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $usr = Personal::find($_POST['id']);
      if ($usr) {

        $usr->eliminar();
      }
      header('Location: /admin/personal');
    }

    $router->render('admin/personal/index', [
      'personal' => $personal,
    ]);
  }

  public static function register(Router $router)
  {


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

      $personal = new Personal($_POST);
      $personal->mod_date = date('Y-m-d H:i:s');

      $personal->guardar();
      header('Location: /admin/personal');
    } else {
      $personal = new Personal();
    }

    $router->render('admin/personal/register', [
      'personal' => $personal,
    ]);
  }
  public static function update(Router $router)
  {
    $personal = Personal::find($_GET['id']);
    if (!$personal) {
      header('Location: /admin/personal');
      return;
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $personal->sync($_POST);
      $personal->mod_date = date('Y-m-d H:i:s');

      $personal->guardar();
      header('Location: /admin/personal');
    } else {
      $id = $_GET['id'] ?? null;
      $personal = Personal::find($id);
    }

    $router->render('admin/personal/register', [
      'personal' => $personal,
    ]);
  }
}
