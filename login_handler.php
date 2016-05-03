<?php
include("sql.inc");
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
$user = $db->querySingle('SELECT * FROM passwords WHERE id='.$final_i, true);
$perms = 0;
if ($user['canadd'] == 1) $perms = 1;
if ($user['canedit'] == 1) $perms = $perms + 2;
if ($user['candelete'] == 1) $perms = $perms + 4;
setcookie("userperms", $perms);
setcookie("userid", $final_i);
header("Location: index.html"); /* Redirect browser */
exit();
?>
<html>
  <head>
    <title>Logging you into the Emerson Nature Center Handbook...</title>
  </head>
  <body>
    Please wait...
  </body>
</html>
