<?php
session_start();
include("config.php");
if($_POST["btn"] == "login/signin")
    header("Location: register.php");
if($_POST["btn"] == "Verify")
    header("Location: verifyaccount.php");
if($_POST["btn"] == "Welcome ".$_SESSION["fname"])
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
            <div style="position:fixed;leftt:1vw;z-index:10;">
            <table>
                <tr>
                <td><input type="submit" class="header_button" name="btn" value="home"></td>
                    <?php
                        if(getValue("USERNAME",$_SESSION["username"],"fname") != "no value returned")
                        {
                            echo
                            '<td><input type="submit" class="header_button" name="btn" value="Welcome '.getValue("username",$_SESSION["username"],"fname").'"></td>';
                        }
                        
                    ?>
                </tr>
            </table>
            </div>
            <div style="position:fixed;right:1vw;z-index:10;">
            <table>
                <tr>
                    <?php
                        if(getValue("username",$_SESSION["username"],"username") != "no value returned")
                        {
                            if(getValue("username",$_SESSION["username"], "verified") != 1)
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