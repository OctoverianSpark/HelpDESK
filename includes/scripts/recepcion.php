<?php

// FIX — Discard any output already buffered by the controller (JSON echo,
//        PHP warnings, whitespace) before we stream the binary .docx file.
//        Even a single stray byte before the headers corrupts the Word file.
if (ob_get_level() > 0) {
    ob_end_clean();
}

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\SimpleType\Jc;
use PhpOffice\PhpWord\SimpleType\TextAlignment;
use PhpOffice\PhpWord\Style\Cell;
use PhpOffice\PhpWord\Writer\Word2007;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Settings;

// ─────────────────────────────────────────────────────────────────────────────
// FIX #1 — Define $cellStyle before it is used anywhere in this file.
//           Previously undefined, causing ~20 PHP warnings per request.
// ─────────────────────────────────────────────────────────────────────────────
$cellStyle = [
    "borderSize"  => 6,
    "borderColor" => "000000",
    "valign"      => "center",
    "cellMargin"  => 50,
];

// ─────────────────────────────────────────────────────────────────────────────
// FIX #2 — Normalise $usr field names with safe fallbacks.
//           PIVOTFINDER returns first_name/last_name, but the paragraph at
//           line 208 used $usr->nombre/$usr->apellido — pick one convention
//           and apply it everywhere via local variables so neither blows up
//           regardless of what the model returns.
// ─────────────────────────────────────────────────────────────────────────────
$usrFirstName = $usr->first_name ?? $usr->nombre    ?? "N/A";
$usrLastName  = $usr->last_name  ?? $usr->apellido  ?? "N/A";
$usrFullName  = ucwords(strtolower("$usrFirstName $usrLastName"));
$usrJobTitle  = $usr->job_title  ?? $usr->cargo     ?? "N/A";
$usrArea      = $usr->area       ?? "N/A";
$usrIdType    = $usr->id_type    ?? "N/A";
$usrNatId     = $usr->nat_id     ?? "N/A";

// ─────────────────────────────────────────────────────────────────────────────

$phpWord = new PhpWord();

$phpWord->setDefaultFontName("Arial");
$phpWord->setDefaultFontSize(11);
$phpWord->setDefaultParagraphStyle([
    "alignment"  => Jc::BOTH,
    "lineHeight" => 1.2,
]);

$section = $phpWord->addSection([
    "marginLeft"   => 1133.79,
    "marginRight"  => 1417.23,
    "marginTop"    => 1133.79,
    "marginBottom" => 1133.79,
]);

// ── Header ───────────────────────────────────────────────────────────────────

$header = $section->addHeader();

$table = $header->addTable([
    "borderSize"  => 6,
    "borderColor" => "000000",   // FIX: was "00000" (5 chars) — must be 6 hex digits
    "height"      => 396.825,
    "width"       => 9733.5601,
    "align"       => "center",
]);

$table->addRow();
$cell = $table->addCell(1859.41, ["vMerge" => "restart", "valign" => "center"]);
$cell->addImage(__DIR__ . "/../../../public/build/img/LOGO.png", [
    "width"     => 80,
    "alignment" => "center",
]);

$cell = $table->addCell(5816.3526, ["vMerge" => "restart", "valign" => "center"]);
$cell->addText(
    "GESTIÓN AUTOMATIZACIÓN, TECNOLOGÍA  E INFORMÁTICA",
    ["size" => 12, "bold" => true],
    ["alignment" => "center"]
);
$cell->addText(
    "ORDEN DE RECEPCIÓN EQUIPOS INFORMÁTICOS",
    ["size" => 12, "bold" => true],
    ["alignment" => "center"]
);

$cell = $table->addCell(2320, ["valign" => "center", "align" => "center", "cellMargin" => 50]);
$textRun = $cell->addTextRun();
$textRun->addText("Código: ", ["bold" => true]);
$textRun->addText("GATI-FT-03");

