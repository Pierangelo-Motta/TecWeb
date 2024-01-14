<?php
session_start();
require_once('login.controller.php');
require_once('login.model.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $oldImageName = getDbImageName($_SESSION['username']);
    // Check if a file is selected
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {

        // Get the absolute path to the current directory
        $currentDirectory = __DIR__;

        // Construct the full path for the destination directory
        $uploadDirectory = $currentDirectory . '/../images/users/';

        // Generate a unique name for the uploaded image
        $imageName = uniqid() . "_" . str_replace(" ","_",$_FILES["image"]["name"]);
        $sourcePath = $_FILES["image"]["tmp_name"];
        // Set the path for the uploaded image
        $destinationPath = $uploadDirectory . $imageName;


        // Move the uploaded file to the specified folder
        if (move_uploaded_file($sourcePath, $destinationPath)) {

            // delete old image
            deleteOldImage( $uploadDirectory,$oldImageName);
            // Image upload successful; save $imageName to the database
            uploadImageName($_SESSION['username'],$imageName);
            // test echo the image name
            // echo "Image uploaded successfully. Image name: $imageName";
            header("Location: ../settingPage.php");
        } else {
            echo $_FILES["image"]["tmp_name"] . "<br />";
            echo $uploadPath . "<br />";
            echo "Error uploading the image.";
        }
    } else {
        echo "Please select an image.";
    }
}
?>
