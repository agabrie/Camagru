<?php
include("header.php");
?>
<html>
<body>
<div class="container" id="home">
	Welcome to<br>
	CAMAGRU<br>
	<br>
	<?php
		$statement = "SELECT * FROM images ORDER BY `date` DESC";
		// echo $statement;
		$records = $db->returnRecord($statement);
		$i = 0;
		echo "<table>";
		foreach($records as $image)
		{
			$i++;
			
			echo "<td class='gallery'>".getValue("userId", $image["userID"],"username")."<img src=".$image["image"]." style='width:100%;border-radius:30% 30% 30% 30%;' onclick='viewmode()'>".$image["imageName"]."</td>";
			if($i % 5 == 0)
			{
				echo "</tr><tr>";
			}
			
		}
		echo "</tr></table>";
	?>
</div>
</body>
</html>