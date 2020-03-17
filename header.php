<?php
if (session_status() == PHP_SESSION_NONE) {
    include("config/setup.php");
}
if(isset($_POST["btn"]))
{
    if($_POST["btn"] == "login/signin")
        header("Location: register.php");
    if($_POST["btn"] == "Verify")
        header("Location: verifyaccount.php");
    if($_POST["btn"] == "Camera")
        header("Location: edit.php");
    if($_POST["btn"] == "logout")
        header("Location: logout.php");
    if($_POST["btn"] == "settings")
        header("Location: settings.php");
    if($_POST["btn"] == "home")
        header("Location: index.php");
}
?> 
<html>
<head>
    <link rel="stylesheet" href="html/style.css" />
	<link
	  href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700&display=swap"
	  rel="stylesheet"
    />
    <div class="header">
        <form action="" method="post">
            <div class="navbutton-left">
                <input type="submit" class="button" name="btn" value="home">
                <?php
                    // if($_SESSION != null){
                        if(isset($_SESSION["username"])){
                        if(getValue("USERNAME",$_SESSION["username"],"fname") != "no value returned")
                        {
                            echo '<input type="submit" class="button" name="btn" value="Camera">';
                        }}
                    // }
                ?>
            </div>
            <div class="navbutton-right">
                <?php
                    echo isset($_SESSION["username"]);
                    if(isset($_SESSION["username"])){
                        if(getValue("username",$_SESSION["username"],"username") != "no value returned")
                        {
                            if(getValue("username",$_SESSION["username"], "verified") == 0)
                                echo '<input type="submit" class="button" name="btn" value="Verify">';
                                echo    '<input type="submit" class="button" name="btn" value="logout">
                                        <input type="submit" class="button" name="btn" value="settings">';
                        }
                    }
                    else
                        echo '<input type="submit" class="button" name="btn" value="login/signin">';
                ?>
            </div>
        </form>
        Camagru
    </div>
		<title>CAMAGRU</title>
        
		
		<!-- <link href="style.css" type="text/css" rel="stylesheet" /> -->
</head>
<div class="footer">&copy agabrie</div>
</html>