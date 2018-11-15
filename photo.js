(function(){
	var video = document.getElementById('video');
	// var vendorUrL = window.URL || window.webkitURL;
	navigator.getMedia =    navigator.getUserMedia ||
							navigator.webkitGetUserMedia ||
							navigator.mozGetUserMedia||
							navigator.msGetUserMedia;
	navigator.getMedia({
		video: true,
		audio: false
	},function(stream){
		//
		//  video.srcObject = vendorUrl.createObjectURL(stream);
		video.srcObject = stream;
		video.play();
		 
		// video.play(); // returns a false Promise
	}, function(error){
		//Error occured
	});
})();

function takePic()
{

	var new_img = document.createElement("img");

	var context;
	var width = video.scrollWidth, height = video.scrollHeight;

	// var f_width = filter.offsetWidth, f_height = filter.offsetHeight;

	// if (f_width == 0) {
		// f_width = filter.offsetWidth;
	// }
	// if (f_height == 0) { f_height = filter.offsetHeight; }
	 if (fx == 0) { fx = width/100 * 40; }
	 if (fy == 0) { fy = height/100 * 60; }
	
	 canvas = canvas || document.createElement('canvas');
	 canvas.width = width;
	 canvas.height = height;
	
	 context = canvas.getContext('2d');
	 context.globalAlpha = 1.0;
	 context.drawImage(video, 0, 0, width, height);
	// context.drawImage(filter, fx, fy, f_width, f_height);
	 new_img.src = canvas.toDataURL('image/png');
	 new_img.setAttribute("width", "30%");
	 new_img.onclick = function() {
	 	save(new_img.src);
	 }
	 container2.insertBefore(new_img, container2.firstChild);
}