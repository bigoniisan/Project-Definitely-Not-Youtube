<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php echo form_open_multipart('welcome/upload_image'); ?>
<form>
	<input type="file" name="userfile" />
	<input type="submit" name="submit" value="Upload Image"/>
<!--	--><?php //echo $this->session->set_flashdata("error"); ?>
	<?php echo $error; ?>
</form>
<div id="container">
	<img src="<?php echo $image?>">
</div>
<div>
	<a href="upload_image_server">Upload image to server</a>
</div>
