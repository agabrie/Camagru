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
				<img src="<?php echo getImageValue("ID",$_GET["imageID"],"image");?>"><br>
					<button class="takepicture" style="font-size:60%;" onclick="likes_click(
							<?php
									if((getLikesValue(array('imageID','userID'), array($_GET['imageID'],getValue('username', $_SESSION['username'], 'userId')), 'userID')) == getValue('username', $_SESSION['username'], 'userId'))
									{
										echo 0;
									}
									else
									{
										echo 1;
									} 
							?>,
							<?php echo stringify(getValue('username', $_SESSION['username'], 'userId')) ?>,
							<?php echo $_GET['imageID'] ?>)">
							<?php echo ((getLikesValue(array('imageID','userID'), array($_GET['imageID'],getValue('username', $_SESSION['username'], 'userId')), 'userID') == getValue("username", $_SESSION["username"], "userId"))? "Unlike " : "Like ").
									getNumLikes($_GET["imageID"]);
							?>
							</button>
					<input type="text" id="comm" name="comment" style="font-size:60%;">
					<button class="takepicture" style="font-size:60%;" onclick="comment_button(
								<?php echo getValue('username', $_SESSION['username'], 'userId') ?>,
								<?php echo $_GET['imageID'] ?>
							)">
							comment
					</button>
				<div class="comments">
					<?php
						$statement = "SELECT * FROM comments WHERE imageID=".$_GET["imageID"]." ORDER BY `date` DESC";
						$records = $db->returnRecord($statement);
						$i = 0;
						foreach($records as $comment)
						{
							$commentreplaced = (preg_replace("/[%01]/","'",$comment["comment"]))?preg_replace("/%01/","'",$comment["comment"]) : $comment["comment"];
							echo	"<a class='usercomment' href='userspics.php?userId=".$comment["userID"]."'>
										".getValue("userId", $comment["userID"], "username")."
									</a>:\t".
										$commentreplaced.
									"<br>
									<hr>";
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
					textBox.value = textBox.value.replace(/'/g,"%01");
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
					}
					if(x){
						var json = {
								commentor: commentorID,
								image: imageID,
								comments: comment
							}
							var xhr = new XMLHttpRequest();
							xhr.open('POST', 'savecomment.php', true);
							xhr.setRequestHeader('Content-type', 'application/json');
							xhr.onreadystatechange = function (data) {
								 if (xhr.readyState == 4 && xhr.status == 200) {
									 console.log(xhr.responseText);
								 }
							}
							xhr.send(JSON.stringify(json));
							document.location.reload(true);
					}
				}
			}
			function likes_click(x,likerID, imageID)
			{
				if(i == 1){
					if(likerID == "no value returned")
					{
						window.location = "register.php";
					}
					
					var jason = {
								liker: likerID,
								image: imageID,
								liked: x
							}
					
					var xmhr = new XMLHttpRequest();
					xmhr.open('POST', 'likeimage.php', true);
					
					xmhr.setRequestHeader('Content-type', 'application/json');
					xmhr.onreadystatechange = function (data) {
						 if (xmhr.readyState == 4 && xmhr.status == 200) {
							 console.log(xmhr.responseText);
						 }
					};
					xmhr.send(JSON.stringify(jason));
					document.location.reload(true);
				}
			}
			function noSQLTest(str) {
				var da = /[;"=:<>|]/.test(str);
				return da;
			}
		</script>
	</body>
</html>
