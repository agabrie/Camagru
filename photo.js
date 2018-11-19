// navigator.getMedia =    navigator.getUserMedia ||
// 							navigator.webkitGetUserMedia ||
// 							navigator.mozGetUserMedia||
							// navigator.msGetUserMedia;
var video = document.getElementById('video');
var canvas = document.getElementById('canvas');
var context = canvas.getContext('2d');
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
	// context.drawImage(video, 0, 0);
	context.drawImage(video,0,0,640,480,0,0,canvas.width,canvas.height);
	document.getElementById("canvas").style.transform = "rotateY(180deg)";
	document.getElementById("canvas").style.webkitTransform = "rotateY(180deg)";
	document.getElementById("canvas").style.mozTransform = "rotateY(180deg)";
	imageLoader.value="";
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
function create_button()
{
	if(i){
	// Your existing code unmodified...
	var iDiv = document.createElement('div');
	iDiv.id = 'tempdiv';
	iDiv.className = 'container';
	// document.getElementsByTagName('body')[0].appendChild(iDiv);

	// Now create and append to iDiv
	
	// create text box to append to innerdiv
	var textBox = document.createElement('input');
	textBox.setAttribute('type', 'text');
	textBox.setAttribute('value', 'untitled.png');
	textBox.className ="picname";
	iDiv.appendChild(textBox);
	
	// create button top submit picture name
	var butt = document.createElement('input');
	butt.setAttribute('type', 'button');
	butt.setAttribute('value', 'Save');
	butt.className = 'savepicname';
	butt.id = 'add_gal';
	
	
	// The variable iDiv is still good... Just append to it.
	iDiv.appendChild(butt);
	
	iDiv.style.zIndex = "10";
	document.getElementById("placeholder").appendChild(iDiv);
	
	
	document.getElementById("add_gal").addEventListener("click", function(){
		var img = new Image();
		var nam = textBox.value.trim;
		img.src = canvas.toDataURL();
		var json = {
					pikcha: img.src,
					picname: nam
				}
				var xhr = new XMLHttpRequest();
				xhr.open('POST', 'saveimages.php', true);
				xhr.setRequestHeader('Content-type', 'application/json');
				xhr.onreadystatechange = function (data) {
					 if (xhr.readyState == 4 && xhr.status == 200) {
						 console.log(xhr.responseText);
					 }
				}
				xhr.send(JSON.stringify(json));
				window.location = "index.php";
	 
	});
	}
}


