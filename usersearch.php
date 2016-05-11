<?php
include "sql.inc";
if (isset($_GET["search"])) $results = true;
else $results = false;
if ($results) {
  $user = $db->querySingle('SELECT id FROM passwords WHERE name="' . $_GET['search'].'"');
  if ($user) {
    header("Location: profile.php?id=" . $user);
  }
}
?>
<html>
  <head>
    <title>The Emerson Nature Center Official Handbook - Search for User</title>
    <link rel="stylesheet" href="page.css" type="text/css">
  </head>
  <body>
    <iframe src="navigator.php"></iframe>
    <?php if ($results) echo "<!--"; ?>
    <h1>Search for User</h1>
    <form action="usersearch.php" method="GET">Search for User: <input type="search" name="search" placeholder="Search for User"><input type="submit" value="Search"></form>
    <?php if ($results) echo "-->"; else echo "<!--"; ?>
    <h1>Search Results</h1>
    <?php
    if ($results) {
      $user = $db->querySingle('SELECT id FROM passwords WHERE name="' . $_GET['search'].'"');
      if (!$user) {
        $user = $db->query('SELECT id FROM passwords WHERE name LIKE "' . $_GET['search'].'"');
        if (!$user) echo "<p>No results.</p>";
        else {
          echo "<ul>";
          $qwery = $user->fetchArray(SQLITE3_NUM);
          while ($qwery) {
            echo '<li><a href="profile.php?id=' . $qwery[0] .'">' . $db->querySingle("SELECT name FROM passwords WHERE id=".$qwery[0]) . '</a>';
            $qwery = $user->fetchArray(SQLITE3_NUM);
          }
        }
      }
    }
    ?>
  </body>
</html>
