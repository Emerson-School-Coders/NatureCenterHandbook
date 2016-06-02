<?php
$_COOKIE[$_POST['cookie_name']] = $_POST['cookie_value'];
?>
<html>
<body>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
<input type="text" name="cookie_name"> = <input type="text" name="cookie_value">
</form>
</body>
</html>
