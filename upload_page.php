<?php
$echof = ":";
function echof($text) {
  global $echof;
  $echof = $echof . $text;
}
include "sql.inc";
ini_set('display_errors',1);
error_reporting(E_ALL);
if (isset($_COOKIE['userid']) && $db->querySingle("SELECT canadd FROM passwords WHERE id=".$_COOKIE['userid']) == "1") {
$target_dir = "images/";
$images = scandir($target_dir);
$last_id = ltrim(end($images), "id-");
$last_id = rtrim($last_id, ".png");
$firstid = intval($last_id) + 1;
$target_file = $target_dir . "id-" . $firstid . ".png";
$uploadOk = 1;
$typeAllowed = array("image/png");
$check = getimagesize($_FILES["image1"]["tmp_name"]);
if ($check !== false) {
  $uploadOk = 1;
} else {
 echof( "The first file you uploaded is not a valid PNG image.<br>");
  $uploadOk = 0;
}
if ($_FILES["image1"]["size"] > 500000) {
  echof( "Sorry, your first file is too large. Your size was " . $_FILES["image1"]["size"] . " bytes.<br>");
  $uploadOk = 0;
}
if (pathinfo($_FILES['image1']['name'], PATHINFO_EXTENSION) != "png") {
  echof( 'You can only upload PNG images. (first file) Your type was "' . $_FILES['image1']['type'] . '".<br>');
  $uploadOk = 0;
}
if ($uploadOk == 0) {
  echof( "Sorry, your first file was not uploaded.<br>");
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["image1"]["tmp_name"], $target_file)) {
    $uploadOk = 1;
  } else {
     echof( "Sorry, there was an error uploading your first file.<br>");
     $uploadOk = 0;
  }
}
$uploadOks = 1;
if (isset($_FILES['image2']['name']) && !empty($_FILES['image2']['name'])) {
  $target_dir = "images/";
$secondid = $firstid + 1;
$target_files = $target_dir . "id-" . $secondid . ".png";
$check = getimagesize($_FILES["image2"]["tmp_name"]);
if ($check !== false) {
  $uploadOks = 1;
} else {
  echof( "The second file you uploaded is not a valid PNG image.<br>");
  $uploadOks = 0;
}
if ($_FILES["image2"]["size"] > 500000) {
  echof( "Sorry, your second file is too large. Your size was " . $_FILES["image2"]["size"] . " bytes.<br>");
  $uploadOks = 0;
}
if (pathinfo($_FILES['image1']['name'], PATHINFO_EXTENSION) != "png"){
  echof( 'You can only upload PNG images. (second file) Your type was ' . $_FILES['image2']['type'] . "<br>");
  $uploadOks = 0;
}
if ($uploadOks == 0) {
  echof( "Sorry, your second file was not uploaded.<br>");
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["image2"]["tmp_name"], $target_files)) {
    $uploadOks = 1;
  } else {
     echof( "Sorry, there was an error uploading your second file.<br>");
     $uploadOk = 0;
  }
}
} else $secondid = -1;
if ($uploadOk == 1 && $uploadOks == 1 && $echof == ":") $insert_result = $db->exec('INSERT INTO handbook (id,title,author,entry,imageids) VALUES (NULL,"'.$_POST["title"].'","'.$_POST["author"].'","'.$_POST["entry"].'","'.$firstid.",".$secondid.'")');
else {echo $echof . "Your entry was not added.<br>Upload 1: ".$uploadOk."Upload 2: ".$uploadOks."Echo: ".$echof; header(""); flush();}
if (!$insert_result) {die("An error occurred inserting the entry."); unlink($target_file); if (isset($_FILES['image2']['name']) && !empty($_FILES['image2']['name'])) unlink($target_files);}
if (!headers_sent()) header("Location: view.php?id=".$db->querySingle("SELECT id FROM handbook WHERE title='".$_POST['title']."'"));
else echo 'Please press the back button on your browser.';
} else die("You cannot upload a page!");
?>
<html>
  <head>
    <title>Uploading...</title>
  </head>
</html>
