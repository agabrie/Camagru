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
				
					<button class="takepicture" style="font-size:100%;">likes <?php echo '2'; ?></button>
					<input type="text" id="comment_button">
					<button class="takepicture" style="font-size:100%;">comment</button>
				<div class="comments">
					<?php
						$statement = "SELECT * FROM comments WHERE imageID=".$_GET["imageID"]." ORDER BY `date` DESC";
						$records = $db->returnRecord($statement);
						$i = 0;
						foreach($records as $comment)
						{
							echo getValue("userId", $comment["userID"], "username").PHP_EOL."			hello there dorkface";
						}
					?>
					
				</div>
			</div>
		</div>
		<script>
			function comment_button(commentor)
			{
				if(i == 1){
					var x = document.getElementById("comment_button");
    				if (x.style.display === "none") {
    			    	x.style.display = "block";
    				} else {
    			    	x.style.display = "none";
    				}
					// Your existing code unmodified...
					var iDiv = document.createElement('div');
					iDiv.id = 'tempdiv';
					iDiv.className = 'container';
					// document.getElementsByTagName('body')[0].appendChild(iDiv);
					
					// Now create and append to iDiv
					
					// create text box to append to innerdiv
					var textBox = document.createElement('input');
					textBox.setAttribute('type', 'text');
					textBox.setAttribute('value', '');
					textBox.className ="picname";
					iDiv.appendChild(textBox);
					
					// create button top submit picture name
					var butt = document.createElement('input');
					butt.setAttribute('type', 'button');
					butt.setAttribute('value', 'Save');
					butt.className = 'savepicname';
					butt.id = 'add_comm';
				
				
				// The variable iDiv is still good... Just append to it.
					iDiv.appendChild(butt);
				
					iDiv.style.zindex = "10";
					document.getElementById("placeholder").appendChild(iDiv);
				
				
					document.getElementById("add_comm").addEventListener("click", function(){
						var comment;
						if(noSQLTest(textBox.value)){
							comment = "";
						}
						else{
							comment = textBox.value;
						}
						var json = {
									commenter: commenter,
									comment: comment
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
								// window.location = "edit.php";
						
					});
				}
			}
		</script>
	</body>
</html>
