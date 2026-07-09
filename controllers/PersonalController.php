<?php


namespace Controllers;

use Models\Personal;
use MVC\Router;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;



class PersonalController
{

  // Orden de columnas que se espera en el Excel de importacion (fila 1 = encabezados, se ignora).
  private static $IMPORT_COLUMNS = [
    'first_name', 'last_name', 'id_type', 'nat_id', 'phone_number',
    'email', 'job_title', 'area', 'contract_type', 'state', 'location'
  ];

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

  public static function downloadTemplate()
  {
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setTitle('Personal');

    $sheet->fromArray([
      'Nombre', 'Apellido', 'Tipo de Documento (ppt/cc/pasaporte/cv)', 'Documento', 'Telefono',
      'Correo', 'Cargo', 'Area', 'Contrato (indefinido/prestacion de servicio/aprendizaje)', 'Estado (1 activo / 0 inactivo)', 'Ubicacion (colombia/venezuela)'
    ]);
    $sheet->fromArray([
      'Juan', 'Perez', 'cc', '123456789', '3001234567',
      'juan.perez@empresa.com', 'Analista', 'Sistemas', 'indefinido', '1', 'colombia'
    ], null, 'A2');

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="plantilla_personal.xlsx"');
    header('Cache-Control: max-age=0');

    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
    exit;
  }

  public static function import(Router $router)
  {
    $resultado = null;

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['archivo']) && $_FILES['archivo']['error'] === UPLOAD_ERR_OK) {

      try {
        $spreadsheet = IOFactory::load($_FILES['archivo']['tmp_name']);
        $filas = $spreadsheet->getActiveSheet()->toArray(null, true, true, false);

        $creados = 0;
        $actualizados = 0;
        $errores = [];
        $columnas = count(self::$IMPORT_COLUMNS);

        foreach ($filas as $index => $fila) {
          if ($index === 0) continue; // fila de encabezados

          $numeroFila = $index + 1;
          $valores = array_pad(array_slice($fila, 0, $columnas), $columnas, null);
          $datos = array_combine(self::$IMPORT_COLUMNS, $valores);
          $datos = array_map(function ($valor) {
            return is_string($valor) ? trim($valor) : $valor;
          }, $datos);

          $vacia = ($datos['first_name'] ?? '') === '' && ($datos['last_name'] ?? '') === '' && ($datos['nat_id'] ?? '') === '';
          if ($vacia) continue;

          if (($datos['first_name'] ?? '') === '' || ($datos['last_name'] ?? '') === '' || ($datos['nat_id'] ?? '') === '') {
            $errores[] = "Fila $numeroFila: nombre, apellido y documento son obligatorios";
            continue;
          }

          $datos['id_type'] = strtolower((string)($datos['id_type'] ?? ''));
          $datos['contract_type'] = strtolower((string)($datos['contract_type'] ?? ''));
          $datos['location'] = strtolower((string)($datos['location'] ?? ''));

          $estado = strtolower(trim((string)($datos['state'] ?? '1')));
          $datos['state'] = in_array($estado, ['0', 'inactivo', 'no', 'false'], true) ? 0 : 1;

          $existente = Personal::findByDocumento($datos['nat_id']);

          if ($existente) {
            $existente->sync($datos);
            $existente->mod_date = date('Y-m-d H:i:s');
            $existente->guardar();
            $actualizados++;
          } else {
            $nuevo = new Personal($datos);
            $nuevo->mod_date = date('Y-m-d H:i:s');
            $nuevo->guardar();
            $creados++;
          }
        }

        $resultado = [
          'ok' => true,
          'creados' => $creados,
          'actualizados' => $actualizados,
          'errores' => $errores
        ];
      } catch (\Exception $e) {
        $resultado = ['ok' => false, 'error' => $e->getMessage()];
      }
    }

    $router->render('admin/personal/import', [
      'resultado' => $resultado
    ]);
  }
}
