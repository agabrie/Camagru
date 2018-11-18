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
					<div class = "booth" >
						<video id="video" class="videoElement" width="400" height="300"></video>	
						<!-- <input type="button" class="takepicture" onclick="snap()" value="Take Picture"><input type="button" class="takepicture" onclick="snap()" value="Take Picture"> -->
						<button class="takepicture" onclick="snap()">take picture</button><!--
						--><input type="file" name="file" id="file" class="inputfile" /><label for="file">upload file</label><!--
						--><button id="add_gal" class="takepicture">save picture</button>
						<canvas class="webcamma" id="canvas"></canvas>
					</div>
					<div class="container" id="side">
						Side
						<?php
							$statement = "SELECT * FROM images WHERE userId = ".getValue($_SESSION["username"], "userId");
							$records = $db->returnRecord($statement);
							foreach($records as $image)
							{
								echo "<img src=".$image["image"].">";
							}
							// print_r($records);
							echo $statement;

						?>
					</div>
					<div class="container" id="filters">
						filters
					</div>
				</div>
				
			</div>
			<script src="photo.js"></script>
	</body>
</html>