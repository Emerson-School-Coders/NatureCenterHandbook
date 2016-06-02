<?php
setcookie($_POST['cookie_name'], $_POST['cookie_value'], time() + 3600);
?>
<html>
<body>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
<input type="text" name="cookie_name"> = <input type="text" name="cookie_value">
<input type="submit" value="submit">
</form>
</body>
</html>
