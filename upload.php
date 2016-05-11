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
			<form action="upload_page.php" method="POST">
				<h2>Title: <input type="text" name="title" placeholder="Title" style="font-size: 24pt;" required></h1>
				<h3 style="entry">Author: <?php echo $db->querySingle("SELECT name FROM passwords WHERE id=".$_COOKIE['userid']); ?>
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
