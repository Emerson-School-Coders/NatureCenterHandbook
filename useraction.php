<?php
include("sql.inc");
if ($_POST["action"] == "adduser") {
  if (!isset($_POST["canadd"])) {$_POST["canadd"] = "0";}
  if (!isset($_POST["canedit"])) {$_POST["canedit"] = "0";}
  if (!isset($_POST["candelete"])) {$_POST["candelete"] = "0";}
  $db->exec("INSERT INTO passwords (id,password,canadd,canedit,candelete) VALUES (NULL,\"" . $_POST["password"] . "\"," . $_POST["canadd"] . "," . $_POST["canedit"] . "," . $_POST["candelete"] . ")");
}
?>
