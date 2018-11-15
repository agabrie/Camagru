<?php
	include("header.php");
	// include_once("config.php");
?>

<html>
	<body>
			<div class="container" id="home">
				Welcome to<br>
				CAMAGRU<br>
				
				<br>
				<div class="container" id="main">
					<!-- Main -->
					<!-- <br> -->
					<div class = "booth" >
						<video id="video" class="videoElement" width="400" height="300"></video>
						<button class="takepicture" onclick="takePic()">Take Picture</button>
						<div id="booth2" class="booth2"></div>
					</div>
					<div class="container" id="side">
						Side
					</div>
					<div class="container" id="filters">
						filters
					</div>
				</div>
				
			</div>
			<script src="photo.js"></script>
	</body>
</html>