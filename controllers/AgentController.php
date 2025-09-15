<?php



namespace Controllers;

use Models\Agent;
use Models\AgentTicket;
use Models\Users;
use MVC\Router;

class AgentController
{


  public static function index(Router $router)
  {

    $agents = Agent::all();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {


      switch ($_POST['action']) {


        case 'new':
          $agent = new Agent($_POST);
          $agent->guardar();
          header('Location: /admin/agents');

        case 'update':
          $agent = Agent::find($_POST['id']);
          $agent->sync($_POST);
          $agent->guardar();
          header('Location: /admin/agents');
          exit;
        case 'delete':
          $agent = Agent::find($_POST['id']);
          $agent->eliminar();
          header('Location: /admin/agents');


        default:
          header('Location: /admin/agents');
      }
    }





    $router->render('/admin/agents/index', [
      'agents' => $agents
    ]);
  }




  public static function find_agent()
  {
    $id = validarID();


    $agent = Agent::find($id);


    echo json_encode($agent);
    exit;
  }

  public static function tickets(Router $router)
  {


    $tickets = AgentTicket::all();





    $router->render('/admin/agents/tickets', [
      'tickets' => $tickets
    ]);
  }


  public static function ticket_create(Router $router)
  {

    $agents = Agent::all();
    $techs = Users::filter('area', '=', 'ATI');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

      $ticket = new AgentTicket($_POST);



      $ticket->guardar();


      header('Location: /admin/agents/tickets');
    }

    $router->render('/admin/agents/create_ticket', [
      'agents' => $agents,
      'techs' => $techs
    ]);
  }

  public static function ticket_update(Router $router)
  {
    $id = validarID();
    $agents = Agent::all();
    $techs = Users::filter('area', '=', 'ATI');
    $ticket = AgentTicket::find($id);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

      // Manejar fechas solo si no están definidas
      if ($_POST['estado'] === 'en proceso' && !$ticket->fecha_asignada) {
        $_POST['fecha_asignada'] = date('Y-m-d H:i:s');
      } elseif ($_POST['estado'] === 'pendiente' && !$ticket->fecha_en_pendiente) {
        $_POST['fecha_en_pendiente'] = date('Y-m-d H:i:s');
      } elseif ($_POST['estado'] === 'completado' && !$ticket->fecha_completacion) {
        $_POST['fecha_completacion'] = date('Y-m-d H:i:s');
      }

      // Actualizar datos
      $ticket->sync($_POST);
      $ticket->guardar();

      // Redirección
      header('Location: /admin/agents/tickets');
      exit;
    }


    $router->render('/admin/agents/create_ticket', [
      'agents' => $agents,
      'techs' => $techs,
      'ticket' => $ticket
    ]);
  }
}
