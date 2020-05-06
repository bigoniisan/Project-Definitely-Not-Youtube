<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<h1>Homepage</h1>
<div id="video-area">

</div>
<!--<img src="--><?php //echo $image?><!--">-->
<?php //echo $this->calendar->generate(); ?>

<div id="myDiv">
	<h2>Let AJAX change this text</h2>
</div>
<form>
<!--	<input type="text" id="change-homepage-text" name="change-homepage-text">-->
	<button type="button" onclick="loadXMLDoc()">Change Content</button>
</form>

<script type="text/javascript">

	// function loadXHR() {
	// 	const xhr = new XMLHttpRequest();
	// 	xhr.onreadystatechange = function() {
	// 		if (xhr.readyState == 4) {
	// 			if (xhr.status == 200) {
	// 				document.getElementById('myDiv').innerHTML = xhr.responseText;
	// 			}
	// 			if (xhr.status = 404) {
	// 				console.log('error');
	// 			}
	// 		}
	// 	}
	//
	// 	xhr.open('get', 'license.txt', true);
	// 	xhr.send();
	// }

	function loadXMLDoc() {
		var xhr;
		// check if browser supports XMLHttpRequest object
		if (window.XMLHttpRequest) {
			// create an XMLHttpRequest object
			xhr = new XMLHttpRequest();
		} else {
			// if not, create an ActiveXObject
			xhr = new ActiveXObject("Microsoft.XMLHTTP");
		}
		xhr.onreadystatechange = function() {
			if (xhr.readyState == 4 && xhr.status == 200) {
				document.getElementById("myDiv").innerHTML = xhr.responseText;
			}
		}
		// send a request to the server
		xhr.open("GET", "license.txt", true);
		xhr.send();
	}
</script>
