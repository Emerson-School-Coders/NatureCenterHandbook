<?php
include_once("sql.inc");
if (isset($_POST["modpass"]) && !empty($_POST["modpass"]) && !is_null($_POST["modpass"]) && isset($_POST["password"]) && !empty($_POST["password"]) && !is_null($_POST["password"])) {
if ($db->querySingle("SELECT istim FROM passwords WHERE id=".SQLite3::escapeString($_POST['password'])) == 1) die("You cannot edit Tim's permissions!");
$passid = $_POST["password"];
$modpass = true;
}
else {$modpass = false;}
if (isset($_COOKIE['tim'])) {$tim = true;}
else {header($_SERVER["SERVER_PROTOCOL"] . " 403 Forbidden", true, 403); header("Location: 403.html");}
?>
<html>
  <head>
    <title>Emerson School Nature Center Handbook - Tim's Control Panel</title>
    <link rel="stylesheet" href="page.css" type="text/css">
  </head>
  <body>
    <?php if ($tim) print("Is tim"); else print("Is not tim"); ?>
    <iframe src="navigator.php?header=User%20Control%20Panel%20-%20Tim%20only%21"></iframe>
    <form action="useraction.php" method="POST">
      <h3>Add New User</h3>
      <input type="hidden" name="action" value="adduser">
      <input type="hidden" name="destination" value="<?php echo $_SERVER['REQUEST_URL']; ?>"/>
      <p>
      New password: <input type="text" name="password"><br>
      Profile name: <input type="text" name="name"><br>
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
        Can add pages: <input type="checkbox" name="canadd" value="1" <?php if ($modpass) {if ($db->querySingle("SELECT canadd FROM passwords WHERE id=" . SQLite3::escapeString($passid)) == "1") {echo "checked";}}?>><br>
        Can edit pages: <input type="checkbox" name="canedit" value="1" <?php if ($modpass) {if ($db->querySingle("SELECT canedit FROM passwords WHERE id=" . SQLite3::escapeString($passid)) == "1") {echo "checked";}}?>><br>
        Can delete pages: <input type="checkbox" name="candelete" value="1" <?php if ($modpass) {if ($db->querySingle("SELECT candelete FROM passwords WHERE id=" . SQLite3::escapeString($passid)) == "1") {echo "checked";}}?>><br>
        <input type="submit" value="Edit User">
        <?php if (!$modpass && $tim) {echo "-->";} ?>
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
      <tr><td width=50>ID</td><td width=125>Name</td><td width=150>Password</td><td>Can add</td><td>Can edit</td><td>Can delete</td></tr>
    <?php
    $query = $db->query("SELECT * FROM passwords");
    while ($entry = $query->fetchArray(SQLITE3_ASSOC)) {
      if ($entry['canadd'] == 1) {$canadd = " checked";}
      else {$canadd = "";}
      if ($entry['canedit'] == 1) {$canedit = " checked";}
      else {$canedit = "";}
      if ($entry['candelete'] == 1) {$candelete = " checked";}
      else {$candelete = "";}
      if ($entry['istim'] == 1) $password = "Tim: &middot;&middot;&middot;&middot;&middot;&middot;&middot;&middot;&middot;&middot;";
      else $password = $entry['password'];
      echo '<tr><td>' . $entry['id'] . '</td><td>' . $entry['name'] . '</td><td>' . $password . '</td><td><input type="checkbox" disabled' . $canadd . '></td><td><input type="checkbox" disabled' . $canedit . '></td><td><input type="checkbox" disabled' . $candelete . '></td></tr>';
    }
    ?>
    </table>
    </p>
    </div>
    <div id="viewdeletions">
      <h3>View deleted entries</h3>
      <table>
        <tr><td width=250px>Title</td><td width=150px>Author</td><td width=150px>Removed by</td><td width=200px>Removed on</td><td width=75px>Restore</td><td width=75px>Remove</td></tr>
        <?php
        $deletions = $db->query("SELECT * FROM deleted");
        while ($delete = $deletions->fetchArray(SQLITE3_ASSOC)) {
          echo '<tr><td>'.$delete['title'].'</td><td>'.$delete['author'].'</td><td>'.$db->querySingle("SELECT name FROM passwords WHERE id=".$delete['removedby']).'</td><td>'.date('Y-m-d', $delete['removaldate']).'</td><td><form action="restore.php" method="POST"><input type="hidden" name="id" value="'.$page['id'].'"><input type="submit" value="Restore"></td><td><form action="delete.php" method="POST" onSubmit="confirm(\'Are you sure you want to delete this forever? It cannot be recovered!\');"><input type="hidden" name="id" value="'.$page['id'].'"><input type="submit" value="Remove" style="color: red"></td></tr>';
        }
        ?>
      </table>
    </div>
<?php include 'cp.php'; ?>
  </body>
</html>
