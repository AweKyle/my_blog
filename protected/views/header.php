<?php
header("Content-Type:text/html; Charset=utf-8");
?>
<!DOCTYPE html>
<html>
<head>
	<title>My Awesome blog</title>
	<header>Look at my blog! My blog is amazing</header>
	<script type="text/javascript" src="includes/jquery-2.0.2.min.js"></script>
	<script type="text/javascript" src="protected/scripts/functions.js"></script>
	<script type="text/javascript" src="protected/scripts/navigation.js"></script>
</head>
<body>
	<?php 
	if (User::userId() !== false) {
		echo User::userId();
	}
	?>
	<li>
		<a href="protected/views/auth_form.php">authorization</a>
	</li>

<ul id="navig">
	<li>
		<a href="protected/views/news.php">news</a>
	</li>
	<li>
		<a href="protected/views/my.php">my</a>
	</li>
	<li>
		<a href="protected/views/archive.php">archive</a>
	</li>
	<li>
		<a href="protected/views/properties.php">properties</a>
	</li>
</ul>