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
