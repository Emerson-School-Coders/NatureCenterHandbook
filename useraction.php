<?php
include("sql.inc");
if ($_POST["action"] == "adduser") {
  $db->exec("INSERT INTO passwords (id,password,canadd,canedit,candelete) VALUES (NULL," . $_POST["password"] . "," . $_POST["canadd"] . "," . $_POST["canedit"] . "," . $_POST["candelete"] . ")");
}
?>
