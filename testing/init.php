<?php

if (isset($_GET['action']) || $_GET['action'] == "") {
  if ($_GET['action'] == "passwords") {
    
  }
  else if ($_GET['action'] == "handbook") {
    $db->exec("DROP TABLE handbook");
    $db->exec("CREATE TABLE handbook (id INT PRIMARY KEY, name STRING, title STRING, author STRING, entry STRING, imageids STRING)");
    $db->exec('INSERT INTO handbook VALUES (NULL, "SampleEntry", "Sample Handbook Entry", "John Doe", "This is an example entry to test the Handbook out. This will be removed with the public release of the Handbook.", "1,2")');
    $db->exec('INSERT INTO handbook VALUES (NULL, "SampleEntry2", "Sample Handbook Entry #2", "John Doe", "This is another example entry to test the Handbooks multiple choice selection out. This will be removed with the public release of the Handbook.", "3,4")');
  }
}
?>
<html>
  <body>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="GET"><input type="hidden" name="action" value="passwords"><input type="sunmit" value="Initialize Passwords"></form>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="GET"><input type="hidden" name="action" value="handbook"><input type="sunmit" value="Initialize Handbook"></form>
  </body>
</html>
