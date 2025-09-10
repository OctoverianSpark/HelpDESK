<?php




namespace Controllers\LAPI;

use Models\Inventory;
use Models\Maintenance;

class API_MAINTENANCES
{

  public static function FIND_QUERY()
  {


    $post = json_decode(file_get_contents('php://input'));
    $id = filter_var($post->id, FILTER_VALIDATE_INT);

    $res = Maintenance::filter('computer', '=', $id);

    if ($res) {
      echo json_encode(array_shift($res));
    } else {
      echo json_encode([]);
    }

    exit;
  }
  public static function SAVE_QUERY()
  {


    $post = json_decode(file_get_contents('php://input'), true);

    $id = filter_var($post['computer'], FILTER_VALIDATE_INT);

    $res = Maintenance::filter('computer', '=', $id);

    $computer = Inventory::find($id);

    if ($res) {
      $res = Maintenance::find($res[0]->id);

      $res->sync($post);

      $res->guardar();


      $body = "Le informamos que se ha programado un mantenimiento preventivo del equipo $computer->nombre_equipo con el fin de garantizar su correcto funcionamiento y prolongar su vida útil.

📅 Fecha del mantenimiento: $res->next

Durante este periodo, el equipo no estará disponible. Una vez finalizado el mantenimiento, será restablecido para su uso normal.";

      enviarCorreo($body, 'MANTENIMIENTO DE EQUIPO PROGRAMADO', [$computer->correo_dominio]);

      echo json_encode($res);
    } else {

      $res = new Maintenance($post);

      $res->guardar();



      $body = "Le informamos que se ha programado un mantenimiento preventivo del equipo $computer->nombre_equipo con el fin de garantizar su correcto funcionamiento y prolongar su vida útil.

📅 Fecha del mantenimiento: $res->next

Durante este periodo, el equipo no estará disponible. Una vez finalizado el mantenimiento, será restablecido para su uso normal.";

      enviarCorreo($body, 'MANTENIMIENTO DE EQUIPO PROGRAMADO', [$computer->correo_dominio]);


      echo json_encode($res);
    }

    exit;
  }
}
