<?php
	include("header.php");
	$headers = getallheaders();
	if ($headers["Content-type"] == "application/json") {
		$stuff = json_decode(file_get_contents("php://input"), true);
		// print_r($_SESSION);
	}
	if(isset($_POST["apply"]) && $_POST["apply"]=="apply")
	{
		echo "<script>alert('yes')</script>";
	}
	if(getValue("username",$_SESSION["username"],"userId") == "no value returned")
	{
		echo	"<div style='text-align: center;'>
					<div id='errorsdiv'>
						You must login to save pictures.
					</div>
				</div>";
	}
	else
	{
		if(getValue("username",$_SESSION["username"],"verified") == "0")
			echo	"<div style='text-align: center;'>
						<div id='errorsdiv'>
							You must verify your account
						</div>
					</div>";
	}
?>

<html>
	<body>
			<div class="container" id="home">
				<?php echo getValue("username",$_SESSION["username"],"fname")."'s" ?><br>
				<?php echo "Gallery" ?><br>
				<br>
				<div class="container" id="main">
					<div class="booth" >
					<img id='filteroverlay' style='height:300px;width:400px;position:absolute;z-index:7;visibility:hidden;'>		
						<video id="video" class="videoElement" width="400" height="300"></video>
						<div id="placeholder">
							<button class="takepicture" onclick="snap()">take picture</button><!--
							--><input type="file" name="file" id="file" class="inputfile" /><label for="file">upload file</label><!--
							-->
								<?php
									if((int)getValue("username",$_SESSION["username"],"verified") > 0)
										echo '<button class="takepicture" id="save_button" onclick="create_button()">save picture</button>';
								?>
						</div>
						
						<img id='filteroverlay2' style='height:300px;width:400px;position:absolute;z-index:7;visibility:hidden;'>
						<canvas class="webcamma" id="canvas"></canvas>
					</div>
					<div class="container" id="side">
						Side
						<?php
							if(getValue("username",$_SESSION["username"], "userId") != "no value returned")
							{
							$statement = "SELECT * FROM images WHERE userId = ".getValue("username",$_SESSION["username"], "userId")." ORDER BY `date` DESC";
							$records = $db->returnRecord($statement);
							foreach($records as $image)
							{
								echo	"<div class='usergallery'>
											<a href='viewimage.php?imageID=".$image["id"]."&userID=".$image["userID"]."'>
												<img src=".$image["image"]." style='width:100%;border-radius:30% 30% 30% 30%;'>
											</a><button class='takepicture' style='font-size:100%;' onclick='removeimage(".$image["id"].")'>X</button>".$image["imageName"]."
										</div>";
							}
						}
						?>
					</div>
					<div class="container" id="filters">
						filters<br>
						<button class="takepicture" onclick="resetcanvas()">Reset</button>
						<button class="takepicture" onclick="applytocanvas()">Save to Gallery</button>
						<div style="border:	5px double rgb(133, 15, 15);margin:3px 10px;"><img src='./stickers/border1.png' id='border1' width='80%' onclick='setsticker(id)'></div>
						<div style="border:	5px double rgb(133, 15, 15);margin:3px 10px;"><img src='./stickers/kawaii_banner.png' id='kawaii_banner' width='80%' onclick='setsticker(id)'></div>
						<div style="border:	5px double rgb(133, 15, 15);margin:3px 10px;"><img src='./stickers/kawaii_food.png' id='kawaii_food' width='80%' onclick='setsticker(id)'></div>
						<div style="border:	5px double rgb(133, 15, 15);margin:3px 10px;"><img src='./stickers/kawaii_neko.png' id='kawaii_neko' width='80%' onclick='setsticker(id)'></div>
						<div style="border:	5px double rgb(133, 15, 15);margin:3px 10px;"><img src='./stickers/moon.png' id='moon' width='80%' onclick='setsticker(id)'></div>
						<div style="border:	5px double rgb(133, 15, 15);margin:3px 10px;"><img src='./stickers/roses.png' id='roses' width='80%' onclick='setsticker(id)'></div>
						<div style="border:	5px double rgb(133, 15, 15);margin:3px 10px;"><img src='./stickers/rosesborder.png' id='rosesborder' width='80%' onclick='setsticker(id)'></div>
						<div style="border:	5px double rgb(133, 15, 15);margin:3px 10px;"><img src='./stickers/smile.png' id='smile' width='80%' onclick='setsticker(id)'></div>
					</div>
				</div>
				
			</div>
			<script src="photo.js"></script>
	</body>
</html>