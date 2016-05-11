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
<br>
<center>
<form onSubmit="var text = document.forms[0].elements[0].value; text = text.replace(/\r?\n/g, '<br />'); document.write('This will be reviewed: ' + text)">
<textarea id="styled" width="300" height="300" placeholder="text"></textarea>
<br>
<input type="submit" value="submit">
</form>
<br>
<form onSubmit="document.write('Image Uploaded!')">
Image 1 <input type="file">
<br>
Insert image with [img 1] <input type="submit" value="submit">
</form>
</center>
</body>
</html>
