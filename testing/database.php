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
$h = 1;
$db->query("SELECT * FROM deleted");
while ($queryg = $db->fetchArray(SQLITE3_NUM)) {
  print_r($queryg);
  echo "<br>";
  $h++;
}
