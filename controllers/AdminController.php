<?php


namespace Controllers;

use MVC\Router;

use Models\Inventory;
use Models\Perifericos;
use Models\Encuestas;
use Models\Log;
use Models\Ordenes;
use Models\Tickets;
use Models\Users;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class AdminController
{


    public static function index(Router $router)
    {

        $orders=  Ordenes::filter("state","=","pendiente");


        $router->render("admin/index", [
            "orders"=>$orders
        ]);
    }

    public static function usrs(Router $router)
    {


        $usrs = Users::all();
        $router->render("admin/users", [
            "usrs" => $usrs
        ]);
    }

    public static function logs(Router $router){



        $logs = Log::all();

        $router->render("/admin/logs",["logs"=>$logs]);




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
                    ["ID", "NOMBRE", "APELLIDO", "TIPO DE DOCUMENTO", "DOCUMENTO", "TELEFONO", "ANYDESK", "CONTRASEÑA ANYDESK", "TIPO DE EQUIPO", "MARCA", "MODELO", "COLOR", "NOMBRE DE EQUIPO", "SERIAL", "USUARIO DE DOMINIO", "CORREO", "PROPIETARIO", "SEDE"]
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
                    $spreadsheet->getActiveSheet()->setCellValue("G$i", $equipo->anydesk);
                    $spreadsheet->getActiveSheet()->setCellValue("H$i", $equipo->password_anydesk);
                    $spreadsheet->getActiveSheet()->setCellValue("I$i", $equipo->tipo);
                    $spreadsheet->getActiveSheet()->setCellValue("J$i", $equipo->marca);
                    $spreadsheet->getActiveSheet()->setCellValue("K$i", $equipo->modelo);
                    $spreadsheet->getActiveSheet()->setCellValue("L$i", $equipo->color);
                    $spreadsheet->getActiveSheet()->setCellValue("M$i", $equipo->nombre_equipo);
                    $spreadsheet->getActiveSheet()->setCellValue("N$i", $equipo->serial);
                    $spreadsheet->getActiveSheet()->setCellValue("O$i", $equipo->usuarioPC);
                    $spreadsheet->getActiveSheet()->setCellValue("P$i", $equipo->correo);
                    $spreadsheet->getActiveSheet()->setCellValue("Q$i", $equipo->propietario);
                    $spreadsheet->getActiveSheet()->setCellValue("R$i", $equipo->sede);


                    $spreadsheet->setActiveSheetIndexByName("Perifericos");
                    $perifericos = Perifericos::findGroup($equipo->id);
                    foreach ($perifericos as $periferico) {

                        $spreadsheet->getActiveSheet()->setCellValue("A$j", $equipo->nombre_equipo);
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
                    $spreadsheet->getActiveSheet()->setCellValue("L$i", $ticket->tiempo_en_asignar);
                    $spreadsheet->getActiveSheet()->setCellValue("M$i", $ticket->fecha_completacion);
                    $spreadsheet->getActiveSheet()->setCellValue("N$i", $ticket->tiempo_en_completar);
                    $spreadsheet->getActiveSheet()->setCellValue("O$i", $ticket->fecha_pendiente);
                    $spreadsheet->getActiveSheet()->setCellValue("P$i", $ticket->tiempo_en_pendiente);





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
