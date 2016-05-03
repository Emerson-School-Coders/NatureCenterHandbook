<?php
include("sql.inc");
if (isset($_POST["modpass"]) && !empty($_POST["modpass"]) && !is_null($_POST["modpass"]) && isset($_POST["password"]) && !empty($_POST["password"]) && !is_null($_POST["password"])) {
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
      <input type="hidden" name="destination" value="<?php echo $_SERVER['REQUEST_URL']; ?>"/>
      <p>
      New password: <input type="text" name="password"><br>
      Can add pages: <input type="checkbox" name="canadd" value="1"><br>
      Can edit pages: <input type="checkbox" name="canedit" value="1"><br>
      Can delete pages: <input type="checkbox" name="candelete" value="1"><br>
      <input type="submit" value="Add User">
      </p>
    </form>
    <form action="<?php if ($modpass) {echo "useraction.php";} else {echo htmlspecialchars($_SERVER["PHP_SELF"]);}?>" method="POST">
      <h3>Modify User Permissions</h3>
      <p>
        <?php if (!$modpass) {echo 'ID: <input type="text" name="password"><br><input type="hidden" name="modpass" value="true"><input type="submit" value="Continue"><!-- ';} ?>
        <input type="hidden" name="destination" value="control_panel.php">
        <input type="hidden" name="action" value="moduser">
        ID: <?php echo $passid; ?><br>
        <input type="hidden" name="id" value="<?php echo $passid; ?>">
        Can add pages: <input type="checkbox" name="canadd" value="1" <?php if ($modpass) {if ($db->querySingle("SELECT canadd FROM passwords WHERE id = " . $passid) == "1") {echo "checked";}}?>><br>
        Can edit pages: <input type="checkbox" name="canedit" value="1" <?php if ($modpass) {if ($db->querySingle("SELECT canedit FROM passwords WHERE id = " . $passid) == "1") {echo "checked";}}?>><br>
        Can delete pages: <input type="checkbox" name="candelete" value="1" <?php if ($modpass) {if ($db->querySingle("SELECT candelete FROM passwords WHERE id = " . $passid) == "1") {echo "checked";}}?>><br>
        <input type="submit" value="Edit User">
        <?php if (!$modpass) {echo "-->";} ?>
      </p>
    </form>
    <form action="useraction.php" method="POST">
      <h3>Delete User</h3>
      <input type="hidden" name="destination" value="<?php echo $_SERVER['REQUEST_URL']; ?>"/>
      <input type="hidden" name="action" value="deluser">
      <p>ID (see below): <input type="text" name="id"><br>
      <input type="submit" value="Delete User"></p>
    </form>
    <form action="useraction.php" method="POST">
      <h3>Change Password</h3>
      <input type="hidden" name="destination" value="<?php echo $_SERVER['REQUEST_URL']; ?>"/>
      <input type="hidden" name="action" value="changepass">
      <p>
        Old password: <input type="password" name="oldpass"><br>
        New password: <input type="password" name="newpass"><br>
        <input type="submit" value="Change Password"
      </p>
    </form>
    <div id="viewusers">
    <h3>View all users</h3>
    <p>
    <table>
      <tr><td width=50>ID</td><td width=150>Password</td><td>Can add</td><td>Can edit</td><td>Can delete</td></tr>
    <?php
    $query = $db->query("SELECT * FROM passwords");
    while ($entry = $query->fetchArray(SQLITE3_ASSOC)) {
      if ($entry['canadd'] == 1) {$canadd = " checked";}
      else {$canadd = "";}
      if ($entry['canedit'] == 1) {$canedit = " checked";}
      else {$canedit = "";}
      if ($entry['candelete'] == 1) {$candelete = " checked";}
      else {$candelete = "";}
      if ($entry['istim'] == 1) $password = "••••••••••"
      else $password = $entry['id'];
      echo '<tr><td>' . $entry['id'] . '</td><td>' . $password . '</td><td><input type="checkbox" disabled' . $canadd . '></td><td><input type="checkbox" disabled' . $canedit . '></td><td><input type="checkbox" disabled' . $candelete . '></td></tr>';
    }
    ?>
    </table>
    </p>
    </div>
    <?php if ($tim) {
      //echo "-->";
    } ?>
  </body>
</html>
