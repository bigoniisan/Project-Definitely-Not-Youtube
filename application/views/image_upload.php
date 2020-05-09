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
	<script type="text/javascript" src="../../resources/dropzone.js"></script>
	<link rel="stylesheet" href="../../resources/dropzone.js">
	<title>Document</title>
</head>
<body>
<div id="form-container">
	<?php echo form_open_multipart('welcome/upload_image'); ?>
	<form class="dropzone" id="fileupload">
		<input type="file" id="userfile" name="userfile" accept="image/jpeg, image/png, image/gif"/>
		<input type="submit" name="submit" value="Upload Image" />
		<?php echo $this->session->set_flashdata("error"); ?>
		<?php echo $error; ?>
	</form>
</div>

<div id="container">
	<img src="<?php echo $file?>">
</div>
</body>
</html>


<!--<div>-->
<!--	<a href="upload_image_server">Upload image to server</a>-->
<!--</div>-->
