<?php include "sql.inc"; ?>
<html>
	<head>
		<title>The Emerson Nature Center Official Handbook | Upload</title>
		<link rel="stylesheet" href="page.css" type="text/css">
		<iframe src="navigator.php"></iframe>
		<style>
			textarea#styled {
				width: 600px;
				height: 120px;
				border: 3px solid #cccccc;
				padding: 5px;
			}
		</style>
	</head>
	<body>
		<h1>Upload an entry to the Handbook!</h1>
		<center>
			<?php if (!isset($_COOKIE['userid'])) echo 'Sorry, uploading is only available to registered accounts. Please ask Tim for an account with uploading permissions.<!--';
			else if (!$canadd = $db->querySingle("SELECT canadd FROM passwords WHERE id=".$_COOKIE['userid'])) echo "Sorry, you are not allowed to upload new entries. Please ask Tim for permission to add pages.<!--";?>
			<form action="upload_page.php" method="POST">
				<h2>Title: <input type="text" name="title" placeholder="Title" style="font-size: 18pt;" required></h1>
				<h3 style="entry">Author: <?php if ($canadd) echo $db->querySingle("SELECT name FROM passwords WHERE id=".$_COOKIE['userid']); ?>
				<textarea id="styled" width="300" height="300" placeholder="text" required></textarea>
				<br>
				<h3>Insert images here: </h3>
				Image 1 (required): <input type="file" name="img1" required><br>
				Image 2 (optional): <input type="file" name="img2" required><br>
				<input type="submit" value="submit">
			</form>
			<br>
		</center>
	</body>
</html>
