<?php


namespace Controllers;

use Models\AgentTicket;
use MVC\Router;

use Models\Inventory;
use Models\Perifericos;
use Models\Encuestas;
use Models\Log;
use Models\Maintenance;
use Models\Ordenes;
use Models\Personal;
use Models\Tickets;
use Models\Users;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class AdminController
{


    public static function index(Router $router)
    {

        $orders =  Ordenes::filter("state", "=", "pendiente");


        $router->render("admin/index", [
            "orders" => $orders
        ]);
    }

    public static function usrs(Router $router)
    {


        $usrs = Users::all();
        $router->render("admin/users", [
            "usrs" => $usrs
        ]);
    }

    public static function logs(Router $router)
    {



        $logs = Log::all();

        $router->render("/admin/logs", ["logs" => $logs]);
    }




    public static function export(Router $router)
    {





        $equipos = Inventory::all();

        $tickets = Tickets::all();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $spreadsheet = new Spreadsheet();
            $writer = new Xlsx($spreadsheet);

            $filename = $_POST["export"] . ".xlsx";



            if ($_POST["export"] === "inventario") {
                $i = 2;
                $j = 2;
                $spreadsheet->createSheet(1)->setTitle("Inventario");
                $spreadsheet->createSheet(2)->setTitle("Perifericos");
                $spreadsheet->removeSheetByIndex(0);
                $spreadsheet->getActiveSheet()->fromArray(
                    ["ID", "NOMBRE", "APELLIDO", "TIPO DE DOCUMENTO", "DOCUMENTO", "TELEFONO", "TIPO DE EQUIPO", "MARCA", "MODELO", "COLOR", "AREA", "NOMBRE DE EQUIPO", "SERIAL", "USUARIO DE DOMINIO", "CORREO", "PROPIETARIO", "SEDE"]
                );
                $spreadsheet->setActiveSheetIndexByName("Perifericos");
                $spreadsheet->getActiveSheet()->fromArray(
                    ["NOMBRE_EQUIPO", "TIPO", "MARCA", "MODELO", "COLOR", "SERIAL"]
                );
                $spreadsheet->setActiveSheetIndexByName("Inventario");



                foreach ($equipos as $equipo) {
                    $spreadsheet->setActiveSheetIndexByName("Inventario");



                    $spreadsheet->getActiveSheet()->setCellValue("A$i", $equipo->id);
                    $spreadsheet->getActiveSheet()->setCellValue("B$i", $equipo->nombre);
                    $spreadsheet->getActiveSheet()->setCellValue("C$i", $equipo->apellido);
                    $spreadsheet->getActiveSheet()->setCellValue("D$i", $equipo->tipo_documento);
                    $spreadsheet->getActiveSheet()->setCellValue("E$i", $equipo->documento);
                    $spreadsheet->getActiveSheet()->setCellValue("F$i", $equipo->telefono);
                    $spreadsheet->getActiveSheet()->setCellValue("G$i", $equipo->tipo);
                    $spreadsheet->getActiveSheet()->setCellValue("H$i", $equipo->marca);
                    $spreadsheet->getActiveSheet()->setCellValue("I$i", $equipo->modelo);
                    $spreadsheet->getActiveSheet()->setCellValue("J$i", $equipo->color);
                    $spreadsheet->getActiveSheet()->setCellValue("K$i", $equipo->area);
                    $spreadsheet->getActiveSheet()->setCellValue("L$i", $equipo->nombre_equipo);
                    $spreadsheet->getActiveSheet()->setCellValue("M$i", $equipo->serial);
                    $spreadsheet->getActiveSheet()->setCellValue("N$i", $equipo->usuarioPC);
                    $spreadsheet->getActiveSheet()->setCellValue("O$i", $equipo->correo_dominio);
                    $spreadsheet->getActiveSheet()->setCellValue("P$i", $equipo->propietario);
                    $spreadsheet->getActiveSheet()->setCellValue("Q$i", $equipo->location);


                    $spreadsheet->setActiveSheetIndexByName("Perifericos");
                    $perifericos = Perifericos::filter('user_id', '=', $equipo->user_id);
                    foreach ($perifericos as $periferico) {

                        $spreadsheet->getActiveSheet()->setCellValue("A$j", $equipo->nombre . ' ' . $equipo->apellido);
                        $spreadsheet->getActiveSheet()->setCellValue("B$j", $periferico->tipo);
                        $spreadsheet->getActiveSheet()->setCellValue("C$j", $periferico->marca);
                        $spreadsheet->getActiveSheet()->setCellValue("D$j", $periferico->modelo);
                        $spreadsheet->getActiveSheet()->setCellValue("E$j", $periferico->color);
                        $spreadsheet->getActiveSheet()->setCellValue("F$j", $periferico->serial);
                        $j++;
                    }


                    $i++;
                }
            } else if ($_POST["export"] === "tickets") {
                $i = 2;
                $spreadsheet->createSheet(1)->setTitle("Tickets");
                $spreadsheet->removeSheetByIndex(0);
                $spreadsheet->getActiveSheet()->fromArray(
                    ["ID", "FECHA", "USUARIO", "CATEGORIA", "SUBCATEGORIA", "PRIORIDAD", "DESCRIPCION", "ANYDESK", "ESTADO", "TECNICO", "FECHA ASIGNADA", "TIEMPO EN ASIGNAR", "FECHA COMPLETACION", "TIEMPO EN COMPLETAR", "FECHA PENDIENTE", "TIEMPO EN PENDIENTE"]
                );
                $spreadsheet->setActiveSheetIndexByName("Tickets");


                foreach ($tickets as $ticket) {
                    $spreadsheet->setActiveSheetIndexByName("Tickets");



                    $spreadsheet->getActiveSheet()->setCellValue("A$i", $ticket->id);
                    $spreadsheet->getActiveSheet()->setCellValue("B$i", $ticket->fecha);
                    $spreadsheet->getActiveSheet()->setCellValue("C$i", $ticket->usuario);
                    $spreadsheet->getActiveSheet()->setCellValue("D$i", $ticket->categoria);
                    $spreadsheet->getActiveSheet()->setCellValue("E$i", $ticket->subcategoria);
                    $spreadsheet->getActiveSheet()->setCellValue("F$i", $ticket->prioridad);
                    $spreadsheet->getActiveSheet()->setCellValue("G$i", $ticket->descripcion);
                    $spreadsheet->getActiveSheet()->setCellValue("H$i", $ticket->anydesk);
                    $spreadsheet->getActiveSheet()->setCellValue("I$i", $ticket->estado);
                    $spreadsheet->getActiveSheet()->setCellValue("J$i", $ticket->tecnico);
                    $spreadsheet->getActiveSheet()->setCellValue("K$i", $ticket->fecha_asignada);
                    $spreadsheet->getActiveSheet()->setCellValue("L$i", $ticket->sa_ep);
                    $spreadsheet->getActiveSheet()->setCellValue("M$i", $ticket->fecha_completacion);
                    $spreadsheet->getActiveSheet()->setCellValue("N$i", $ticket->ep_c);
                    $spreadsheet->getActiveSheet()->setCellValue("O$i", $ticket->fecha_pendiente);
                    $spreadsheet->getActiveSheet()->setCellValue("P$i", $ticket->p_c);





                    $i++;
                }
            } else if ($_POST['export'] === 'logs') {
                $i = 2;
                $spreadsheet->createSheet(1)->setTitle("LOGS");
                $spreadsheet->removeSheetByIndex(0);
                $spreadsheet->getActiveSheet()->fromArray(
                    ['ID', 'TIPO', 'ACCION', 'DESCRIPCION', 'DATA ID']
                );

                $logs = Log::all();

                foreach ($logs as $log) {

                    $spreadsheet->getActiveSheet()->setCellValue("A$i", $log->id);
                    $spreadsheet->getActiveSheet()->setCellValue("B$i", $log->type);
                    $spreadsheet->getActiveSheet()->setCellValue("C$i", $log->action);
                    $spreadsheet->getActiveSheet()->setCellValue("D$i", $log->description);
                    $spreadsheet->getActiveSheet()->setCellValue("E$i", $log->data_id);

                    $i++;
                }
            } else if ($_POST['export'] === 'mantenimientos') {

                $i = 2;
                $spreadsheet->createSheet(1)->setTitle("LOGS");
                $spreadsheet->removeSheetByIndex(0);
                $spreadsheet->getActiveSheet()->fromArray(
                    ['ID', 'ENCARGADO', 'ULTIMO', 'SIGUIENTE', 'COMPUTADOR']
                );

                $mantenimientos = Maintenance::all();


                foreach ($mantenimientos as $mantenimiento) {

                    $computer = Inventory::find($mantenimiento->id);


                    $spreadsheet->getActiveSheet()->setCellValue("A$i", $mantenimiento->id);
                    $spreadsheet->getActiveSheet()->setCellValue("B$i", $mantenimiento->tech);
                    $spreadsheet->getActiveSheet()->setCellValue("C$i", $mantenimiento->latest);
                    $spreadsheet->getActiveSheet()->setCellValue("D$i", $mantenimiento->next);
                    $spreadsheet->getActiveSheet()->setCellValue("D$i", $computer->nombre_equipo);

                    $i += 1;
                }
            } else if ($_POST['export'] === 'polls') {

                $i = 2;
                $spreadsheet->createSheet(1)->setTitle("Encuestas");
                $spreadsheet->removeSheetByIndex(0);
                $spreadsheet->getActiveSheet()->fromArray(
                    ['ID', 'Fecha', 'Nombre', 'AREA', "¿Cómo calificaría el soporte técnico recibido este mes?", "¿Tiempo de respuesta adecuado?", "¿La solución fue efectiva?"]
                );
                $encuestas = Encuestas::all();
                $encuestas = Encuestas::get(1);


                debuguear($encuestas);
                $techs = Users::filter('area', '=', 'ATI');
                $techLeters = [...range('H', 'Z')];

                $j = 0;
                foreach ($techs as $techs) {

                    $spreadsheet->getActiveSheet()->setCellValue($techLeters[$j++] . 1, 'TECNICO');
                    $spreadsheet->getActiveSheet()->setCellValue($techLeters[$j++] . 1, 'TIEMPO DE RESPUESTA');
                    $spreadsheet->getActiveSheet()->setCellValue($techLeters[$j++] . 1, 'CALIDAD');
                    $spreadsheet->getActiveSheet()->setCellValue($techLeters[$j++] . 1, 'AMABILIDAD');
                }


                foreach ($encuestas as $encuesta) {

                    $spreadsheet->getActiveSheet()->setCellValue("A$i", $encuesta->id);
                    $spreadsheet->getActiveSheet()->setCellValue("B$i", $encuesta->date);
                    $spreadsheet->getActiveSheet()->setCellValue("C$i", $encuesta->name);
                    $spreadsheet->getActiveSheet()->setCellValue("D$i", $encuesta->area);

                    $general_test = json_decode($encuesta->general_test, true);

                    $spreadsheet->getActiveSheet()->setCellValue("E$i", $general_test['response_time'] ?? 'No tiene resultado');
                    $spreadsheet->getActiveSheet()->setCellValue("F$i", $general_test['effective-explain'] ?? 'No tiene resultado');
                    $spreadsheet->getActiveSheet()->setCellValue("G$i", $general_test['effective-atention'] ?? 'No tiene resultado');


                    $j = 0;
                    $test = json_decode($encuesta->individual_test, true);

                    foreach ($test as $key => $value) {
                        $tech = Users::find($key);


                        $spreadsheet->getActiveSheet()->setCellValue($techLeters[$j++] . $i, $tech->first_name);
                        $spreadsheet->getActiveSheet()->setCellValue(
                            $techLeters[$j++] . $i,
                            $value["response"]
                        );

                        $spreadsheet->getActiveSheet()->setCellValue($techLeters[$j++] . $i, $value["quality"]);

                        $spreadsheet->getActiveSheet()->setCellValue($techLeters[$j++] . $i, $value["amability"]);
                    }
                    $i++;
                }
            } else if ($_POST['export'] === 'personal') {

                $employees = Personal::all();

                $spreadsheet->createSheet(1)->setTitle("COLOMBIA");
                $spreadsheet->createSheet(2)->setTitle("VENEZUELA");
                $spreadsheet->removeSheetByIndex(0);

                $headers = ["NOMBRE", "APELLIDO", "TIPO DE DOCUMENTO", "DOCUMENTO", "EMAIL", "TELEFONO", "CARGO", "AREA", "TIPO DE CONTRATO", "ESTADO"];

                // Escribir encabezados en cada hoja
                $spreadsheet->setActiveSheetIndexByName('COLOMBIA')
                    ->fromArray($headers, null, 'A1');

                $spreadsheet->setActiveSheetIndexByName('VENEZUELA')
                    ->fromArray($headers, null, 'A1');

                $a = 2; // fila inicial para Colombia
                $b = 2; // fila inicial para Venezuela

                foreach ($employees as $employee) {
                    $rowData = [
                        $employee->first_name,
                        $employee->last_name,
                        $employee->doc_type,
                        $employee->nat_id,
                        $employee->email,
                        $employee->phone_number,
                        $employee->job_title,
                        $employee->area,
                        $employee->contract_type,
                        $employee->state === 0 ? 'RETIRADO' : 'ACTIVO'
                    ];

                    if (strtoupper($employee->location) === 'VENEZUELA') {
                        $spreadsheet->setActiveSheetIndexByName('VENEZUELA')
                            ->fromArray($rowData, null, "A$b");
                        $b++;
                    } else {
                        $spreadsheet->setActiveSheetIndexByName('COLOMBIA')
                            ->fromArray($rowData, null, "A$a");
                        $a++;
                    }
                }
            } else if ($_POST["export"] === "agent_tickets") {
                $tickets = AgentTicket::all();

                $i = 2;
                $spreadsheet->createSheet(1)->setTitle("Tickets");
                $spreadsheet->removeSheetByIndex(0);
                $spreadsheet->getActiveSheet()->fromArray(
                    ["ID", "FECHA", "USUARIO",  "ASUNTO", "PRIORIDAD", "DESCRIPCION", "ESTADO", "TECNICO", "FECHA ASIGNADA", "TIEMPO EN ASIGNAR", "FECHA COMPLETACION", "TIEMPO EN COMPLETAR", "FECHA PENDIENTE", "TIEMPO EN PENDIENTE"]
                );
                $spreadsheet->setActiveSheetIndexByName("Tickets");


                foreach ($tickets as $ticket) {
                    $spreadsheet->setActiveSheetIndexByName("Tickets");



                    $spreadsheet->getActiveSheet()->setCellValue("A$i", $ticket->id);
                    $spreadsheet->getActiveSheet()->setCellValue("B$i", $ticket->fecha);
                    $spreadsheet->getActiveSheet()->setCellValue("C$i", $ticket->name);
                    $spreadsheet->getActiveSheet()->setCellValue("D$i", $ticket->subcategoria);
                    $spreadsheet->getActiveSheet()->setCellValue("E$i", $ticket->prioridad);
                    $spreadsheet->getActiveSheet()->setCellValue("F$i", $ticket->descripcion);
                    $spreadsheet->getActiveSheet()->setCellValue("G$i", $ticket->estado);
                    $spreadsheet->getActiveSheet()->setCellValue("H$i", $ticket->tecnico ?? 'Sin Asignar');
                    $spreadsheet->getActiveSheet()->setCellValue("I$i", $ticket->fecha_asignada);
                    $spreadsheet->getActiveSheet()->setCellValue("J$i", $ticket->sa_ep);
                    $spreadsheet->getActiveSheet()->setCellValue("K$i", $ticket->fecha_completacion);
                    $spreadsheet->getActiveSheet()->setCellValue("L$i", $ticket->ep_c);
                    $spreadsheet->getActiveSheet()->setCellValue("M$i", $ticket->fecha_pendiente);
                    $spreadsheet->getActiveSheet()->setCellValue("N$i", $ticket->ep_p);





                    $i++;
                }
            }

            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename="' . urlencode($filename) . '"');
            $writer->save('php://output');

            $spreadsheet->disconnectWorksheets();
            unset($spreadsheet);
        }



        $router->render("/admin/export");
    }
}
