<?php
// include("headers.php");
$headers = getallheaders();
if ($headers["Content-type"] == "application/json") {
	$stuff = json_decode(file_get_contents("php://input"), true);
	// print_r($stuff);
	 $fileprefix = "data:image/png;base64,";
	$data = str_replace($fileprefix, "", $stuff["canvas"]);
	$data = base64_decode($data);
	$image = imagecreatefromstring($data);
	$filter = imagecreatefrompng($stuff["filter"]);
	imagecopyresampled($image, $filter, 0, 0, 0, 0, 400, 300, 400, 300);
	
	ob_start();
		imagepng($image);
		$contents =  ob_get_contents();
	ob_end_clean();
	
	
	// echo "imageresampled : ".$contents;
	 $filtered = $fileprefix.base64_encode($contents);
	echo $filtered;
}
?>