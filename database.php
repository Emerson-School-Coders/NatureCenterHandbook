<?php
include "sql.inc";
$i = 1;
while ($query = $db->querySingle("SELECT * FROM passwords WHERE id=" . $i, true)) {
  print_r($query);
  echo "<br>";
  $i++;
}
