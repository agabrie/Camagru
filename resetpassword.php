<?php
	include("header.php");

	echo "an email was sent to ";
?>
<html>
	<body>
		<div align="center">
			<!-- <div style="text-align:center">	 -->
				<div id="login" class="container">
					<form action="" method="post">
						<label for="token">Username:</label><br>
						<input type="text" name="token" value="<?php echo $_GET['token'];?>" /><br>
						<input type="submit" name="btn" class="submit_button" value="Resend">
						<!-- <linktext>Resend verification link?<br>Send token <a href=login.php>here</a>.<br></linktext> -->
						<input type="submit" class="submit_button" name="btn" value="Verify"/>
						<input type="submit" class="submit_button" name="btn" value="Back" />
					</form>
			</div>
		</div>
	</body>
</html>