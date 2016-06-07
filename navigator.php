<html>
  <head>
<link rel="stylesheet" href="page.css" type="text/css">
</head>
<body>
<div class="navbar">
    <h3 class="navbar" align="center">
      <a class="navbar" href="index.php" target="_top">Home</a> | 
      <a class="navbar" href="view.php" target="_top">View</a> | 
      <a class="navbar" href="upload.php" target="_top">Upload</a> |
      <?php if (!isset($_COOKIE['userid'])) echo '<a class="navbar" href="login.php" target="_top">Login</a>'; else echo '<a class="navbar" href="login_handler.php?logout" target="_top">Logout</a>'; ?>
      <?php include_once "sql.inc"; if (isset($_COOKIE['tim'])) echo ' | <a href="control_panel.php" class="navbar" target="_top">Control Panel</a>'; ?>
      &nbsp;&nbsp;&nbsp;
      Search: <form action="view.php" method="GET" target="_top"><input type="search" name="search" placeholder="Search the Handbook..."><input type="submit" value="Search"></form></li>
    </h3>
    <h1><?php echo $_GET['header']; ?></h1>
</div>
</body>
</html>
