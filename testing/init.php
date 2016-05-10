<?php
class MyDB extends SQLite3 {
  function __construct() {
    $this->open('../database.db');
  }
}
$db = new MyDB();
if (isset($_GET['action']) || $_GET['action'] == "") {
  if ($_GET['action'] == "passwords") {
    $db->exec('DROP TABLE passwords');
    $db->exec('CREATE TABLE passwords (id INTEGER PRIMARY KEY, password STRING, canadd BOOLEAN, canedit BOOLEAN, candelete BOOLEAN, istim BOOLEAN, entyear INTEGER, entgrade INTEGER)');
    $db->exec('INSERT INTO passwords (id, password, canadd, canedit, candelete, istim) VALUES (NULL, "thisistimw", 1, 1, 1, 1)');
  }
  else if ($_GET['action'] == "handbook") {
    $db->exec("DROP TABLE handbook");
    $db->exec("CREATE TABLE handbook (id INTEGER PRIMARY KEY, name STRING, title STRING, author STRING, entry STRING, imageids STRING)");
    $db->exec('INSERT INTO handbook VALUES (NULL, "SampleEntry", "Sample Handbook Entry", "John Doe", "This is an example entry to test the Handbook out. This will be removed with the public release of the Handbook.", "1,2")');
    $db->exec('INSERT INTO handbook VALUES (NULL, "SampleEntry2", "Sample Handbook Entry #2", "John Doe", "This is another example entry to test the Handbooks multiple choice selection out. This will be removed with the public release of the Handbook.", "3,4")');
  }
}
?>
<html>
  <body>
    <?php if (isset($_GET['action']) || $_GET['action'] == "") {
      if ($_GET['action'] == "passwords") echo "Passwords initialized.";
      if ($_GET['action'] == "handbook") echo "Handbook initialized.";
    }
    ?>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="GET"><input type="hidden" name="action" value="passwords"><input type="submit" value="Initialize Passwords"></form>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="GET"><input type="hidden" name="action" value="handbook"><input type="submit" value="Initialize Handbook"></form>
  </body>
</html>
