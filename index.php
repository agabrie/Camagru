<?php
include_once("config.php");
if($_POST["btn"] == "login/signin")
	header("Location: register.php");
?> 
<html>
	<head>
		<title>CAMAGRU</title>
		<div id="heading" class="container">
			CAMAGRU
			
			<!-- link to login/register pages -->
			<a href="register.php"><linktext style="float:right">login/register</linktext></a>
			<!-- <form action="" method="post">
				<input type="submit" class="header_button" name="btn" value="login/signin">
			</form> -->
		</div>
		
		<link href="style.css" type="text/css" rel="stylesheet" />
	</head>
	<body>
		<!-- <div style="text-align: center"> -->
		<!-- <div align="center"> -->
			<div class="container" id="home">
				Welcome to<br>
				CAMAGRU<br>
				
				<br>
				<div class="container" id="main">
					Main
					<div class="container" id="side">
						Side
					</div>
				</div>
				
			</div>
		<!-- </div> -->
	</body>
	<div id="footing" class="container">
			&copy agabrie
	</div>
</html>