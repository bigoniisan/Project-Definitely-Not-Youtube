<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<h1>Signup Page</h1>
<?php echo form_open('welcome/signup_validation'); ?>
<form>
	<div id="email-area">
		<label for="email">Email</label><br>
		<input type="email" name="email" required>
		<?php echo $error; ?>
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
		<?php echo $error; ?>
		<span class="text-danger"><?php echo form_error('password'); ?></span>
	</div>
	<div id="name-area">
		<label for="name">First Name</label><br>
		<input type="text" name="name" maxlength="20" required>
		<?php echo $error; ?>
		<span class="text-danger"><?php echo form_error('name'); ?></span>
	</div>
<!--	<div id="last-name-area">-->
<!--		<label for="last-name">Last Name</label><br>-->
<!--		<input type="text" name="last-name" maxlength="20" required>-->
<!--		<span class="text-danger">--><?php //echo form_error('last-name'); ?><!--</span>-->
<!--	</div>-->
	<div id="birthday-area">
		<label for="birthday">Birthday</label><br>
		<input type="date" name="birthday">
		<?php echo $error; ?>
		<span class="text-danger"><?php echo form_error('birthday'); ?></span>
	</div>
<!--	<div id="gender-area">-->
<!--		<input type="radio" id="female" name="gender" value="female">-->
<!--		<label for="female">Female</label>-->
<!--		<input type="radio" id="male" name="gender" value="male">-->
<!--		<label for="female">Male</label>-->
<!--		<input type="radio" id="other" name="gender" value="other">-->
<!--		<label for="female">Other</label>-->
<!--	</div>-->
<!--	<div id="send-emails-area">-->
<!--		<input type="checkbox" name="send-emails">-->
<!--		<label for="send-emails">  Send me emails on updates</label><br>-->
<!--	</div>-->
	<div class="form-group">
		<input type="submit" name="signup-submit" value="Sign Up">
		<?php echo $error; ?>
		<?php echo $this->session->flashdata("error"); ?>
	</div>
</form>
