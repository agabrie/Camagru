<?php
session_start();
include("config.php");
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
?> 
<html>
<head>
		<title>CAMAGRU</title>
		<div id="heading" class="container">
			CAMAGRU
		</div>
        <form action="" method="post">
            <div id="left_side">
            <table>
                <tr>
                <td><input type="submit" class="header_button" name="btn" value="home"></td>
                    <?php
                        if(getValue("USERNAME",$_SESSION["username"],"fname") != "no value returned")
                        {
                            echo
                            '<td><input type="submit" class="header_button" name="btn" value="Camera"></td>';
                        }
                        
                    ?>
                </tr>
            </table>
            </div>
            <div id="right_side" >
            <table>
                <tr>
                    <?php
                        if(getValue("username",$_SESSION["username"],"username") != "no value returned")
                        {
                            if(getValue("username",$_SESSION["username"], "verified") == 0)
                            {
                                echo
                                '<td><input type="submit" class="header_button" name="btn" value="Verify"></td>';
                            }
                            echo
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