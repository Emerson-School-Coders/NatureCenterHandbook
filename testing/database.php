<?php
class MyDB extends SQLite3 {
  function __construct() {
    $this->open('../database.db');
  }
}
$db = new MyDB();
$i = 1;
while ($query = $db->querySingle("SELECT * FROM passwords WHERE id=" . $i, true)) {
  print_r($query);
  echo "<br>";
  $i++;
}
