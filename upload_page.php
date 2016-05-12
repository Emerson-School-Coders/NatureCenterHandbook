<?php
include "sql.inc";
$target_dir = "images/";
$images = scandir($target_dir);
$last_id = ltrim(end($images), "id-");
$last_id = rtrim($last_id, ".png");
$firstid = intval($last_id) + 1;
$target_file = $target_dir . "id-" . $firstid . ".png";
$uploadOk = 1;
$typeAllowed = array("image/png");
//$check = getimagesize($_FILES["image1"]["tmp_name"]);
//if ($check !== false) {
//  $uploadOk = 1;
//} else {
//  echo "The first file you uploaded is not a valid PNG image.";
//  $uploadOk = 0;
//}
if ($_FILES["image1"]["size"] > 500000) {
  echo "Sorry, your first file is too large. Your size was " . $_FILES["image1"]["size"] . " bytes.";
  $uploadOk = 0;
}
if (!in_array($_FILES['image1']['type'], $typeAllowed)){
  echo 'You can only upload PNG images. (first file) Your type was "' . $_FILES['image1']['type'] . '".';
  $uploadOk = 0;
}
if ($uploadOk == 0) {
  echo "Sorry, your first file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["image1"]["tmp_name"], $target_file)) {
    $uploadOk = 1;
  } else {
     echo "Sorry, there was an error uploading your first file.";
  }
}
if (isset($_FILES['image2'])) {
  $target_dir = "images/";
$secondid = $firstid + 1;
$target_file = $target_dir . "id-" . $secondid . ".png";
$uploadOk = 1;
//$check = getimagesize($_FILES["image2"]["tmp_name"]);
//if ($check !== false) {
//} else {
//  echo "The second file you uploaded is not a valid PNG image.";
//  $uploadOk = 0;
//}
if ($_FILES["image2"]["size"] > 500000) {
  echo "Sorry, your second file is too large. Your size was " . $_FILES["image2"]["size"] . " bytes.";
  $uploadOk = 0;
}
if (!in_array($_FILES['image1']['type'], $typeAllowed)){
  echo 'You can only upload PNG images. (second file) Your type was ' . $_FILES['image2']['type'];
  $uploadOk = 0;
}
if ($uploadOk == 0) {
  echo "Sorry, your second file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["image2"]["tmp_name"], $target_file)) {
    $uploadOk = 1;
  } else {
     echo "Sorry, there was an error uploading your second file.";
  }
}
} else $secondid = "\b";
$db->exec('INSERT INTO handbook (id,title,author,entry,imageids) VALUES (NULL,"'.$_POST["title"].'","'.$_POST["author"].'","'.$_POST["entry"].'","'.$firstid.','.$secondid.'")');
if (!headers_sent()) header("Location: view.php?id=".$db->querySingle("SELECT id FROM handbook WHERE title='".$_POST['title']."'"));
else echo 'Please press the back button on your browser.';
?>
<html>
  <head>
    <title>Uploading...</title>
  </head>
</html>
