<?php
include "sql.inc"
//Get the function of the page
if ($_SERVER['QUERY_STRING'] == "" || !isset($_SERVER['QUERY_STRING'])) $pmode = 0; // show search page
else if (isset($_GET['search'])) $pmode = 1; // show search results
else $pmode = 2; // show entry
if ($_SERVER['QUERY_STRING'] == "init") {
  $db->exec("CREATE TABLE handbook (id INT PRIMARY KEY, name STRING, title STRING, author STRING, entry STRING, imageids STRING)");
  $db->exec('INSERT INTO handbook VALUES (NULL, "Sample Entry", "Sample Handbook Entry", "John Doe", "This is an example entry to test the Handbook out. This will be removed with the public release of the Handbook.", "1,2")');
}
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
      <p>Search: <input type="search" name="search" placeholder="Search the Handbook..."><input type="submit" value="Search"></p>
    </form>
    <?php if ($pmode != 0) echo '-->';
    if ($pmode != 1) echo '<!--'; ?>
    <h1>Search Results</h1>
    <ul>
      
    </ul>
  </body>
</html>
