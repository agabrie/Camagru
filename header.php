<?php
session_start();
include_once("config.php");
if($_POST["btn"] == "login/signin")
    header("Location: register.php");
if($_POST["btn"] == "Welcome ".$_SESSION["username"])
    header("Location: login.php");
if($_POST["btn"] == "logout")
    header("Location: logout.php");
if($_POST["btn"] == "settings")
    header("Location: settings.php");
?> 
<html>
<head>
		<title>CAMAGRU</title>
		<div id="heading" class="container">
			CAMAGRU
		</div>
        <form action="" method="post">
            <div style="position:fixed;right:1vw;z-index:10;">
            <table>
                <tr>
                    
                    <?php
                        if($_SESSION["username"] != "")
                        {
                            echo
                            '<td><input type="submit" class="header_button" name="btn" value="Welcome '.$_SESSION["username"].'"></td>'.
                            '<td><input type="submit" class="header_button" name="btn" value="logout"></td>'.
                            '<td><input type="submit" class="header_button" name="btn" value="settings"></td>';
                        }
                        else
                            echo '<td><input type="submit" class="header_button" name="btn" value="login/signin"></td>';
                        ?>
                </tr>
                </table>
            </div>
        </form>
		
		<link href="style.css" type="text/css" rel="stylesheet" />
</head>
<div id="footing" class="container">
			&copy agabrie
</div>
</html>