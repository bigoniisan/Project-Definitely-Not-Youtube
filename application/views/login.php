<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<h1>Login Page</h1>
<?php echo form_open('Login/submit'); ?>
<form>
	<div id="email-login-area">
		<label for="email">Email</label><br>
		<input type="text" name="username">
	</div>
	<div id="password-login-area">
		<label for="password">Password</label><br>
		<input type="password" name="password">
	</div>
	<br>
	<a href="http://localhost/infs3202/ResetPassword">Forgot Password?</a>
	<br>
	<input type="submit" name="login-submit" value="Log In">
</form>
