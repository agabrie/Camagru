<?php
    session_start();
    // echo $_GET["token"];
    include ("header.php");
    if($_POST["btn"]=="verify")
    {
        $token = $_POST["token"];

    }
    getToken();
?>

<html>
    <body>
        <div align="center">
	    	<!-- <div style="text-align:center">	 -->
	    		<div id="login" class="container">
	    			<form action="login.php" method="post">
	    				<label for="token">Token:</label><br>
	    				<input type="text" name="token" value="<?php echo $_GET['token'];?>" /><br>

	    				<linktext>Forgot Password?<br>Reset password <a href=login.php>here</a>.<br></linktext>
	    				<input type="submit" class="submit_button" name="btn" value="verify"/>
	    				<input type="submit" class="submit_button" name="btn" value="back" />
	    			</form>
			</div>
		</div>
    </body>
</html>