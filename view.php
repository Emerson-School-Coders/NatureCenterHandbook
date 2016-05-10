<?php
//Get the function of the page
if ($_SERVER['QUERY_STRING'] == "")     $pmode = 0; // show search page
if (isset($_GET['search']))             $pmode = 1; // show search results
else                                    $pmode = 2; // show entry
?>
<html>
  <head>
    <script>var pmode = <?php echo $pmode; ?></script>
    <script>
      document.write("<title>The Emerson Nature Center Official Handbook | ");
      if (pmode == 0) document.write("Search the Handbook");
      else if (pmode == 1) document.write("Search Results");
      else document.write("<?php echo $db->querySingle("SELECT name FROM handbook WHERE id=" . $_GET['id']); ?>");
      document.write("</title>");
    </script>
    <link rel="stylesheet" href="page.css" type="text/css">
  </head>
  <body>
    <iframe src="navigator.php"></iframe>
    <?php if ($pmode != 0) {
      echo '<!--';
    }
    ?>
    <h1>Search the Nature Center Handbook</h1>
    <form action="view.php" method="GET">
      <p>Search: </p><input type="search" name="search" placeholder="Search the Handbook..."><input type="submit" value="Search">
    </form>
    <?php if ($pmode != 0) {
      echo '-->';
    }
    ?>
  </body>
</html>
