<?php
include("sql.inc");
$path = '/';
if ($_SERVER['QUERY_STRING'] == "logout") {
  if (headers_sent()) {
    trigger_error("Cant change cookies", E_USER_NOTICE);
  }
  //while (isset($_COOKIE['userid'])) {
  setcookie("userid", $_COOKIE['userid'], time() - 3600, $path);
  if (isset($_COOKIE['tim'])) setcookie("tim", $_COOKIE['tim'], time() - 3600, $path);
  //}
  //header("Location: index.html");
}
else {
$final_i = $db->querySingle('SELECT id FROM passwords WHERE password='.$_POST['password']);
if ($final_i == NULL) die("<p style='color: #066418; font-family: "Trebuchet MS"; margin: 8px; margin-left: 16px; margin-right: 12px;'>You have entered an invalid password. Please go back and try again.</p>");
$user = $db->querySingle('SELECT canadd, canedit, candelete, istim FROM passwords WHERE id='.$final_i, true);
$perms = 0;
if ($user['canadd'] == 1) $perms = 1;
if ($user['canedit'] == 1) $perms = $perms + 2;
if ($user['candelete'] == 1) $perms = $perms + 4;
$time = time() + 3600;
if (headers_sent()) {
  trigger_error("Cant change cookies", E_USER_NOTICE);
}
if ($user['istim'] == 1) {setcookie("tim", "istim", $time, $path);}
setcookie("userid", $final_i, $time, $path);
header("Location: index.html"); /* Redirect browser */
exit();
}
?>
<html>
  <head>
    <title>Logging you into the Emerson Nature Center Handbook...</title>
    <script>if (location.search = "logout") {document.cookie = ""; window.location = "index.php";}</script>
  </head>
  <body>
    Please wait...
  </body>
</html>
