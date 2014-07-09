<!DOCTYPE html>
<html>
<head>
	<title>Authorization</title>
	<script type="text/javascript" src="includes/jquery-2.0.2.min.js"></script>
	<script type="text/javascript" src="protected/scripts/functions.js"></script>
</head>
<body>
<div id="">
	<form method="POST" action="../controllers/SiteController.php" id="authorization_form">
		<input type="text" name="login" value="" placeholder="auth_login" />
		<br />
		<input type="password" name="pass" value="" placeholder="auth_password" />
		<br />
		<input type="hidden" name="authorize" value="authorize" />
		<input type="submit" name="auth" value="authorize" />
	</form>
</div>