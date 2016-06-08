<?php
include "sql.inc";
include "fpdf181/fpdf.php"
$pdfout = new FPDF();
$handbook = $db->query("SELECT title, author, entry, imageids FROM handbook");
while ($entry = $handbook->FetchArray()) {
$pdfout->AddPage("P", "Letter");
$pdfout->SetFont("Arial", "", 14);
$pdfout->Text(100, 100, $entry["title"]);
$pdfout->Text(150, 250, $entry["author"]);
$pdfout->Write(200, 400, $entry["entry"]);
}
$pdf->Output("I");
?>
