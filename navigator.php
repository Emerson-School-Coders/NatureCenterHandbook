<style>
div.navbar {
  background-color: green;
  height: 40px;
  line-height: 40px;
}
h3.navbar, a.navbar {
  color: #66ff99;
  font-family: "Lucida Grande";
  text-decoration: none;
}
</style>
<div class="navbar">
<h3 class="navbar" align="center"><a class="navbar" href="index.html">Home</a> | 
<a class="navbar" href="upload.php">Upload</a> | <?php if (!isset($_COOKIE['userid'])) echo '<a class="navbar" href="login.php">Login</a>'; 
else echo '<a class="navbar" href="login_handler.php?logout">Logout</a> | Logged in as: ID ' . $_COOKIE['userid'] . ''; ?>
<?php include_once "sql.inc"; if (isset($_COOKIE['tim'])) echo ' | <a href="control_panel.php" class="navbar">Control Panel</a>'; ?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<form action="view.php" method="GET">Search: <input type="search" name="search"> <input type="submit" value="Search"></form></h3>
</div>
