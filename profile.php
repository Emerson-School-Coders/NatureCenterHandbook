<?php include "sql.inc"; ?>
<html>
  <head>
    <title>The Emerson Nature Center Official Handbook - View Profile</title>
    <link rel="stylesheet" href="page.css" type="text/css">
  </head>
  <body>
    <iframe src="navigator.php?header=<?php $name =  $db->querySingle("SELECT name FROM passwords WHERE id=".$_GET['id']); echo htmlspecialchars($name); ?>"></iframe>
    <h3>Entries in the Handbook</h3>
    <ul>
      <?php
      $posts = $db->query('SELECT title FROM handbook WHERE author="'.$name.'"');
      $post = $posts->fetchArray();
      if (!$post) {
        echo "<li>No entries.</li>";
      } else {
        while ($post) {
          echo '<li><a href="view.php?id='.$db->querySingle('SELECT id FROM handbook WHERE title="'.$post[0].'"').'">'.$post[0].'</a></li>';
          $post = $posts->fetchArray();
        }
      }
      ?>
    </ul>
<?php include 'cp.php'; ?>
  </body>
</html>
