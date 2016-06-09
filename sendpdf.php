<?php
include "sql.inc";
include "fpdf181/fpdf.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);
$pdfout = new FPDF();
$handbook = $db->query("SELECT title, author, entry, imageids FROM handbook");
$pdfout->SetTitle("Nature Center Handbook PDF");
while ($entry = $handbook->FetchArray()) {
$pdfout->AddPage("P", "Letter");
$pdfout->SetFont("Helvetica", "B", 24);
$pdfout->Text(($pdfout->GetPageWidth() - $pdfout->GetStringWidth($entry["title"])) / 2, 25, $entry["title"]);
$pdfout->SetFont("Helvetica", "I", 16);
$pdfout->Text(($pdfout->GetPageWidth() - $pdfout->GetStringWidth($entry["author"])) / 2, 50, $entry["author"]);
$pdfout->SetFont("Helvetica", "", 12);
$pdfout->SetXY(10, 85);
$pdfout->Write(6, $entry["entry"]);
}
$pdfout->Output("I", "handbook.pdf");
?>
<html>
  <body>
    <p>Creating PDF...</p>
  </body>
</html>
