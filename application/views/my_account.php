<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<h1>My Account Page</h1>
<?php echo '<h2>Email: '.$this->session->userdata('email').'</h2>';?>
<?php //echo '<h2>Username: '.$this->session->userdata('username').'</h2>';?>
<?php echo '<h2>Name: '.$this->session->userdata('first_name').' '.$this->session->userdata('last_name').'</h2>';?>
<?php echo '<h2>Birthday: '.$this->session->userdata('birthday').'</h2>';?>
<p>what if I... put my Minecraft bed... next to yours .. aha ha, just kidding.. unless..?</p>
