<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<h1>Login Page</h1>
<?php echo form_open('welcome/login_validation'); ?>
<form>
	<div id="username-login-area">
		<label for="username">Username</label><br>
		<input type="text" name="username">
		<span class="text-danger"><?php echo form_error('username'); ?></span>
	</div>
	<div id="password-login-area">
		<label for="password">Password</label><br>
		<input type="password" name="password">
		<span class="text-danger"><?php echo form_error('password'); ?></span>
	</div>
	<br>
	<a href="http://localhost/infs3202/welcome/reset_password">Forgot Password?</a>
	<br>
	<div class="form-group">
		<input type="submit" name="login-submit" value="Log In">
		<?php
		echo $this->session->flashdata("error");
		?>
	</div>
</form>
