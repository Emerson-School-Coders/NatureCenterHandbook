<?php
class MyDB extends SQLite3 {
  function __construct() {
    $this->open('../database.db');
  }
}
$db = new MyDB();
$i = 1;
echo "database passwords:<br>";
while ($query = $db->querySingle("SELECT * FROM passwords WHERE id=" . $i, true)) {
  print_r($query);
  echo "<br>";
  $i++;
}
echo "<br><br>database handbook:<br>";
$j = 1;
while ($queryf = $db->querySingle("SELECT * FROM handbook WHERE id=" . $j, true)) {
  print_r($queryf);
  echo "<br>";
  $j++;
}
echo "<br><br>database deleted:<br>";
$k = 1;
while ($queryg = $db->querySingle("SELECT * FROM handbook WHERE id=" . $k, true)) {
  print_r($queryg);
  echo "<br>";
  $k++;
}
