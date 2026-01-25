<?php
if (hash("sha256", $_POST["password"]) == "9e8528980eeff368f2008d6dedffe76201449b2c335b08c2bdda9cad0da24464") {
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["thefile"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["thefile"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".\n";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

if (file_exists($target_file)) {
  echo "Sorry, file already exists.\n";
  $uploadOk = 0;
} 

if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.\n";
  $uploadOk = 0;
}

if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.\n";
} else {
  if (move_uploaded_file($_FILES["thefile"]["tmp_name"], $target_file)) {
    echo "the file has been uploaded.";
    echo "\n"
    echo "enter <img src=" . htmlspecialchars(basename( $_FILES["fileToUpload"]["name"])) . ">"
  } else {
    echo "Sorry, there was an error uploading your file.\n";
  }
}
}
header('Location: add.html');
?>