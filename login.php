<html>
<head>
  <title>The Emerson School Nature Center Official Handbook - Login</title>
  <link rel="stylesheet" href="page.css" type="text/css">
</head>
<body>
  <iframe src="navigator.php"></iframe>
  <h1>Login to the Handbook</h1>
  <p align="center">Login to be able to add to and edit the Nature Center Handbook.</p>
  <form action="login_handler.php" method="POST">
    <p>Password: <input type="password" name="password"></p>
    <script>if (location.href != "http://emerson-school-coders.github.io/NatureCenterHandbook/login.html") document.write('<input type="submit" value="Login" style="margin-left: 12px">'); else document.write("<p>GitHub does not support log in pages.</p>");</script>
  </form>
<?php include 'cp.php'; ?>
</body>
</html>
