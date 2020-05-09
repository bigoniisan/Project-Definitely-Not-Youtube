<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<h1>Upload Page</h1>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<script type="text/javascript" src="../../resources/dropzone.js"></script>
	<link rel="stylesheet" href="../../resources/dropzone.js">
	<title>Video Upload</title>
</head>
<body>
<h1>Upload MP4</h1>
<div id="video-upload">
	<?php echo form_open_multipart('welcome/upload_video'); ?>
	<form class="dropzone" id="fileupload">
		<input type="file" id="userfile" name="userfile" accept="video/mp4"/>
		<input type="submit" name="submit" value="Upload MP4" />
		<?php echo $this->session->set_flashdata("error"); ?>
		<?php echo $error; ?>
	</form>
</div>
<br/><br/>

<!--<div id="multiple-video-upload">-->
<!--	--><?php //echo form_open_multipart('welcome/upload_video'); ?>
<!--	<form class="dropzone" id="fileupload">-->
<!--		<input type='file' id="userfiles" name='files[]' accept="video/mp4" multiple="">-->
<!--		<input type='submit' name='submit' value='Upload multiple MP4s' />-->
<!--		--><?php //echo $this->session->set_flashdata("error"); ?>
<!--		--><?php //echo $error; ?>
<!--	</form>-->
<!--</div>-->

<div id="container">
	<video width="320" height="180" controls>
		<source src="<?php echo $file; ?>" type="video/mp4">
	</video>
</div>
</body>
</html>


<!--<div>-->
<!--	<a href="upload_image_server">Upload image to server</a>-->
<!--</div>-->
