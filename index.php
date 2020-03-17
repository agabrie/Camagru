<?php
	include("header.php");

	$imagelimit = 15;

	echo "<div class='main' id='home'>".
		 "Welcome<br>";
		 if($_SESSION != null){
		if($_SESSION["username"]){
			echo getValue("username",$_SESSION["username"],"fname")."<br><br>";
		}}
		$statement = "SELECT * FROM images ORDER BY `date` DESC";
		$records = $db->returnRecord($statement);
		$total = count($records);
		if(isset($_GET["page"])){
			    $page = $_GET["page"];
			    $i = ($_GET["page"] - 1 )* $imagelimit;
		}else
		{
			$i = 0;
			$page = 1;
		}
		$pages = ceil($total / $imagelimit);
		echo "<table>";
		if($records != null)
		while ($i < $imagelimit*$page && $records[$i]){
			$image = $records[$i];
			echo "<td class='gallery'>
					<table>
					<tr>
						<td style='text-align: center; color:white;'>
							<a class='username' href='userspics.php?userId=".$image["userID"]."'>
								".getValue("userId", $image["userID"],"username")."
							</a>
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
							<td style='text-align: center; color:white;'>
								".$image["imageName"]."
							</td>
						</tr>
			 		</table>
				</td>";
			$i++;
			if($i % 5 == 0)
				echo "</tr><tr>";
		}
		echo "<table>";
		for ($x = 1; $x <= $pages; $x++){
			echo "<td class='takepicture' style='font-size:100%;'><a style='color:white;' href='index.php?page=$x'>$x</a>"."</td>";
		}
		echo "</table>";
		echo "</table><br>";
		echo "</div>";
		// echo "<table>";
		// foreach($records as $image){
		// 	$i++;
		// 	echo	"<td class='gallery'>
		// 				<table>
		// 					<tr>
		// 						<td style='text-align: center; color:white;'>
		// 							<a class='username' href='userspics.php?userId=".$image["userID"]."'>
		// 								".getValue("userId", $image["userID"],"username")."
		// 							</a>
		// 						</td>
		// 					</tr>
		// 					<tr>
		// 						<td style='text-align: center; color:white;'>
		// 							<a href='viewimage.php?imageID=".$image["id"]."&userID=".$image["userID"]."'>
		// 								<img src=".$image["image"]." style='width:100%;border-radius:30% 30% 30% 30%;'>
		// 							</a>
		// 						</td>
		// 					</tr>
		// 					<tr>
		// 						<td style='text-align: center; color:white;'>
		// 							".$image["imageName"]."
		// 						</td>
		// 					</tr>
		// 				</table>
		// 			</td>";
		// 	if($i % 5 == 0)
		// 		echo "</tr><tr>";
		// }
	?>