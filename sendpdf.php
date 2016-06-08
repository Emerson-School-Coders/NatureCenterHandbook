<?php
include "sql.inc";
include "fpdf181/fpdf.php";
$pdfout = new FPDF();
$handbook = $db->query("SELECT title, author, entry, imageids FROM handbook");
while ($entry = $handbook->FetchArray()) {
$pdfout->AddPage("P", "Letter");
$pdfout->SetFont("Arial", "", 14);
$pdfout->Text(($pdfout->GetPageHeight() - $pdfout->GetStringWidth($entry["title"])) / 2.7, 50, $entry["title"]);
$pdfout->Text(($pdfout->GetPageHeight() - $pdfout->GetStringWidth($entry["author"])) / 2.7, 100, $entry["author"]);
$pdfout->SetXY(10, 125);
$pdfout->Write(12, $entry["entry"]);
}
$pdfout->Output("D");
?>
<html>
  <body>
    <p>Creating PDF...</p>
  </body>
</html>
