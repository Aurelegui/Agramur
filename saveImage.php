<?php
session_start();
if (isset($_SESSION['userId'])) {
	$user = $_SESSION['uidUsers'];
	$userId = $_SESSION['userId'];
	if (!file_exists("images/")) {
		mkdir("images/");
		chmod("images/", 0755);
	}
	if (!file_exists("images/$user/")) {
		mkdir("images/$user/");
		chmod("images/$user/", 0755);
	}
	if (!file_exists("storage/")){
		mkdir("storage/");
		fopen("/storage/tmp.png");
		chmod("storage/tmp.png", 0755);
	}
	function imagecopymerge_alpha($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, $pct){
		// creating a cut resource
		$cut = imagecreatetruecolor($src_w, $src_h);
	
		// copying relevant section from background to the cut resource
		imagecopy($cut, $dst_im, 0, 0, $dst_x, $dst_y, $src_w, $src_h);
	
		// copying relevant section from watermark to the cut resource
		imagecopy($cut, $src_im, 0, 0, $src_x, $src_y, $src_w, $src_h);
	
		// insert cut resource to destination image
		imagecopymerge($dst_im, $cut, $dst_x, $dst_y, 0, 0, $src_w, $src_h, $pct);
	}
	$filter_name = $_POST['filter'];
	$filter = imagecreatefrompng("filter/".$filter_name.".png");
	imagealphablending($filter, false);
	imagesavealpha($filter, true);
	if (isset($_POST['data'])) {
		$encodedData = $_POST['data'];
		$encodedData = str_replace('data:image/png;base64,', '', $encodedData);
		$encodedData = str_replace(' ','+',$encodedData);
		$img = base64_decode($encodedData);
		file_put_contents("storage/tmp.png", $img);
	}
	$new_img = imagecreatefrompng("storage/tmp.png");
	imagecopymerge_alpha($new_img, $filter, 0, 10, 0, 0, 320, 240, 100);
	$file = date("Ymdhis").'.png';
	imagepng($new_img, "images/$user/".$file);
	$picture_file = "images/$user/$file";
	//insert into database picture uploaded
	require 'includes/dbh.inc.php';	
	$sql = "INSERT INTO userphotos (idUsers, uidUsers, photo, dates) VALUES (?, ?, ?, ?)";
	$stmt = $pdo->prepare($sql);
	$stmt->bindValue(1, $userId);
	$stmt->bindValue(2, $user);
	$stmt->bindValue(3, $picture_file);
	$stmt->bindValue(4, date("Ymdhis"));
	$stmt->execute();
}
else {
header("Location: Login.php");
}
?>
  
