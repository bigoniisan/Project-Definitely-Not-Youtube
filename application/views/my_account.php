<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<h1>My Account Page</h1>

<?php echo form_open('welcome/change_email'); ?>
<?php echo '<h2>Email: '.$_SESSION['email'].'</h2>';?>
<form>
	<label>Change Email</label>
	<input type="email" name="change-email" minlength="1" maxlength="20" required>
	<input type="submit" name="change-email-submit" value="Change Email">
	<span class="text-danger"><?php echo form_error('change-email'); ?></span>
	<?php echo $this->session->set_flashdata("error"); ?>
</form>

<?php echo '<h2>Name: '.$_SESSION['name'].'</h2>';?>
<?php echo form_open('welcome/change_name'); ?>
<form>
	<label>Change Name</label>
	<input type="text" name="change-name" minlength="1" maxlength="20" required>
	<input type="submit" name="change-name-submit" value="Change Name">
	<span class="text-danger"><?php echo form_error('change-name'); ?></span>
	<?php echo $this->session->set_flashdata("error"); ?>
</form>

<?php echo form_open('welcome/change_birthday'); ?>
<?php echo '<h2>Birthday: '.$this->session->userdata('birthday').'</h2>';?>
<form>
	<label>Change Birthday</label>
	<input type="date" name="change-birthday" minlength="1" maxlength="20" required>
	<input type="submit" name="change-birthday-submit" value="Change Birthday">
	<span class="text-danger"><?php echo form_error('change-birthday'); ?></span>
	<?php echo $this->session->set_flashdata("error"); ?>
</form>

<?php
echo $this->session->flashdata('email_sent');
echo form_open('welcome/send_email');
?>
<input type="email" name="send-email">
<input type="submit" value="Send email for some reason">
<?php echo $this->session->set_flashdata("error"); ?>
<?php //echo form_close();?>
<a href="https://infs3202-78c24710.uqcloud.net/infs3202/welcome/send_email">send email for some reason</a>
