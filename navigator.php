<html>
  <head>
<style>
div.navbar {
  background-color: green;
  height: 40px;
  line-height: 40px;
  display: inline-block;
}
h3.navbar, a.navbar {
  color: #66ff99;
  font-family: "Lucida Grande";
  text-decoration: none;
  display: inline-block;
}
</style>
<link rel="stylesheet" href="page.css" type="text/css">
</head>
<body>
<div class="navbar">
  
    <h3 class="navbar" align="center">
      <a class="navbar" href="index.html">Home</a> | 
      <a class="navbar" href="upload.php">Upload</a> | 
      <?php if (!isset($_COOKIE['userid'])) echo '<a class="navbar" href="login.php">Login</a>'; else echo '<a class="navbar" href="login_handler.php?logout">Logout</a> | Logged in as: ID ' . $_COOKIE['userid'] . ''; ?>
      <?php include_once "sql.inc"; if (isset($_COOKIE['tim'])) echo ' | <a href="control_panel.php" class="navbar">Control Panel</a>'; ?>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <form action="view.php" method="GET"><h3 class="navbar">Search: <input type="search" name="search"></h3><input type="submit" value="Search"></form></li>
    </h3>
  
</div>
</body>
</html>
