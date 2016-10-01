<?php
  include "sql.inc";
  print_r($db->querySingle("SELECT * FROM deleted WHERE id=" . $_GET["id"]));
?>