$table->addRow();
$table->addCell(null, ["vMerge" => "continue"]);
$table->addCell(null, ["vMerge" => "continue"]);
$cell = $table->addCell(2052, ["valign" => "center", "align" => "center", "cellMargin" => 50]);
$textRun = $cell->addTextRun();
$textRun->addText("Versión: ", ["bold" => true], ["spaceBefore" => 100, "spaceAfter" => 100]);
$textRun->addText("01");

$table->addRow();
$table->addCell(null, ["vMerge" => "continue"]);
$table->addCell(null, ["vMerge" => "continue"]);
$cell = $table->addCell(2052, ["valign" => "center", "align" => "center", "cellMargin" => 50]);
$textRun = $cell->addTextRun();
$textRun->addText("Fecha: ", ["bold" => true], ["spaceBefore" => 100, "spaceAfter" => 100]);
$textRun->addText(date("d/m/Y"));

$table->addRow();
$table->addCell(null, ["vMerge" => "continue"]);
$table->addCell(null, ["vMerge" => "continue"]);
$cell = $table->addCell(2052, ["valign" => "center", "align" => "center", "cellMargin" => 50]);
$cell->addPreserveText("Página: {PAGE} de {NUMPAGES}", ["bold" => true], ["spaceBefore" => 100, "spaceAfter" => 100]);

$header->addText("", ["size" => 12]);

// ── Order metadata table ──────────────────────────────────────────────────────

$table = $section->addTable([
    "borderColor" => "000000",   // FIX: was "00000"
    "borderSize"  => 6,
    "valign"      => "center",
    "width"       => 9688,
]);

$table->addRow();
$cell = $table->addCell(9688 / 2, ["valign" => "center", "align" => "center", "cellMargin" => 50]);
$cell->addText("Código: " . $order->order_id, ["size" => 11], ["spaceAfter" => 100, "spaceBefore" => 100]);

$cell = $table->addCell(9688 / 2, ["valign" => "center", "align" => "center", "cellMargin" => 50]);
$cell->addText(
    "Fecha de Emisión: " . date("d / m / Y", strtotime($order->emitted_date)),
    ["size" => 11],
    ["spaceAfter" => 100, "spaceBefore" => 100]
);

$table->addRow();
$cell = $table->addCell(9688 / 2, ["valign" => "center", "align" => "center", "cellMargin" => 50]);
$cell->addText("Empresa: Asistente Virtual", ["size" => 11], ["spaceAfter" => 100, "spaceBefore" => 100]);

$cell = $table->addCell(9688 / 2, ["valign" => "center", "align" => "center", "cellMargin" => 50]);
$cell->addText(
    "Empleado: " . ucwords(strtolower($inv->nombre ?? "N/A")),
    ["size" => 11],
    ["spaceAfter" => 100, "spaceBefore" => 100]
);

$table->addRow();
$cell = $table->addCell(9688 / 2, ["valign" => "center", "align" => "center", "cellMargin" => 50]);
$cell->addText(
    "Cargo: " . ucwords(strtolower($usrJobTitle)),   // FIX #2
    ["size" => 11],
    ["spaceAfter" => 100, "spaceBefore" => 100]
);

$cell = $table->addCell(9688 / 2, ["valign" => "center", "align" => "center", "cellMargin" => 50]);
$cell->addText(
    "Area: " . ucwords(strtolower($usrArea)),        // FIX #2
    ["size" => 11],
    ["spaceAfter" => 100, "spaceBefore" => 100]
);

// ── Intro paragraph ──────────────────────────────────────────────────────────

$section->addText("", ["size" => 12]);

