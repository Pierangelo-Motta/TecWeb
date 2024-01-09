<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Check if a file is selected
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {

        // Define the folder where the uploaded images will be saved
        $uploadFolder = "images/users/";

        // Generate a unique name for the uploaded image
        $imageName = uniqid() . "_" . $_FILES["image"]["name"];

        // Set the path for the uploaded image
        $uploadPath = $uploadFolder . $imageName;

        // Move the uploaded file to the specified folder
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $uploadPath)) {

            // Image upload successful; you can now save $imageName to the database
            // Add your database code here

            // For demonstration purposes, we'll just echo the image name
            echo "Image uploaded successfully. Image name: $imageName";
        } else {
            echo "Error uploading the image.";
        }
    } else {
        echo "Please select an image.";
    }
}
?>
