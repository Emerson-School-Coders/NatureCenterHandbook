<?php
include "sql.inc";
include "fpdf181/fpdf.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);
$pdfout = new FPDF();
$handbook = $db->query("SELECT title, author, entry, imageids FROM handbook");
$pdfout->SetTitle("Nature Center Handbook PDF");
while ($entry = $handbook->FetchArray()) {
$pdfout->SetFillColor(238, 238, 238);
$pdfout->AddPage("P", "Letter");
$pdfout->SetFont("Helvetica", "B", 24);
$pdfout->SetTextColor(8, 149, 37);
$pdfout->Text(($pdfout->GetPageWidth() - $pdfout->GetStringWidth($entry["title"])) / 2, 35, $entry["title"]);
$pdfout->SetFont("Helvetica", "I", 16);
$pdfout->SetTextColor(136, 136, 136);
$pdfout->Text(($pdfout->GetPageWidth() - $pdfout->GetStringWidth($entry["author"])) / 2, 60, $entry["author"]);
$pics = explode(",", $entry["imageids"]); 
$i = 13;
foreach ($pics as $picid) {
  if ($picid != "-1" && $picid != "") $pdfout->Image("images/id-".$picid.".png", $i += 55, 70, 55, 55);
}
$pdfout->SetFont("Helvetica", "", 12);
$pdfout->SetTextColor(0, 0, 0);
$pdfout->SetXY(10, 120);
$pdfout->Write(6, $entry["entry"]);
}
$pdfout->Output("I", "handbook.pdf");
?>
<html>
  <body>
    <p>Creating PDF...</p>
  </body>
</html>
