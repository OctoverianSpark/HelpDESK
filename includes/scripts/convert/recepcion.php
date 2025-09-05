<?php

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\SimpleType\Jc;
use PhpOffice\PhpWord\SimpleType\TextAlignment;
use PhpOffice\PhpWord\Style\Cell;
use PhpOffice\PhpWord\Writer\Word2007;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Settings;

$phpWord = new PhpWord();


// Configurar renderizador PDF (puede ser Dompdf, mPDF o TCPDF)
Settings::setPdfRendererName(Settings::PDF_RENDERER_DOMPDF);
Settings::setPdfRendererPath(__DIR__ . '/../../../vendor/dompdf/dompdf');



$phpWord->setDefaultFontName("Arial");
$phpWord->setDefaultFontSize(11);
$phpWord->setDefaultParagraphStyle([
  "alignment" => Jc::BOTH,
  "lineHeight" => 1.2
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

$cell->addImage(__DIR__ . '/../../../public/build/img/LOGO.png', [
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
  "ORDEN DE RECEPCIÓN EQUIPOS INFORMÁTICOS",
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

$table->addRow();



$cell = $table->addCell(9688 / 2, ["valign" => "center", "align" => "center", "cellMargin" => 50]);
$cell->addText(
  "Código: " . $order->order_id,
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
  "Fecha de Emisión: " . date("d / m / Y", strtotime($order->emitted_date)),
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
  "Empleado: " . ucwords(strtolower($inv->nombre)),
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
  "Cargo: " . ucwords(strtolower($usr->job_title)),
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
$textRun->addText(" Mediante el presente documento,  GoXpert SAS confirma la recepción de los equipos y accesorios informáticos descritos en el punto 1 al usuario(a) ");
$textRun->addText(ucwords(strtolower("$usr->nombre $usr->apellido")), ["bold" => true]);
$textRun->addText(' identificado con ');
$textRun->addText($usr->id_type . ' ' . $usr->nat_id, ['bold' => true]);
$section->addText("", ["size" => 12]);

$section->addText("El Departamento de Automatización, Tecnología e Informática se encargará de la recolección de los equipos y accesorios en las instalaciones de la empresa. El técnico, junto con el usuario, se compromete a verificar que tanto el equipo como los accesos y credenciales asignados estén en correcto funcionamiento y orden. ");


$section->addText("1. CHECK	LIST DE RECEPCIÓN DE EQUIPO", ["bold" => true, "size" => 12]);

$section->addListItem('FUNCIONAMIENTO ÓPTIMO DEL COMPUTADOR', 0, null);
$section->addListItem('FUNCIONAMIENTO ÓPTIMO DE DIADEMAS', 0, null);
$section->addListItem('FUNCIONAMIENTO ÓPTIMO DE MOUSE', 0, null);
$section->addListItem('FUNCIONAMIENTO ÓPTIMO DE CARGADOR', 0, null);

$section->addText("", ["size" => 12]);
$section->addText("", ["size" => 12]);

$section->addText("2.	DATOS DEL COMPUTADOR Y ACCESORIOS INFORMÁTICOS", ["bold" => true, "size" => 12]);


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
$cell = $table->addCell($cellInvW + 200, $cellStyle);
$cell->addText("SERIAL", [
  "bold" => true,
], [

  "alignment" => Jc::CENTER,
  "spaceBefore" => 100,
  "spaceAfter" => 100
]);
$cell = $table->addCell($cellInvW - 50, $cellStyle);
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




$cell = $table->addCell($cellInvW, $cellStyle);
$cell->addText($inv->tipo ?? "N / A", [], [

  "alignment" => Jc::CENTER,
  "spaceBefore" => 100,
  "spaceAfter" => 100
]);


$cell = $table->addCell($cellInvW, $cellStyle);
$cell->addText($inv->marca ?? "N / A", [], [

  "alignment" => Jc::CENTER,
  "spaceBefore" => 100,
  "spaceAfter" => 100
]);


$cell = $table->addCell($cellInvW, $cellStyle);
$cell->addText($inv->modelo ?? "N / A", [], [

  "alignment" => Jc::CENTER,
  "spaceBefore" => 100,
  "spaceAfter" => 100
]);


$cell = $table->addCell($cellInvW, $cellStyle);
$cell->addText($inv->serial ?? "N / A", [], [

  "alignment" => Jc::CENTER,
  "spaceBefore" => 100,
  "spaceAfter" => 100
]);

$cell = $table->addCell($cellInvW, $cellStyle);
$cell->addText($inv->nombre_equipo ?? "N / A", [], [

  "alignment" => Jc::CENTER,
  "spaceBefore" => 100,
  "spaceAfter" => 100
]);
$cell = $table->addCell($cellInvW, $cellStyle);
$cell->addText("", [], [

  "alignment" => Jc::CENTER,
  "spaceBefore" => 100,
  "spaceAfter" => 100
]);

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




  $cell = $table->addCell($cellInvW, $cellStyle);
  $cell->addText($per->tipo ?? "N / A", [], [

    "alignment" => Jc::CENTER,
    "spaceBefore" => 100,
    "spaceAfter" => 100
  ]);


  $cell = $table->addCell($cellInvW, $cellStyle);
  $cell->addText($per->marca ?? "N / A", [], [

    "alignment" => Jc::CENTER,
    "spaceBefore" => 100,
    "spaceAfter" => 100
  ]);


  $cell = $table->addCell($cellInvW, $cellStyle);
  $cell->addText($per->modelo ?? "N / A", [], [

    "alignment" => Jc::CENTER,
    "spaceBefore" => 100,
    "spaceAfter" => 100
  ]);


  $cell = $table->addCell($cellInvW, $cellStyle);
  $cell->addText($per->serial ?? "N / A", [], [

    "alignment" => Jc::CENTER,
    "spaceBefore" => 100,
    "spaceAfter" => 100
  ]);

  $cell = $table->addCell($cellInvW, $cellStyle);
  $cell->addText($per->nombre_equipo ?? "N / A", [], [

    "alignment" => Jc::CENTER,
    "spaceBefore" => 100,
    "spaceAfter" => 100
  ]);
  $cell = $table->addCell($cellInvW, $cellStyle);
  $cell->addText("", [], [

    "alignment" => Jc::CENTER,
    "spaceBefore" => 100,
    "spaceAfter" => 100
  ]);
}





$section->addText("", ["size" => 12]);
$section->addText("", ["size" => 12]);


$section->addText("3. RESPONSABILIDAD DEL EMPLEADO:", ["bold" => true, "size" => 12]);


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

$cell = $table->addCell(4350, ["valign" => "center"]);
$cell->addImage($_SESSION["sign_name"], [
  "width" => "100%",
  "height" => 80,
  "alignment" => Jc::START
]);



$cell = $table->addCell(4350);

$cell->addImage(__DIR__ . '/../../../public/build/img/firma.png', [
  "width" => "100%",
  "height" => 120,
  "alignment" => Jc::START
]);


$table->addRow();

$cell = $table->addCell(4841.27);
$cell->addText("Nombre: " . ucwords(strtolower("$usr->nombre $usr->apellido")));
$cell = $table->addCell(4841.27);

$cell->addText("Nombre: David Alfonzo Sierra Medina");


$table->addRow();

$cell = $table->addCell(4841.27);
$cell->addText("Identificacion: $usr->tipo_documento $usr->documento");
$cell = $table->addCell(4841.27);

$cell->addText("Identificacion: PPT 6.489.746");

$table->addRow();

$cell = $table->addCell(4841.27);
$cell->addText("Fecha : " . date("d / m / Y", strtotime($order->emitted_date)));
$cell = $table->addCell(4841.27);


$phpWord->getCompatibility()->setOoxmlVersion(15);
$objWriter = new Word2007($phpWord);
// Guardar en disco
$fileName = "recepcion_" . time() . ".docx";
$tempFile = sys_get_temp_dir() . "/" . $fileName;

$writer = IOFactory::createWriter($phpWord, "Word2007");
$writer->save($tempFile);

// Forzar descarga al navegador
header("Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document");
header("Content-Disposition: attachment; filename=\"$fileName\"");
header("Content-Length: " . filesize($tempFile));

readfile($tempFile);
unlink($tempFile); // opcional: eliminar después
exit;