$textRun = $section->addTextRun(["alignment" => Jc::BOTH]);
$textRun->addText("Mediante el presente documento, ");
$textRun->addText("ASISTENTE VIRTUAL", ["bold" => true]);
$textRun->addText(
    " GoXpert SAS confirma la recepción de los equipos y accesorios informáticos" .
    " descritos en el punto 1 al usuario(a) "
);
$textRun->addText($usrFullName, ["bold" => true]);   // FIX #2 — was $usr->nombre $usr->apellido
$textRun->addText(" identificado con ");
$textRun->addText("$usrIdType $usrNatId", ["bold" => true]);

$section->addText("", ["size" => 12]);
$section->addText(
    "El Departamento de Automatización, Tecnología e Informática se encargará de la" .
    " recolección de los equipos y accesorios en las instalaciones de la empresa." .
    " El técnico, junto con el usuario, se compromete a verificar que tanto el equipo" .
    " como los accesos y credenciales asignados estén en correcto funcionamiento y orden."
);

// ── Check list ───────────────────────────────────────────────────────────────

$section->addText("1. CHECK\tLIST DE RECEPCIÓN DE EQUIPO", ["bold" => true, "size" => 12]);
$section->addListItem("FUNCIONAMIENTO ÓPTIMO DEL COMPUTADOR", 0, null);
$section->addListItem("FUNCIONAMIENTO ÓPTIMO DE DIADEMAS",    0, null);
$section->addListItem("FUNCIONAMIENTO ÓPTIMO DE MOUSE",       0, null);
$section->addListItem("FUNCIONAMIENTO ÓPTIMO DE CARGADOR",    0, null);

$section->addText("", ["size" => 12]);
$section->addText("", ["size" => 12]);

// ── Equipment table ───────────────────────────────────────────────────────────

$section->addText("2.\tDATOS DEL COMPUTADOR Y ACCESORIOS INFORMÁTICOS", ["bold" => true, "size" => 12]);
$section->addText("", ["size" => 12]);

$table = $section->addTable([
    "borderSize"  => 6,
    "borderColor" => "000000",   // FIX: was "00000"
    "height"      => 5000,
    "width"       => 50000,
    "align"       => "center",
]);

$rowInvH   = 400.447;
$cellInvW  = 1600.875;

// Header row — defined as a list of pairs to avoid duplicate-key array collapsing
$table->addRow($rowInvH);

$headerCols = [
    ["N°",             500.522],
    ["ITEM",           $cellInvW],
    ["MARCA",          $cellInvW],
    ["MODELO",         $cellInvW],
    ["SERIAL",         $cellInvW + 200],
    ["NOMBRE",         $cellInvW - 50],
    ["OBSERVACIONES",  $cellInvW + 800],
];
foreach ($headerCols as [$label, $width]) {
    $cell = $table->addCell($width, $cellStyle);
    $cell->addText($label, ["bold" => true], ["alignment" => Jc::CENTER, "spaceBefore" => 100, "spaceAfter" => 100]);
}

// Main computer row
$table->addRow($rowInvH);
$cell = $table->addCell(470.522, $cellStyle);
$cell->addText("1", ["bold" => true], ["alignment" => Jc::CENTER, "spaceBefore" => 100, "spaceAfter" => 100]);

$invFields = [
    [$cellInvW,       $inv->tipo          ?? "N / A"],
    [$cellInvW,       $inv->marca         ?? "N / A"],
    [$cellInvW,       $inv->modelo        ?? "N / A"],
    [$cellInvW + 200, $inv->serial        ?? "N / A"],
    [$cellInvW - 50,  $inv->nombre_equipo ?? "N / A"],
    [$cellInvW + 800, ""],
];
foreach ($invFields as [$w, $val]) {
    $cell = $table->addCell($w, $cellStyle);
    $cell->addText($val, [], ["alignment" => Jc::CENTER, "spaceBefore" => 100, "spaceAfter" => 100]);
}

