<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<h1>My Account Page</h1>
<?php echo '<h2>Email: '.$this->session->userdata('email').'</h2>';?>
<?php //echo '<h2>Username: '.$this->session->userdata('username').'</h2>';?>
<?php echo '<h2>Name: '.$this->session->userdata('name').'</h2>';?>
<?php echo form_open('welcome/change_name'); ?>
<form>
	<input type="text" name="change-name" minlength="1" maxlength="20" required>
	<input type="submit" name="change-name-submit" value="Change Name">
	<span class="text-danger"><?php echo form_error('change-name'); ?></span>
</form>
<?php echo '<h2>Birthday: '.$this->session->userdata('birthday').'</h2>';?>
<p>what if I... put my Minecraft bed... next to yours .. aha ha, just kidding.. unless..?</p>
