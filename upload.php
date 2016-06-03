<?php include "sql.inc"; ?>
<html>
	<head>
		<title>The Emerson Nature Center Official Handbook | Upload</title>
		<link rel="stylesheet" href="page.css" type="text/css">
		<iframe src="navigator.php"></iframe>
	</head>
	<body>
		<h1>Upload an entry to the Handbook!</h1>
		<center>
			<?php if (!isset($_COOKIE['userid'])) echo '<p>Sorry, uploading is only available to registered accounts. Please ask Tim for an account with uploading permissions.</p><img src="http://www.iconarchive.com/download/i88574/icons8/ios7/Messaging-Sad.ico"/><!--';
			
			else if (!$canadd = $db->querySingle("SELECT canadd FROM passwords WHERE id=".$_COOKIE['userid'])) echo "<p>Sorry, you are not allowed to upload new entries. Please ask Tim for permission to add pages.</p><!--";?>
			<form action="upload_page.php" method="POST" enctype="multipart/form-data">
				<h2>Title: <input type="text" name="title" placeholder="Title" style="font-size: 18pt;" required></h1>
				<input type="hidden" name="author" value="<?php if ($canadd) echo $db->querySingle("SELECT name FROM passwords WHERE id=".$_COOKIE['userid']); ?>">
				<h3 style="entry">Author: <?php if ($canadd) echo $db->querySingle("SELECT name FROM passwords WHERE id=".$_COOKIE['userid']); ?>
				<textarea id="styled" width="300" height="300" placeholder="text" name="entry" required></textarea>
				<br>
				<h3>Insert images here: </h3>
				Image 1 (required): <input type="file" name="image1" accept=".png, image/png" required><br>
				Image 2 (optional): <input type="file" name="image2" accept=".png, image/png"><br>
				<input type="submit" value="submit">
			</form>
			<br>
		</center>
<?php include 'cp.php'; ?>
	</body>
</html>
