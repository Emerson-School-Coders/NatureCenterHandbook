<?php
date_default_timezone_set("America/Detroit");
include "sql.inc";
//Get the function of the page
if ($_SERVER['QUERY_STRING'] == "" || !isset($_SERVER['QUERY_STRING'])) $pmode = 0; // show search page
else if (isset($_GET['search'])) $pmode = 1; // show search results
else $pmode = 2; // show entry
?>
<html>
  <head>
    <script>var pmode = <?php echo $pmode; ?></script>
    <script>
      document.write("<title>The Emerson Nature Center Official Handbook | ");
      if (pmode == 0) document.write("Search the Handbook");
      else if (pmode == 1) document.write("Search Results");
      else document.write("<?php if ($pmode == 2) echo $db->querySingle("SELECT name FROM handbook WHERE id=" . $_GET['id']); ?>");
      document.write("</title>");
      console.log(pmode)
    </script>
    <link rel="stylesheet" href="page.css" type="text/css">
  </head>
  <body>
    <?php if ($pmode != 0) echo '<!--'; ?>
    <iframe src="navigator.php?header=Search%20the%20Handbook"></iframe>
    <form action="view.php" method="GET">
      <p>WARNING: You may only use uppercase or lowercase letters in the search, or you will be accused of hacking.<br>
      Search: <input type="search" name="search" placeholder="Search the Handbook..."><input type="submit" value="Search"></p>
    <ul>
    <?php
$search = " ";
$query = 'SELECT id FROM handbook WHERE title LIKE "%'.$search.'%"OR entry LIKE "%'.$search.'%"';
$results = $db->query($query);
$result = $results->fetchArray(SQLITE3_NUM);
while ($result) {echo '<li><a href="view.php?id='.$result[0].'">' . $db->querySingle("SELECT title FROM handbook WHERE id=" . $result[0]) . '</a></li>'; $result = $results->fetchArray(SQLITE3_NUM);}
    ?>
    </ul>
    </form>
    <p><a href="usersearch.php">Want to find another user? Click here for user search.</a></p>
    <?php if ($pmode != 0) echo '-->';
    if ($pmode != 1) echo '<!--'; ?>
    <iframe src="navigator.php?header=Search%20Results"></iframe>
    <ul>
      <?php
      if ($pmode == 1) {
        error_log("Trying...");
        if (!preg_match("/[A-Z | a-z]+/", $_GET['search'])) {
          error_log("Busted!");
          echo '<p>YOU MAY NOT USE SQL INJECTION!!!!!! THIS INCIDENT WILL BE REPORTED!!!!!</p><img src="https://i.ytimg.com/vi/g69yxajAYNE/maxresdefault.jpg" height=500 />';
          $file = fopen("incidents.txt", "w");
          fwrite($file, "Incident at " . date("m-d-y H:i:s", time()) . " EST: SQL Injection Attempt from IP " . $_SERVER['REMOTE_ADDR'] . ", string: " . $_GET['search']);
          fclose($file);
        } else {
          $search = $_GET['search'];
          $query = 'SELECT id FROM handbook WHERE title LIKE "%'.$search.'%"OR entry LIKE "%'.$search.'%"';
          error_log($query);
          $results = $db->query($query);
          $result = $results->fetchArray(SQLITE3_NUM);
          if (!$result) echo "No results.";
          else {
            while ($result) {echo '<li><a href="view.php?id='.$result[0].'">' . $db->querySingle("SELECT title FROM handbook WHERE id=" . $result[0]) . '</a></li>'; $result = $results->fetchArray(SQLITE3_NUM);}
          }
        }
      }
      ?>
    </ul>
    <?php if ($pmode != 1) echo '-->';
    if ($pmode != 2) echo '<!--'; ?>
    <iframe src="navigator.php?header=<?php if ($pmode == 2) echo $db->querySingle("SELECT title FROM handbook WHERE id=" . $_GET["id"]) ?>"></iframe>
    <h3 class="entry">Written by <?php if ($pmode == 2) echo $db->querySingle("SELECT author FROM handbook WHERE id=" . $_GET["id"]) ?></h3>
    <div id="images">
    <?php if ($pmode == 2) {
      $picss = $db->querySingle("SELECT imageids FROM handbook WHERE id=".$_GET["id"]);
      $pics = explode(",", $picss); 
      foreach ($pics as $picid) {
      if ($picid != "-1" && $picid != "") echo '<img class="entry" src="images/id-' . $picid . '" width="100">';
      }
      echo "<br>";
    } ?>
    </div>
    <p class="entry"><?php if ($pmode == 2) echo $db->querySingle("SELECT entry FROM handbook WHERE id=" . $_GET["id"]) ?></p>
    <p style="text-align: center; font-size: 8pt;"><a href="edit.php?id=<?php echo $_GET['id']; ?>">Edit this page</a></p>
    <?php include 'cp.php'; ?>
  </body>
</html>
