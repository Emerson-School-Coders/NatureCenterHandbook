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
<h3 class="navbar" align="center"><a class="navbar" href="index.html">Home</a> | <a class="navbar" href="upload.php">Upload</a> | <a class="navbar" href="login.html">Login</a><?php include("sql.inc"); if ($db->querySingle("SELECT istim FROM passwords WHERE id=".$_COOKIE['userid'])); ?></h3>
</div>
