<?php
include("sql.inc");
$path = '/';
if ($_SERVER['QUERY_STRING'] == "logout") {
  if (headers_sent()) {
    trigger_error("Cant change cookies", E_USER_NOTICE);
  }
  setcookie("userid", $_COOKIE['userid'], time() - 3600, $path);
  if (isset($_COOKIE['tim'])) setcookie("tim", $_COOKIE['tim'], time() - 3600, $path);
}
else {
$final_i = $db->querySingle('SELECT id FROM passwords WHERE password="' . $_POST["password"].'"');
if ($final_i == FALSE) die('<p style="color: #066418; font-family: \'Trebuchet MS\'; margin: 8px; margin-left: 16px; margin-right: 12px;">You have entered an invalid password. Please go back and try again.</p>ID: '.$final_i);
$user = $db->querySingle('SELECT istim FROM passwords WHERE id='.$final_i);
$time = time() + 3600;
if (headers_sent()) {
  trigger_error("Cant change cookies", E_USER_NOTICE);
}
if ($user == 1) {setcookie("tim", "istim", $time, $path);}
setcookie("userid", $final_i, $time, $path);
if (headers_sent()) die("Redirect failed, but it's OK. Just click <a href='index.php'>here</a> to go back to the home page.");
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
