<?php

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\SimpleType\Jc;
use PhpOffice\PhpWord\SimpleType\TextAlignment;
use PhpOffice\PhpWord\Style\Cell;
use PhpOffice\PhpWord\Writer\Word2007;

$phpWord = new PhpWord();


$phpWord->setDefaultFontName("Arial");
$phpWord->setDefaultFontSize(11);
$phpWord->setDefaultParagraphStyle([
   "alignment" => Jc::BOTH,
   "lineHeight"=>1.2
]);
$section = $phpWord->addSection([

   'marginLeft' => 1133.79,
   'marginRight' => 1417.23,
   'marginTop' => 1133.79,
   'marginBottom' => 1133.79,


]);

$header = $section->addHeader();

$table = $header->addTable(['borderSize' => 6, 'borderColor' => '00000', 'height' => 396.825, 'width' => 9733.5601, "align" => "center"]);

// Add row
$table->addRow();
$cell = $table->addCell(1859.41, ['vMerge' => 'restart', 'valign' => 'center']);

$cell->addImage(__DIR__ . '/../../public/build/img/LOGO.png', [
   "width" => 80,
   "alignment" => "center"
]);

$cell = $table->addCell(5816.3526, ['vMerge' => 'restart', 'valign' => 'center']);
$cell->addText(
   "GESTIÓN AUTOMATIZACIÓN, TECNOLOGÍA  E INFORMÁTICA",
   [
      "size" => 12,
      "bold" => true

   ],
   [
      "alignment" => 'center',
   ]
);
$cell->addText(
   "ORDEN DE SALIDA EQUIPOS INFORMÁTICOS",
   [
      "size" => 12,
      "bold" => true

   ],
   [
      "alignment" => 'center',
   ]
);


$cell = $table->addCell(2320, ["valign" => 'center', 'align' => 'center', "cellMargin" => 50]);
$textRun = $cell->addTextRun();
$textRun->addText("Código: ", ["bold" => true], []);
$textRun->addText("GATI-FT-03");

$table->addRow();
$cell = $table->addCell(null, ['vMerge' => 'continue']);
$cell = $table->addCell(null, ['vMerge' => 'continue']);


$cell = $table->addCell(2052, ["valign" => 'center', 'align' => 'center', "cellMargin" => 50]);
$textRun = $cell->addTextRun();
$textRun->addText("Versión: ", ["bold" => true], ["spaceBefore" => 100, "spaceAfter" => 100]);
$textRun->addText("01");
$cell = $table->addRow();
$table->addCell(null, ['vMerge' => 'continue']);
$cell = $table->addCell(null, ['vMerge' => 'continue']);
$cell = $table->addCell(2052, ["valign" => 'center', 'align' => 'center', "cellMargin" => 50]);
$textRun = $cell->addTextRun();
$textRun->addText("Fecha: ", ["bold" => true], ["spaceBefore" => 100, "spaceAfter" => 100]);
$textRun->addText(date("d/m/Y"));
$table->addRow();
$cell = $table->addCell(null, ['vMerge' => 'continue']);
$cell = $table->addCell(null, ['vMerge' => 'continue']);
$cell = $table->addCell(2052, ["valign" => 'center', 'align' => 'center', "cellMargin" => 50]);
$cell->addPreserveText('Página: {PAGE} de {NUMPAGES}', ["bold" => true], ["spaceBefore" => 100, "spaceAfter" => 100]);






$header->addText('', ['size' => 12]);


$table = $section->addTable(["borderColor" => "00000", "borderSize" => 6, "valign" => "center", "width" => 9688]);

$table->addRow(255.102);

$cell = $table->addCell(9688, ["valign" => "center", "align" => "center", 'cellMargin' => 50]);
$cell->addText(
   "Código: " . $order->order_id,
   [
      "size" => 11,
   ],
   [
      "spaceAfter" => 100,
      "spaceBefore" => 100
   ]
);

$section->addText("", ["size" => 12]);


$table = $section->addTable(["borderColor" => "00000", "borderSize" => 6, "valign" => "center", "width" => 9688]);

$table->addRow();


$cell = $table->addCell(9688 / 2, ["valign" => "center", "align" => "center", "cellMargin" => 50]);
$cell->addText(
   "Fecha de Emisión: " . date("d / m / Y" , strtotime($order->emitted_date)),
   [
      "size" => 11
   ],
   [
      "spaceAfter" => 100,
      "spaceBefore" => 100
   ]
);

