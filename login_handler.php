<?php
include("sql.inc");
if ($_SERVER['QUERY_STRING'] == "init") {
  $db->exec('DROP TABLE passwords');
  $db->exec('CREATE TABLE passwords (id INTEGER PRIMARY KEY, password STRING, canadd BOOLEAN, canedit BOOLEAN, candelete BOOLEAN, istim BOOLEAN, entyear INT, entgrade INT)');
  $db->exec('INSERT INTO passwords (id, password, canadd, canedit, candelete, istim) VALUES (NULL, "thisistimw", 1, 1, 1, 1)');
}
if ($_SERVER['QUERY_STRING'] == "logout") {
  setcookie("userid", "", time() - 3600);
  setcookie("userperms", "", time() - 3600);
  if (isset($_COOKIE['tim'])) setcookie("tim", "", time() - 3600);
  header("Location: index.html");
}
$result = $db->querySingle('SELECT password FROM passwords', true);
$passfound = false;
$final_i = 0;
$i = 0;
foreach ($result as $onepass) {
  if ($_POST['password'] == $onepass) {
    $passfound = true;
    $final_i = $i;
  }
  $i++;
}
if (end($result) == $onepass) {$final_i = $i; $passfound = true;}
if ($passfound == false || $final_i == 0) die("You have entered an invalid password. Please go back and try again. Last ID checked: " . $i);
$user = $db->querySingle('SELECT canadd, canedit, candelete, istim FROM passwords WHERE id='.$final_i, true);
$perms = 0;
if ($user['canadd'] == 1) $perms = 1;
if ($user['canedit'] == 1) $perms = $perms + 2;
if ($user['candelete'] == 1) $perms = $perms + 4;
$time = time() + 3600;
if ($user['istim'] == 1) {setcookie("tim", "istim", $time);}
setcookie("userperms", $perms, $time);
setcookie("userid", $final_i, $time);
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
