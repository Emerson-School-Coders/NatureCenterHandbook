<?php
include "sql.inc";
if (!isset($_GET['id'])) die("Please enter an ID to edit.");
$page = $db->querySingle("SELECT title, author, entry, imageids FROM handbook WHERE id=".$_GET['id'], true);
?>
<html>
  <head>
    <title>The Emerson Nature Center Official Handbook - Edit Page</title>
    <link rel="stylesheet" href="page.css" type="text/css">
  </head>
  <body>
    <iframe src="navigator.php"></iframe>
    <h1>Edit Page</h1>
    <?php if (!isset($_COOKIE['userid'])) echo "<p>You have to log in to the Handbook to edit pages.</p><!--";
    else if (!$db->querySingle("SELECT canedit FROM passwords WHERE id=".$_COOKIE['userid'])) echo "<p>Sorry, you are not allowed to edit this page. Please ask Tim for permission.</p><!--"; ?>
    <center>
    <form action="upload_page.php" method="POST">
      <h2>Title: <input type="text" name="title" value="<?php echo $page['title']; ?>" placeholder="Title" style="font-size: 18pt;" required></h2>
      <h3>Author: <?php echo $page['author']; ?>, edited by <?php echo $db->querySingle("SELECT name FROM passwords WHERE id=".$_COOKIE['userid']); ?><br>
      <textarea id="styled" width=300 height=300 placeholder="Enter your entry here." name="entry" required><?php echo $page['entry']; ?></textarea>
      Change images here:
      </h3>
      Image 1: <img src="<?php echo 'images/id-'.substr($page['imageids'], 0, 1).'.png'; ?>" height=100> Change: <input type="file" name="image1" accept=".png, image/png">
      <?php if (explode(",", $page["imageids"])[1] != "-1" && explode(",", $page["imageids"])[1] != "")
              echo '<br>Image 2: <img src="images/id-'.substr($page['imageids'], 2, 1).'.png" height=100> Change: <input type="file" name="image2" accept=".png, image/png">'; ?>
      <br><input type="submit" value="Submit">
    </form>
    </center>
  </body>
</html>
