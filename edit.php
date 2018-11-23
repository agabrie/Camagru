<?php
	include("header.php");
	// include_once("config.php");
	// echo $_SESSION["username"],getValue("username",$_SESSION["username"],"userId");
	if(getValue("username",$_SESSION["username"],"userId") == "no value returned")
	{
		echo	"<div style='text-align: center;'><div id='errorsdiv'> You must login to save pictures. </div></div>";
	}
	else
	{
		if(getValue("username",$_SESSION["username"],"verified") == "0")
			echo	"<div style='text-align: center;'><div id='errorsdiv'>You must verify your account</div></div>";
	}
?>

<html>
	<body>
			<div class="container" id="home">
				<?php echo getValue("username",$_SESSION["username"],"fname")."'s" ?><br>
				<?php echo "Gallery" ?><br>
				<br>
				<div class="container" id="main">
					<!-- Main -->
					<div class="booth" >
						<video id="video" class="videoElement" width="400" height="300"></video>	
						<!-- <input type="button" class="takepicture" onclick="snap()" value="Take Picture"><input type="button" class="takepicture" onclick="snap()" value="Take Picture"> -->
						<div id="placeholder">
							<button class="takepicture" onclick="snap()">take picture</button><!--
							--><input type="file" name="file" id="file" class="inputfile" /><label for="file">upload file</label><!--
							--><?php
									if((int)getValue("username",$_SESSION["username"],"verified") > 0)
									{
										echo '<button class="takepicture" id="save_button" onclick="create_button()">save picture</button>';
									}
								?>
						</div>
						<canvas class="webcamma" id="canvas"></canvas>
					</div>
					<div class="container" id="side">
						Side
						<?php
							if(getValue("username",$_SESSION["username"], "userId") != "no value returned")
							{
							$statement = "SELECT * FROM images WHERE userId = ".getValue("username",$_SESSION["username"], "userId")." ORDER BY `date` DESC";
							// echo $statement;
							$records = $db->returnRecord($statement);
							foreach($records as $image)
							{
								echo "<div class='usergallery'><img src=".$image["image"]." style='width:100%;border-radius:30% 30% 15% 15%;' onclick='viewmode()'>".$image["imageName"]."</div>";
							}
							// print_r($records);
							// echo $statement;
						}
						?>
					</div>
					<div class="container" id="filters">
						filters
						<button onclick="resetcanvas()">Reset</button>
						<button onclick="applytocanvas()">apply</button>
						<img src='filter.png' id='filter1' width='80%' onclick='setsticker()'>
						<img src='filter.png' id='filter2' width='80%' onclick='setsticker()'>
						<img src='filter.png' id='filter3' width='80%' onclick='setsticker()'>
						<img src='filter.png' id='filter4' width='80%' onclick='setsticker()'>
					</div>
				</div>
				
			</div>
			<script src="photo.js"></script>
	</body>
</html>