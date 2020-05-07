<!--<!doctype html>-->
<!--<html lang="en">-->
<!--<head>-->
<!--	<meta charset="UTF-8">-->
<!--	<meta name="viewport"-->
<!--		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">-->
<!--	<meta http-equiv="X-UA-Compatible" content="ie=edge">-->
<!--	<title>Document</title>-->
<!--	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">-->
<!--	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>-->
<!---->
<!--</head>-->
<!--<body>-->
<!--	<div class="container">-->
<!--		<br/><br/><br/>-->
<!--		<h3 align="center">--><?php //echo $title; ?><!--</h3>-->
<!--		<form method="post" id="upload_form" enctype="multipart/form-data">-->
<!--			<input type="file" name="image_file" id="image_file"/>-->
<!--			<br/>-->
<!--			<br/>-->
<!--			<input type="submit" name="upload" id="upload" value="Upload" class="btn"/>-->
<!--		</form>-->
<!--		<br/>-->
<!--		<br/>-->
<!--		<div id="uploaded_image">-->
<!---->
<!--		</div>-->
<!--		--><?php //echo $error ?>
<!--	</div>-->
<!--</body>-->
<!--</html>-->
<!---->
<!--<script>-->
<!--	$(document).ready(function() {-->
<!--		$('#upload_form').on('submit', function(e) {-->
<!--			// prevent submit button from submitting a form-->
<!--			e.preventDefault();-->
<!--			if ($('#image_file').val() == '') {-->
<!--				// .val() gets name of selected file-->
<!--				// condition checks if file is blank-->
<!--				alert("PLease select the file");-->
<!--			} else {-->
<!--				$.ajax({-->
<!--					// base_url() = http://localhost/infs3202-->
<!--					url:"--><?php //echo base_url(); ?>//main/ajax_upload",
//					method:"POST",
//					data:new FormData(this),
//					contentType: false,
//					cache: false,
//					processData: false,
//					success: function(data) {
//						// here will receive data from server in html form
//						$('#uploaded_image').html(data);
//					}
//				})
//			}
//		})
//	})
//</script>
