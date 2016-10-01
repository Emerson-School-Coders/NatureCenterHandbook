<?php
class MyDB extends SQLite3 {
  function __construct() {
    $this->open('database.db');
  }
}
$db = new MyDB();
date_default_timezone_set("EST");
?>
