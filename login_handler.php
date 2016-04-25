<?php
/*$conn = new mysqli("localhost", "root");
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}*/
?>
<html>
  <head>
    <title>Logging you into the Emerson Nature Center Handbook...</title>
  </head>
  <body>
    Please wait...
    <?php echo $_POST['password']; ?>
  </body>
</html>