// Peripheral rows
$n = 2;
foreach ($pers as $per) {
    $table->addRow($rowInvH);

    $cell = $table->addCell(470.522, $cellStyle);
    $cell->addText($n++, ["bold" => true], ["alignment" => Jc::CENTER, "spaceBefore" => 100, "spaceAfter" => 100]);

    $perFields = [
        [$cellInvW,       $per->tipo          ?? "N / A"],
        [$cellInvW,       $per->marca         ?? "N / A"],
        [$cellInvW,       $per->modelo        ?? "N / A"],
        [$cellInvW + 200, $per->serial        ?? "N / A"],
        [$cellInvW - 50,  $per->nombre_equipo ?? "N / A"],
        [$cellInvW + 800, ""],
    ];
    foreach ($perFields as [$w, $val]) {
        $cell = $table->addCell($w, $cellStyle);
        $cell->addText($val, [], ["alignment" => Jc::CENTER, "spaceBefore" => 100, "spaceAfter" => 100]);
    }
}

// ── Responsibility section ────────────────────────────────────────────────────

$section->addText("", ["size" => 12]);
$section->addText("", ["size" => 12]);
$section->addText("3. RESPONSABILIDAD DEL EMPLEADO:", ["bold" => true, "size" => 12]);
$section->addText("", ["size" => 12]);
$section->addText(
    "Al firmar este documento, el usuario manifiesta su compromiso con la empresa" .
    " de cuidar y devolver los activos descritos en este anexo en buen estado físico y funcional."
);
$section->addText("", ["size" => 12]);
$section->addText(
    "Además, garantiza que, en caso de que el equipo sufra daños o pérdidas, ya sean parciales" .
    " o totales, asumirá la responsabilidad ante la empresa por los equipos mencionados."
);
$section->addText("", ["size" => 12]);
$section->addText("", ["size" => 12]);

// ── Signature table ───────────────────────────────────────────────────────────

$table = $section->addTable(["width" => 9682]);   // FIX: original was 4841.27 which only covers half the page

$table->addRow();
$cell = $table->addCell(4841);
$cell->addText("Firma del Usuario:", ["bold" => true, "size" => 12], ["alignment" => Jc::START]);
$cell = $table->addCell(4841);
$cell->addText("Firma del Representante de la EMPRESA:", ["bold" => true, "size" => 12], ["alignment" => Jc::START]);

$table->addRow();
$cell = $table->addCell(4350, ["valign" => "center"]);
$cell->addText("", ["size" => 12]);
$cell = $table->addCell(4350);
$cell->addImage(__DIR__ . "/../../../public/build/img/firma.png", [
    "width"     => "100%",
    "height"    => 120,
    "alignment" => Jc::START,
]);

$table->addRow();
$cell = $table->addCell(4841);
$cell->addText("Nombre: " . $usrFullName);   // FIX #2 — was $usr->first_name $usr->last_name
$cell = $table->addCell(4841);
$cell->addText("Nombre: David Alfonzo Sierra Medina");

$table->addRow();
$cell = $table->addCell(4841);
$cell->addText("Identificacion: $usrIdType $usrNatId");   // FIX #2
$cell = $table->addCell(4841);
$cell->addText("Identificacion: PPT 6.489.746");

$table->addRow();
$cell = $table->addCell(4841);
$cell->addText("Fecha : " . date("d / m / Y", strtotime($order->emitted_date)));
$cell = $table->addCell(4841);
$cell->addText("");

// ── Write and stream the file ─────────────────────────────────────────────────

$phpWord->getCompatibility()->setOoxmlVersion(15);

$fileName = "recepcion_" . time() . ".docx";
$tempFile = sys_get_temp_dir() . "/" . $fileName;

$writer = IOFactory::createWriter($phpWord, "Word2007");
$writer->save($tempFile);

// Discard anything that may have been buffered during the PhpWord build
if (ob_get_level() > 0) {
    ob_end_clean();
}

header("Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document");
header("Content-Disposition: attachment; filename=\"$fileName\"");
header("Content-Length: " . filesize($tempFile));

readfile($tempFile);
unlink($tempFile);
exit;