$cell = $table->addCell(9688 / 2, ["valign" => "center", "align" => "center", "cellMargin" => 50]);
$cell->addText(
   "Fecha de Retorno: " . date("d / m / Y" , strtotime($order->return_date)),
   [
      "size" => 11
   ],
   [
      "spaceAfter" => 100,
      "spaceBefore" => 100
   ]
);


$table->addRow();


$cell = $table->addCell(9688 / 2, ["valign" => "center", "align" => "center", "cellMargin" => 50]);
$cell->addText(
   "Empresa: Asistente Virtual",
   [
      "size" => 11
   ],
   [
      "spaceAfter" => 100,
      "spaceBefore" => 100
   ]
);

$cell = $table->addCell(9688 / 2, ["valign" => "center", "align" => "center", "cellMargin" => 50]);
$cell->addText(
   "Empleado: " . ucwords(strtolower("$usr->nombre $usr->apellido")),
   [
      "size" => 11
   ],
   [
      "spaceAfter" => 100,
      "spaceBefore" => 100
   ]
);

$table->addRow();


$cell = $table->addCell(9688 / 2, ["valign" => "center", "align" => "center", "cellMargin" => 50]);
$cell->addText(
   "Cargo: " . ucwords(strtolower($usr->cargo)),
   [
      "size" => 11
   ],
   [
      "spaceAfter" => 100,
      "spaceBefore" => 100
   ]
);

$cell = $table->addCell(9688 / 2, ["valign" => "center", "align" => "center", "cellMargin" => 50]);
$cell->addText(
   "Area: " . ucwords(strtolower($usr->area)),
   [
      "size" => 11
   ],
   [
      "spaceAfter" => 100,
      "spaceBefore" => 100
   ]
);






$section->addText("", ["size" => 12]);


$textRun = $section->addTextRun([
   "alignment" => Jc::BOTH
]);

$textRun->addText("Mediante el presente documento, ");
$textRun->addText("ASISTENTE VIRTUAL", ["bold" => true]);
$textRun->addText(" autoriza el préstamo, salida y traslado de los siguientes equipos y accesorios informáticos descritos en el punto 1 de este documento al usuario(a) ");
$textRun->addText(ucwords(strtolower("$usr->nombre $usr->apellido")), ["bold" => true]);
$textRun->addText(" por un período de ");
$textRun->addText(calculateDays($order->emitted_date, $order->return_date) . " días.");

$section->addText("", ["size" => 12]);

$section->addText("El Departamento de Automatización, Tecnología e Informática realizará el despacho de los equipos y accesorios en las instalaciones de la empresa  y el usuario se compromete a utilizar los equipos exclusivamente para fines laborales y a cuidarlos de acuerdo con las normas establecidas. El Usuario se compromete a cuidar y devolver estos activos, propiedad de la empresa, en buen estado físico y de funcionamiento, tal y como fueron entregados y en caso de sufrir pérdida, daño, robo o mal funcionamiento este debe verificar de manera inmediata. Al finalizar el periodo de trabajo remoto en el domicilio pautado, el usuario deberá trasladar los equipos y accesorios informáticos anteriormente mencionados en las mismas condiciones en que fueron entregados, para retomar sus actividades en las instalaciones de la empresa. ");



$section->addText("", ["size" => 12]);

$section->addText("1.	DATOS DEL COMPUTADOR Y ACCESORIOS INFORMÁTICOS", ["bold" => true, "size" => 12]);


$section->addText("", ["size" => 12]);
$table = $section->addTable(['borderSize' => 6, 'borderColor' => '00000', "height" => 5000, 'width' => 50000, "align" => "center"]);


$rowInvH = 400.447;
$cellInvW = 1600.875;


$table->addRow($rowInvH);


$cell = $table->addCell(500.522, $cellStyle);
$cell->addText("N°", [
   "bold" => true,
], [

   "alignment" => Jc::CENTER,
   "spaceBefore" => 100,
   "spaceAfter" => 100
]);
$cell = $table->addCell($cellInvW, $cellStyle);
$cell->addText("ITEM", [
   "bold" => true,
], [

   "alignment" => Jc::CENTER,
   "spaceBefore" => 100,
   "spaceAfter" => 100
]);
$cell = $table->addCell($cellInvW, $cellStyle);
$cell->addText("MARCA", [
   "bold" => true,
], [

   "alignment" => Jc::CENTER,
   "spaceBefore" => 100,
   "spaceAfter" => 100
]);
$cell = $table->addCell($cellInvW, $cellStyle);
$cell->addText("MODELO", [
   "bold" => true,
], [

   "alignment" => Jc::CENTER,
   "spaceBefore" => 100,
   "spaceAfter" => 100
]);
$cell = $table->addCell($cellInvW +200, $cellStyle);
$cell->addText("SERIAL", [
   "bold" => true,
], [

   "alignment" => Jc::CENTER,
   "spaceBefore" => 100,
   "spaceAfter" => 100
]);
$cell = $table->addCell($cellInvW-50, $cellStyle);
$cell->addText("NOMBRE", [
   "bold" => true,
], [

   "alignment" => Jc::CENTER,
   "spaceBefore" => 100,
   "spaceAfter" => 100
]);
$cell = $table->addCell($cellInvW + 800, $cellStyle);
$cell->addText("OBSERVACIONES", [
   "bold" => true,
], [

   "alignment" => Jc::CENTER,
   "spaceBefore" => 100,
   "spaceAfter" => 100
]);

