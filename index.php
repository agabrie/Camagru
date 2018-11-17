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
					<!-- <div width ="400px"> -->
						<div class = "booth" >
							<video id="video" class="videoElement" width="400" height="300"></video>	
						<!-- </div> -->
						<!-- <br> -->
						<button class="takepicture" onclick="snap()">Take Picture</button>
						<!-- <br> -->
						<!-- <div class="booth2"> -->
							<canvas class="webcamma" id="canvas"></canvas>
						</div>
					<!-- </div> -->
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