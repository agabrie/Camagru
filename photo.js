// navigator.getMedia =    navigator.getUserMedia ||
// 							navigator.webkitGetUserMedia ||
// 							navigator.mozGetUserMedia||
							// navigator.msGetUserMedia;
var video = document.getElementById('video');
var canvas = document.getElementById('canvas');
var context = canvas.getContext('2d');
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
// (function(){
// 	var video = document.getElementById('video');
// 	// var vendorUrL = window.URL || window.webkitURL;
	
// 	navigator.getMedia({
// 		video: true,
// 		audio: false
// 	},function(stream){
// 		//
// 		//  video.srcObject = vendorUrl.createObjectURL(stream);
// 		video.srcObject = stream;
// 		video.play();
		 
// 		// video.play(); // returns a false Promise
// 	}, function(error){
// 		//Error occured
// 	});
// })();

function snap(){
	canvas.width = 400;
	canvas.height = 300;
	// context.drawImage(video, 0, 0);
	context.drawImage(video,0,0,640,480,0,0,canvas.width,canvas.height);
	document.getElementById("canvas").style.transform = "rotateY(180deg)";
	// document.getElementById("imageLoader").value="";
}

// function takePic()
// {

// 	var new_img = document.createElement("img");

	
// 	var width = video.scrollWidth;
// 	var height = video.scrollHeight;

	
// 	 if (fx == 0) { fx = width/100 * 40; }
// 	 if (fy == 0) { fy = height/100 * 60; }
	
// 	//  canvas = canvas || document.createElement('canvas');
// 	//  canvas.width = width;
// 	//  canvas.height = height;
	
// 	 ;
// 	 context.globalAlpha = 1.0;
// 	 context.drawImage(video, 0, 0, width, height);
// 	 new_img.src = canvas.toDataURL('image/png');
// 	 new_img.setAttribute("width", "30%");
// 	 new_img.onclick = function() {
// 	 	save(new_img.src);
// 	 }
// 	 container2.insertBefore(new_img, container2.firstChild);
// }