<?php
  include "sql.inc";
  $entry = $db->querySingle("SELECT * FROM deleted WHERE id=" . $_GET["id"],True);
  $db->exec("INSERT INTO handbook (id,title,author,entry) VALUES (" . $entry['id'] . "," . $entry['title'] . "," . $entry['author'] . "," . $entry['entry'] . ")");
  $db->exec("DELETE FROM deleted WHERE id=" . $_GET["id"]);
  header("Location: control_panel.php");
?>
