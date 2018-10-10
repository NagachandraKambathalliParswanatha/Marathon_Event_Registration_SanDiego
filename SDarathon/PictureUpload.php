<?php
$fname = $_FILES["userpic"]["name"];
$target_dir = "/home/jadrn023/public_html/proj3/UploadedImage/";
$target_file = $target_dir . basename($fname);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {

    $check = getimagesize($_FILES["userpic"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    return;
}
// Check file size
if ($_FILES["userpic"]["size"] > 1000000) {
    echo "Sorry, your file is too large.";
    return;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["userpic"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["userpic"]["name"]). " has been uploaded.";
        echo "Success!</br >\n";
        echo "The type is: ".$_FILES['userpic']['type']."<br />";
        echo "The size is: ".$_FILES['userpic']['size']."<br />";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>
