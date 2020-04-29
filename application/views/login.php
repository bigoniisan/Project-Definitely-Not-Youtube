<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<h1>Login Page</h1>
<?php echo form_open('welcome/login_validation'); ?>
<form>
	<div id="email-area">
		<label for="email-username">Email</label><br>
		<input type="text" name="email" maxlength="20" required>
		<span class="text-danger"><?php echo form_error('email'); ?></span>
	</div>
<!--	<div id="username-area">-->
<!--		<label for="username">Username</label><br>-->
<!--		<input type="text" name="username" minlength="4" maxlength="12" required>-->
<!--		<span class="text-danger">--><?php //echo form_error('username'); ?><!--</span>-->
<!--	</div>-->
	<div id="password-area">
		<label for="password">Password</label><br>
		<input type="password" name="password" minlength="4" maxlength="12" required>
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
