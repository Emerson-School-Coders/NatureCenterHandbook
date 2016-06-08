<?php
include "sql.inc";
include "fpdf181/fpdf.php";
$pdfout = new FPDF();
$handbook = $db->query("SELECT title, author, entry, imageids FROM handbook");
while ($entry = $handbook->FetchArray()) {
$pdfout->AddPage("P", "Letter");
$pdfout->SetFont("Arial", "", 14);
$pdfout->Text(50, 50, $entry["title"]);
$pdfout->Text(75, 125, $entry["author"]);
$pdfout->SetXY(100, 150);
$pdfout->Write(12, $entry["entry"]);
}
$pdfout->Output("D");
?>
<html>
  <body>
    <p>Creating PDF...</p>
  </body>
</html>
