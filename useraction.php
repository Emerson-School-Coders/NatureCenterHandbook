<?php
include("sql.inc");
if ($_POST["action"] == "adduser") {
  if (!isset($_POST["canadd"])) {$_POST["canadd"] = "0";}
  if (!isset($_POST["canedit"])) {$_POST["canedit"] = "0";}
  if (!isset($_POST["candelete"])) {$_POST["candelete"] = "0";}
  $db->exec("INSERT INTO passwords (id,password,canadd,canedit,candelete) VALUES (NULL,\"" . $_POST["password"] . "\"," . $_POST["canadd"] . "," . $_POST["canedit"] . "," . $_POST["candelete"] . ")");
}
else if ($_POST["action"] == "deluser") {
  if ($db->querySingle("SELECT istim FROM passwords WHERE id=".$_POST['id']) == 1) die("You cannot delete Tim's account!"); 
  $db->exec("DELETE FROM passwords WHERE id = " . $_POST["id"]);
}
else if ($_POST["action"] == "moduser") {
  if (!isset($_POST["canadd"])) {$_POST["canadd"] = "0";}
  if (!isset($_POST["canedit"])) {$_POST["canedit"] = "0";}
  if (!isset($_POST["candelete"])) {$_POST["candelete"] = "0";}
  $db->exec("UPDATE passwords SET canadd=".$_POST["canadd"].", canedit=".$_POST["canedit"].", candelete=".$_POST["candelete"]." WHERE id=".$_POST["id"]);
}
else if ($_POST["action"] == "changepass") {
  $oldpass = $db->querySingle("SELECT password FROM passwords WHERE istim=1");
  if ($_POST['oldpass'] == $oldpass) {
    $db->exec("UPDATE passwords SET password=".$_POST['newpass']." WHERE istim=1");
  }
}
if(isset($_REQUEST["destination"])){
      header("Location: {$_SERVER["HTTP_REFERER"]}");
  }else if(isset($_SERVER["HTTP_REFERER"])) {
    header("Location: {$_REQUEST["destination"]}");
  }else{
       header("Location: /index.html");
  }
?>
<html>
  <head>
    <title>Doing user action...</title>
  </head>
</html>
