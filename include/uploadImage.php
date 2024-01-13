<?php
require_once('login.model.php');

function isPresentImg(string $nameInputImg){
    return isset($_FILES[$nameInputImg]) && $_FILES[$nameInputImg]["error"] == 0;
}

//NOTA BENE: in nameInputImg bisogna mettere il name del campo!
function updateOnFileSystem(string $where, string $nameInputImg, string $newImgName) {
    
    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        // Check if a file is selected
        if (isset($_FILES[$nameInputImg]) && $_FILES[$nameInputImg]["error"] == 0) {

            ///erasing old photo : ci pensa la chiamante
            // $dirPath = "images/post/tmp";
            // $files = glob($dirPath . "/" . $_SESSION["username"]. "*");
            // foreach ($files as $file) {
            //     if (is_file($file)) {
            //         unlink($file);
            //     }
            // }
            ///

            // Get the absolute path to the current directory
            $currentDirectory = __DIR__;

            // Construct the full path for the destination directory
            $uploadDirectory = $currentDirectory . '/../' . $where;

            //creare una cartella se non esiste, ma qui in realtà effettivamente non serve
            // if (!is_dir($uploadDirectory)){
            //     mkdir($uploadDirectory);
            // }

            $tmp1 = explode(".", $_FILES[$nameInputImg]["name"]);
            $extension = $tmp1[sizeof($tmp1)-1];

            // se non voglio dare un nuovo nome mantengo quello vecchio
            $imageName = strcmp($newImgName, "") == 0 ? $_FILES[$nameInputImg]["name"] : ($newImgName . "." . $extension);

            // Generate a unique name for the uploaded image
            $_FILES[$nameInputImg]["name"] = $imageName;
            
            // echo "<br>";
            // echo strcmp($newImgName, "");

            $sourcePath = $_FILES[$nameInputImg]["tmp_name"]; //getAtcPos;

            // Set the path for the uploaded image
            $destinationPath = $uploadDirectory . $imageName;//'C:/xampp/htdocs/TecWeb/images/users/' . $imageName;


            // Move the uploaded file to the specified folder TODO: tutta roba di debug
            if (move_uploaded_file($sourcePath, $destinationPath)) {

                // Image upload successful; save $imageName to the database
                //uploadImageName($_SESSION['username'], $imageName);

                // test echo the image name
                // echo "Image uploaded successfully. Image name: $imageName";
                //header("Location: ../settingPage.php");

            } else {
                echo $_FILES[$nameInputImg]["tmp_name"] . "<br />"; 
                echo $uploadDirectory . "<br />";
                echo "Error uploading the image.";
            }
        } else {
            echo "Please select an image.";
        }
    }
}

function updateImg(string $where, string $nameInputImg) {

    $userNickname = $_SESSION["username"];
    
    switch ($where) {
        case 'post':
            // $a = date("Y-m-d H:i:s", time());
            // // echo $a . "<br>";
            // $b = str_replace(" ","__",$a);
            // $b = str_replace(":","_",$b);
            // $b = str_replace("-","_",$b);
            // // echo $b;
            // $imgName = $userNickname . "__" . $b;
            $imgName = $userNickname;
            updateOnFileSystem("images/post/tmp/", $nameInputImg, $imgName);
            break;
    }

}



?>
