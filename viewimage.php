<?php
include("header.php");

?>
<html>
	<body>
		<div class="container" id="home">
					<?php echo getValue("userId",$_GET["userID"],"username")."'s" ?><br>
					<?php echo getImageValue("ID",$_GET["imageID"],"imageName") ?><br>
					<br>
			<div class="viewImage">
				<img src="<?php echo getImageValue("ID",$_GET["imageID"],"image")?>">
				<br>
					
					<button class="takepicture" style="font-size:60%;" onclick="likes_click(<?php if(getLikesValue('imageID', $_GET['imageID'], 'userID') == $_GET['userID']){echo 0;}else{echo 1;} ?>,<?php echo getValue('username', $_SESSION['username'], 'userId') ?>, <?php echo $_GET['imageID'] ?>)"><?php echo ((getLikesValue('imageID', $_GET['imageID'], 'userID') == $_GET['userID'])? "Unlike " : "Like ").getNumLikes($_GET["imageID"]); ?></button>
					<input type="text" id="comm" name="comment" style="font-size:60%;">
					<!-- <input type="submit" class="takepicture" name="btn" style="font-size:40%;" value="Comment"> -->
					<button class="takepicture" style="font-size:60%;" onclick="comment_button(<?php echo getValue('username', $_SESSION['username'], 'userId') ?>, <?php echo $_GET['imageID'] ?>)">comment</button>
					
				<div class="comments">
					<?php
						$statement = "SELECT * FROM comments WHERE imageID=".$_GET["imageID"]." ORDER BY `date` DESC";
						$records = $db->returnRecord($statement);
						$i = 0;
						foreach($records as $comment)
						{
							echo "<a class='usercomment' href='userspics.php?userId=".$comment["userID"]."'>".getValue("userId", $comment["userID"], "username")."</a>:\t".$comment["comment"]."<br><hr>";
						}
					?>
					
				</div>
			</div>
		</div>
		<script>
			var i = 1;
			function comment_button(commentorID, imageID)
			{
				if(i == 1){
					var comment;
					var x;
					var textBox = document.getElementById("comm");
					if(noSQLTest(textBox.value)){
						comment = "";
						x = 0;
					}
					else{
						comment = textBox.value;
						x = 1;
					}
					if(comment == "")
					{
						x = 0;
						// alert("commentor ID : "+commentorID + "\nimage ID : " + imageID + "\ncomment : " + comment + "\nx : " + x);
					}
					if(x){
						var json = {
								commentor: commentorID,
								image: imageID,
								comments: comment
							}
							// alert("commentor ID : "+commentorID + "\nimage ID : " + imageID + "\ncomment : " + comment);
							var xhr = new XMLHttpRequest();
							xhr.open('POST', 'savecomment.php', true);
							xhr.setRequestHeader('Content-type', 'application/json');
							xhr.onreadystatechange = function (data) {
								 if (xhr.readyState == 4 && xhr.status == 200) {
									 console.log(xhr.responseText);
								 }
							}
							xhr.send(JSON.stringify(json));
							// window.location = "edit.php";
							window.location.reload();
					}
				}
			}
			function likes_click(x,likerID, imageID)
			{
				if(i == 1){
					var json;
					if(x){
						json = {
								liker: likerID,
								image: imageID
							}
					}else
					{
						json = {
								unliker: likerID,
								image: imageID
							}
					}
					var xhr = new XMLHttpRequest();
					xhr.open('POST', 'likeimage.php', true);
					xhr.setRequestHeader('Content-type', 'application/json');
					xhr.onreadystatechange = function (data) {
						 if (xhr.readyState == 4 && xhr.status == 200) {
							 console.log(xhr.responseText);
						 }
					}
					xhr.send(JSON.stringify(json));
					// window.location = "edit.php";
					window.location.reload();
				}
			}
			function noSQLTest(str) {
				var da = /[;"=:<>|]/.test(str);
				return da;
			}
		</script>
	</body>
</html>
