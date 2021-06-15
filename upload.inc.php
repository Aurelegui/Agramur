<?php
session_start();
if (isset($_SESSION['userId'])) {
    if (!file_exists("storage/")) {
		mkdir("storage/");
		fopen("/storage/tmp.png");
        chmod("storage/tmp.png", 0755);
    }
    $target_file = "storage/tmp.png";
    $uploadOk = 0;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $fileName = $_FILES['file']['name'];
        $fileError = $_FILES['file']['error'];
        $fileSize = $_FILES['file']['size'];
        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));
        $allowed = array('jpg', 'jpeg', 'png');
        if(in_array($fileActualExt, $allowed)) {
            $uploadOk = 1;
        }
        else {
            header("Location: upload-page.php?error=wrongformat");
            exit();
        }
        $check = getimagesize($_FILES['file']['tmp_name']);
        if($check !== false && $check[0] == "320" && $check[1] == "240") {
            echo "File is an image - " . $check['mime'] . "." .$check[0].$check[1];
            $uploadOk = 1;
        } 
        else {
            header("Location: upload-page.php?error=size");
            exit();
            $uploadOk = 0;
        }
    }
    if(move_uploaded_file($_FILES["file"]["tmp_name"], $target_file) && $uploadOk == 1) {
        header("Location: upload.php");
    }
}
else {
    header("Location: upload-page.php?error=error");
}
?>