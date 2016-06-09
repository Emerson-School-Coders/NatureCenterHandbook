<?php
include "sql.inc";
if (!isset($_GET['id'])) die("Please enter an ID to edit.");
$page = $db->querySingle("SELECT title, author, entry, imageids FROM handbook WHERE id=".$_GET['id'], true);
$hidden = false;
?>
<html>
  <head>
    <title>The Emerson Nature Center Official Handbook - Edit Page</title>
    <link rel="stylesheet" href="page.css" type="text/css">
  </head>
  <body>
    <iframe src="navigator.php?header=Edit%20Page"></iframe>
    <!--<h1>Edit Page</h1>-->
    <?php if (!isset($_COOKIE['userid'])) {$hidden = true; echo "<p>You have to log in to the Handbook to edit pages.</p><!--";}
    else if (!$db->querySingle("SELECT canedit FROM passwords WHERE id=".$_COOKIE['userid'])) {$hidden = true; echo "<p>Sorry, you are not allowed to edit this page. Please ask Tim for permission.</p><!--";} ?>
    <center>
    <form action="edit_page.php" method="POST">
      <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
      <input type="hidden" name="author" value="<?php echo $page['author']; ?>">
      <h2>Title: <input type="text" name="title" value="<?php echo $page['title']; ?>" placeholder="Title" style="font-size: 18pt;" required></h2>
      <h3>Author: <?php echo $page['author']; ?>, edited by <?php echo $db->querySingle("SELECT name FROM passwords WHERE id=".$_COOKIE['userid']); ?><br>
      <textarea id="styled" width=300 height=300 placeholder="Enter your entry here." name="entry" required><?php echo $page['entry']; ?></textarea>
      <br>Change images here:
      </h3>
      Image 1: <img src="<?php echo 'images/id-'.substr($page['imageids'], 0, 1); ?>" height=100> Change: <input type="file" name="image1" accept=".png, image/png, .jpg, image/jpg, .gif, image/gif">
      <?php if (explode(",", $page["imageids"])[1] != "-1" && explode(",", $page["imageids"])[1] != "")
              echo '<br>Image 2: <img src="images/id-'.substr($page['imageids'], 2, 1).'" height=100> Change: <input type="file" name="image2" accept=".png, image/png, .jpg, image/jpg, .gif, image/gif">'; ?>
      <br><input type="submit" value="Submit">
    </form>
    <?php if (!$db->querySingle("SELECT candelete FROM passwords WHERE id=".$_COOKIE['userid'])) {$hidden = true; echo "<!--";} ?>
    <form action="edit_page.php" method="GET" onSubmit="return confirm('Are you sure you want to delete this?');">
      <h3>Delete this page</h3>
      <p style="color: red;">WARNING: The only way to recover this entry is to ask Tim to restore it. It is otherwise unrecoverable.</p>
      <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
      <input type="hidden" name="delete" value="yes">
      <input type="submit" value="Remove" style="color: red">
    </form>
    </center>
    <?php if ($hidden) echo "-->"; ?>
  </body>
</html>
