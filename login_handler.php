<?php
class MyDB extends SQLite3 {
  function __construct() {
    this->open('database.db');
  }
}
$db = new MyDB();
if ($_SERVER['QUERY_STRING'] == "init") {
  $db->exec('CREATE TABLE passwords (id INT, password STRING, canadd BOOLEAN, canedit BOOLEAN, entyear INT, entgrade INT)');
}
$result = $db->query('SELECT password FROM passwords');
$passfound = false;
$final_i = 0;
$i = 1;
foreach ($result->FetchArray() as $onepass) {
  if ($_POST['password'] == $onepass) {
    $passfound = true;
    $final_i = $i;
  }
  $i++;
}
if ($passfound == false || $final_i == 0) die("You have entered an invalid password. Please go back and try again.");

?>
<html>
  <head>
    <title>Logging you into the Emerson Nature Center Handbook...</title>
  </head>
  <body>
    Please wait...
  </body>
</html>
