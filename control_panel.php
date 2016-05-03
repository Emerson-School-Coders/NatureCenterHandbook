<?php
include("sql.inc");
if (isset($_POST["modpass"])) {
$passid = $_POST["password"];
$modpass = true;
}
else {$modpass = false;}
if (isset($_COOKIE['tim'])) {$tim = true;}
else {$tim = false;}
?>
<html>
  <head>
    <title>Emerson School Nature Center Handbook - Tim's Control Panel</title>
    <link rel="stylesheet" href="page.css" type="text/css">
  </head>
  <body>
    <?php include "navigator.html";?>
    <h1>User Control Panel - Tim only!</h1>
    <?php if ($tim) {
      echo "<p>You are not Tim! Go away! You may not control the users!</p>";
    } ?>
    <form action="useraction.php" method="POST">
      <h3>Add New User</h3>
      <input type="hidden" name="action" value="adduser">
      <input type="hidden" name="destination" value="<?php echo $_SERVER["REQUEST_URL"]; ?>"/>
      <p>
      New password: <input type="text" name="password"><br>
      Can add pages: <input type="checkbox" name="canadd" value="1"><br>
      Can edit pages: <input type="checkbox" name="canedit" value="1"><br>
      Can delete pages: <input type="checkbox" name="candelete" value="1"><br>
      <input type="submit" value="Add User">
      </p>
    </form>
    <form action="<?php if (isset($_COOKIE["modpass"])) {$modpass=true; echo "useraction.php";} else {$modpass=false; echo htmlspecialchars($_SERVER["PHP_SELF"]);}?>" method="POST">
      <h3>Modify User Permissions</h3>
      <?php if ($modpass) {echo '<input type="hidden" name="action" value="moduser">';}?>
      <p><?php echo $modpass; ?>
        <?php if (!$modpass) {echo 'ID: <input type="text" name="password"><br><input type="hidden" name="modpass" value="true"><input type="submit" value="Continue"><!-- ';}?>
        Can add pages: <input type="checkbox" name="canadd" value="true" <?php if ($modpass) {if ($db->querySingle("SELECT canadd FROM passwords WHERE id = " . $passid) == "1") {echo "checked";}}?>><br>
        Can edit pages: <input type="checkbox" name="canedit" value="true" <?php if ($modpass) {if ($db->querySingle("SELECT canedit FROM passwords WHERE id = " . $passid) == "1") {echo "checked";}}?>><br>
        Can delete pages: <input type="checkbox" name="candelete" value="true" <?php if ($modpass) {if ($db->querySingle("SELECT candelete FROM passwords WHERE id = " . $passid) == "1") {echo "checked";}}?>><br>
        <input type="submit" value="Edit User">
        <?php if (!$modpass) {echo "-->";} ?>
      </p>
    </form>
    <form action="useraction.php" method="POST">
      <h3>Delete User</h3>
      <input type="hidden" name="action" value="deluser">
      <p>ID (see below): <input type="text" name="id"><br>
      <input type="submit" value="Delete User"></p>
    </form>
    <div id="viewusers">
    <h3>View all users</h3>
    <p>0 = no, 1 = yes<br>
    <?php
    $query = $db->query("SELECT * FROM passwords");
    while ($entry = $query->fetchArray(SQLITE3_ASSOC)) {
     echo 'ID: ' . $entry['id'] . '  Password: ' . $entry['password'] . '  Can add: ' . $entry['canadd'] . '  Can edit: ' . $entry['canedit'] . '  Can delete: ' . $entry['candelete'] . '<br>';
    }
    ?>
    </p>
    </div>
    <?php if ($tim) {
      //echo "-->";
    } ?>
  </body>
</html>
