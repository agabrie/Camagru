<?php
include ("header.php");
?>
<html>
	<body>
	<div class="container" id="home">
				<?php echo getValue("userID",$_GET["userId"],"username")."'s" ?><br>
				<?php echo "Gallery" ?><br>
				<br>
		<?php
			$statement = "SELECT * FROM images WHERE userID=".$_GET["userId"]." ORDER BY `date` DESC";
			$records = $db->returnRecord($statement);
			$i = 0;
			echo "<table>";
			foreach($records as $image)
			{
				$i++;
				
				echo "<td class='gallery'>
						<table>
						<tr>
							<td style='text-align: center; color:white;'>
								<a class='username' href='userspics.php?userId=".$image["userID"]."'>".getValue("userId", $image["userID"],"username")."</a>
							</td>
						</tr>
						<tr>
							<td style='text-align: center; color:white;'>
								<a href='viewimage.php?imageID=".$image["id"]."&userID=".$image["userID"]."'>
									<img src=".$image["image"]." style='width:100%;border-radius:30% 30% 30% 30%;'>
								</a>
							</td>
						</tr>
						<tr>
							<td style='text-align: center; color:white;'>".$image["imageName"]."</td>
						</tr>
						</table>
					</td>";
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