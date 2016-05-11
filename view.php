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
    </script>
    <link rel="stylesheet" href="page.css" type="text/css">
  </head>
  <body>
    <iframe src="navigator.php"></iframe>
    <?php if ($pmode != 0) echo '<!--'; ?>
    <h1>Search the Nature Center Handbook</h1>
    <form action="view.php" method="GET">
      <p>WARNING: You may only use uppercase or lowercase letters in the search, or you will be accused of hacking.<br>Search: <input type="search" name="search" placeholder="Search the Handbook..."><input type="submit" value="Search"></p>
    </form>
    <?php if ($pmode != 0) echo '-->';
    if ($pmode != 1) echo '<!--'; ?>
    <h1>Search Results</h1>
    <ul><p>
      <?php
      if ($pmode == 1) {
        if (!preg_match("/[A-Z | a-z]+/", $_GET['search'])) {
          echo "YOU MAY NOT USE SQL INJECTION!!!!!! THIS INCIDENT WILL BE REPORTED!!!!!";
          $file = fopen("incidents.txt", "w");
          fwrite($file, "Incident at " . date("m-d-y H:i:s", time()) . " EST: SQL Injection Attempt from IP " . $_SERVER['REMOTE_ADDR'] . ", string: " . $_GET['search']);
          fclose($file);
        } else {
          $search = $_GET['search'];
        $query = 'SELECT id FROM handbook WHERE title LIKE "%'.strval($search).'%"OR entry LIKE "%'.strval($search).'%"';
        $results = $db->querySingle($query, true);
        print_r($results);
        echo($query);
        $errors = array_filter($results);
        if (empty($errors)) echo "No results.";
        else foreach ($results as $result) echo '<li><a href="view.php?id='.$result.'">' . $db->querySingle("SELECT title FROM handbook WHERE id=" . strval($result)) . '</a></li>';
        }
      }
      ?>
      </p>
    </ul>
  </body>
</html>
