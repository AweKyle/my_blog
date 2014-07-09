<!DOCTYPE html>
<html>
<head>
	<title>Registration</title>
	<script type="text/javascript" src="includes/jquery-2.0.2.min.js"></script>
	<script type="text/javascript" src="protected/scripts/functions.js"></script>
</head>
<body>
<div id="">
	<form method="POST" action="SiteController.php" id="registration_form">
		<input type="text" name="login" value="" placeholder="login" />
		<br />
		<input type="password" name="pass" value="" placeholder="password" />
		<br />
		<input type="password" name="pass_confirm" value="" placeholder="password" />
		<br />
		<input type="text" name="email" value="" placeholder="email" />
		<br />
		<input type="hidden" name="registration" value="reg" />
		<input type="button" value="reg" 
			onclick="AjaxFormRequest('result_div_id', 'registration_form', 'protected/controllers/SiteController.php', 'POST')" />
	</form>
</div>