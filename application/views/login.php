<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Login</title>
</head>
<body>
	<nav>
		<a href="../controllers/Welcome.php">
			<img src="../../images/homepage-icon.png" alt="Homepage">
		</a>
	</nav>

	<?php echo form_open('Login/login'); ?>
	<form>
		<div id="email-login-area">
			<label for="email">Email</label><br>
			<input type="text" name="email">
		</div>
		<div id="password-login-area">
			<label for="password">Password</label><br>
			<input type="password" name="password">
		</div>
		<br>
		<a href="reset_password.php">Forgot Password?</a>
		<br>
		<input type="submit" name="login-submit" value="Log In">
	</form>
</body>
</html>
