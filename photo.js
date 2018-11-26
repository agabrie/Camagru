var video = document.getElementById('video');
var canvas = document.getElementById('canvas');
var context = canvas.getContext('2d');
var imagefilter = document.getElementById("filteroverlay");
var canvasfilter = document.getElementById("filteroverlay2");
var imageLoader = document.getElementById('file');
    		imageLoader.addEventListener('change', fetch, false);
var i = 0;
navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia ||
		navigator.mozGetUserMedia || navigator.oGetUserMedia || navigator.msGetUserMedia;

		if (navigator.getUserMedia){
			navigator.getUserMedia({video:true}, streamWebCam, throwError);
		}

		function streamWebCam(stream){
			video.srcObject = stream;
			video.play();
		}

		function throwError(e){
			alert(e.name);
		}

function snap(){
	i = 1;
	canvas.width = 400;
	canvas.height = 300;

	
	
	context.translate(canvas.width, 0);
	context.scale(-1, 1);
	context.save();
	context.restore();
	context.drawImage(video,0,0,640,480,0,0,canvas.width,canvas.height);
	document.getElementById("canvas").style.transform = "rotateY(0deg)";
	document.getElementById("canvas").style.webkitTransform = "rotateY(0deg)";
	document.getElementById("canvas").style.mozTransform = "rotateY(0deg)";
	imageLoader.value="";
}
function resetcanvas()
{
	imagefilter.setAttribute('src','');
	canvasfilter.setAttribute('src','');
	imagefilter.style.visibility = "hidden";
	canvasfilter.style.visibility = "hidden";
}
function applyfilter(image)
{
	console.log(image);
	var imga = new Image();
	imga.src = image;
	// http://127.0.0.1:8080/Camagru/stickers/
	nam = (canvasfilter.src).substring(39);
	// var c = canvas.getContext("2d");
	// c.translate(canvas.width, 0);
	// c.scale(1, 1);
	// c.save();
	// c.restore();
	// c.drawImage(imga,0,0,imga.width,imga.height,0,0,canvas.width,canvas.height);
	// console.log(c)
	// canvas.style.transform = "rotateY(0deg)";
	var json = {
		pic: imga.src,
		picname: nam
	}
	var xhr = new XMLHttpRequest();
	xhr.open('POST', 'saveimages.php', true);
	xhr.setRequestHeader('Content-type', 'application/json');
	xhr.onreadystatechange = function (data) {
		 if (xhr.readyState == 4 && xhr.status == 200) {
			//  console.log(xhr.responseText);
		 }
	}
	xhr.send(JSON.stringify(json));
	window.location = "edit.php";
}
function applytocanvas()
{
	var img = new Image();
	img.src = canvas.toDataURL();
	var sticker = {
		filter:canvasfilter.src,
		canvas:img.src
	}
	var xhr = new XMLHttpRequest();
	xhr.open('POST', 'filteroverlay.php', true);
	xhr.setRequestHeader('Content-type', 'application/json');
	xhr.onreadystatechange = function (data) {
		 if (xhr.readyState == 4 && xhr.status == 200) {
			// console.log(xhr.responseText);
			applyfilter(xhr.responseText);	
		 }
		
	}
	xhr.send(JSON.stringify(sticker));
}
function setsticker(sticker)
{
	
	imagefilter.setAttribute('src', './stickers/'+sticker+'.png');
	canvasfilter.setAttribute('src', './stickers/'+sticker+'.png');
	imagefilter.style.visibility = "visible";
	canvasfilter.style.visibility = "visible";
	
	var xhr = new XMLHttpRequest();
	xhr.open('POST', 'edit.php', true);
	xhr.setRequestHeader('Content-type', 'application/json');
	xhr.onreadystatechange = function (data) {
		 if (xhr.readyState == 4 && xhr.status == 200) {
			//  console.log(xhr.responseText);
		 }
	}
	xhr.send(JSON.stringify(sticker));
}

function fetch(e){
	i = 1;
	var reader = new FileReader();
	reader.onload = function(event){
		var img = new Image();
		img.onload = function(){
			canvas.width = video.clientWidth;
			canvas.height = video.clientHeight;
			context.drawImage(img,0,0,img.width,img.height,0,0,canvas.width,canvas.height);
		}
		img.src = event.target.result;
	}
	reader.readAsDataURL(e.target.files[0]);
	document.getElementById("canvas").style.transform = "rotateY(0deg)";
}
function removeimage(imageID)
{
	var xhr = new XMLHttpRequest();
	xhr.open('POST', 'removeimage.php', true);
	xhr.setRequestHeader('Content-type', 'application/json');
	xhr.onreadystatechange = function (data) {
		 if (xhr.readyState == 4 && xhr.status == 200) {
			 console.log(xhr.responseText);
		 }
	}
	xhr.send(JSON.stringify(imageID));
	window.location = "edit.php";
}
function create_button()
{
	if(i == 1){
		var x = document.getElementById("save_button");
    	if (x.style.display === "none") {
        	x.style.display = "block";
    	} else {
        	x.style.display = "none";
    	}
	var iDiv = document.createElement('div');
	iDiv.id = 'tempdiv';
	iDiv.className = 'container';
	
	var textBox = document.createElement('input');
	textBox.setAttribute('type', 'text');
	textBox.setAttribute('value', 'untitled.png');
	textBox.className ="picname";
	iDiv.appendChild(textBox);
	
	var butt = document.createElement('input');
	butt.setAttribute('type', 'button');
	butt.setAttribute('value', 'Save');
	butt.className = 'savepicname';
	butt.id = 'add_gal';
	iDiv.appendChild(butt);
	iDiv.style.zindex = "10";
	document.getElementById("placeholder").appendChild(iDiv);

	document.getElementById("add_gal").addEventListener("click", function(){
		var img = new Image();
		var nam;
		
		if(noSQLTest(textBox.value)){
			nam = "untitled.png";
		}
		else{
			nam = textBox.value;
		}

		img.src = canvas.toDataURL();
		var json = {
					pic: img.src,
					picname: nam
				}
				var xhr = new XMLHttpRequest();
				xhr.open('POST', 'saveimages.php', true);
				xhr.setRequestHeader('Content-type', 'application/json');
				xhr.onreadystatechange = function (data) {
					 if (xhr.readyState == 4 && xhr.status == 200) {
						//  console.log(xhr.responseText);
					 }
				}
				xhr.send(JSON.stringify(json));
				window.location = "edit.php";
	 
	});
	}
	
}

function noSQLTest(str) {
	var da = /[;"=:*?<>|]/.test(str);
	return da;
}