$table->addRow($rowInvH);

$cell = $table->addCell(470.522, $cellStyle);
$cell->addText("1", [
   "bold" => true,
], [

   "alignment" => Jc::CENTER,
   "spaceBefore" => 100,
   "spaceAfter" => 100
]);


foreach ($cols as $col) {


   $cell = $table->addCell($cellInvW, $cellStyle);
   $cell->addText($eq->$col ?? "N / A", [], [

      "alignment" => Jc::CENTER,
      "spaceBefore" => 100,
      "spaceAfter" => 100
   ]);
}

$n = 2;
   foreach ($pers as $per) {

      $table->addRow($rowInvH);
      $cell = $table->addCell(470.522, $cellStyle);

      $cell->addText($n++, [
         "bold" => true,
      ], [

         "alignment" => Jc::CENTER,
         "spaceBefore" => 100,
         "spaceAfter" => 100
      ]);


      foreach ($cols as $col) {


         $cell = $table->addCell(470.522, $cellStyle);

         $cell->addText(strtoupper($pers->$col ?? "N / A"), [], [

            "alignment" => Jc::CENTER,
            "spaceBefore" => 100,
            "spaceAfter" => 100
         ]);
      }
   }





$section->addText("", ["size" => 12]);


$section->addText("2. RESPONSABILIDAD DEL EMPLEADO:", ["bold" => true, "size" => 12]);


$section->addText("", ["size" => 12]);



$section->addText("Al firmar este documento, el usuario manifiesta su compromiso con la empresa de cuidar y devolver los activos descritos en este anexo en buen estado físico y funcional.");


$section->addText("", ["size" => 12]);

$section->addText("Además, garantiza que, en caso de que el equipo sufra daños o pérdidas, ya sean parciales o totales, asumirá la responsabilidad ante la empresa por los equipos mencionados.");

$section->addText("", ["size" => 12]);

$section->addText("", ["size" => 12]);


$table = $section->addTable(["width" => 4841.27]);

$table->addRow();

$cell = $table->addCell(4841.27);
$cell->addText("Firma del Usuario:", ["bold" => true, "size" => 12], ["alignment" => Jc::START]);


$cell = $table->addCell(4841.27);
$cell->addText("Firma del Representante de la EMPRESA:", ["bold" => true, "size" => 12], ["alignment" => Jc::START]);


//NOTE: SIGN CELLS
$rHeight = 1500;
$table->addRow();

$cell = $table->addCell(4350,["valign"=>"center"]);
$cell->addImage(__DIR__ . '/../../public/build/img/sign.png', [
   "width" => "100%",
   "height"=> 80,
   "alignment" => Jc::START
]);



$cell = $table->addCell(4350);

$cell->addImage(__DIR__ . '/../../public/build/img/firma.png', [
   "width" => "100%",
   "height"=> 120,
   "alignment" => Jc::START
]);


$table->addRow();

$cell = $table->addCell(4841.27);
$cell->addText("Nombre: " . ucwords(strtolower("$usr->nombre $usr->apellido")));
$cell = $table->addCell(4841.27);

$cell->addText("Nombre: Jeandry de Jesus Rodríguez Zerpa");


$table->addRow();

$cell = $table->addCell(4841.27);
$cell->addText("Identificacion: $usr->tipo_documento $usr->documento");
$cell = $table->addCell(4841.27);

$cell->addText("Identificacion: CC 1.034.313.183");

$table->addRow();

$cell = $table->addCell(4841.27);
$cell->addText("Fecha : " . date("d / m / Y", strtotime($order->emitted_date)));
$cell = $table->addCell(4841.27);














$phpWord->getCompatibility()->setOoxmlVersion(15);
$objWriter = new Word2007($phpWord);
$name = "$order->order_id.docx";
$objWriter->save($name);
saveData($name);
unlink(__DIR__ . '/../../public/build/img/sign.png');











