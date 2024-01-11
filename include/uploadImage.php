<?php
require_once('login.model.php');



function isPresentImg(string $idImgInput){
    return isset($_FILES[$idImgInput]) && $_FILES[$idImgInput]["error"] == 0;
}

//NOTA BENE: in idImgInput bisogna mettere il name del campo!
function updateOnFileSystem(string $where, string $idImgInput, string $newImgName) {
    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        // Check if a file is selected
        if (isset($_FILES[$idImgInput]) && $_FILES[$idImgInput]["error"] == 0) {


            ///erasing old photo

            $dirPath = "images/post/tmp";
            $files = glob($dirPath . "/" . $_SESSION["username"]. "*");
            foreach ($files as $file) {
                if (is_file($file)) {
                    unlink($file);
                }
            }

            ///

            //echo "DAJE ROMA DAJEEEEEE";
            // Get the absolute path to the current directory
            $currentDirectory = __DIR__;

            // Construct the full path for the destination directory
            $uploadDirectory = $currentDirectory . '/../' . $where;

            //creare una cartella se non esiste, ma qui in realtà effettivamente non serve
            // if (!is_dir($uploadDirectory)){
            //     mkdir($uploadDirectory);
            // }

            $tmp1 = explode(".", $_FILES[$idImgInput]["name"]);
            $extension = $tmp1[sizeof($tmp1)-1];

            // se non voglio dare un nuovo nome mantengo quello vecchio
            $imageName = strcmp($newImgName, "") == 0 ? $_FILES[$idImgInput]["name"] : ($newImgName . "." . $extension);


            // Generate a unique name for the uploaded image
            $_FILES[$idImgInput]["name"] = $imageName;
            echo "<br>";
            echo strcmp($newImgName, "");
            $sourcePath = $_FILES[$idImgInput]["tmp_name"]; //getAtcPos;

            // Set the path for the uploaded image
            $destinationPath = $uploadDirectory . $imageName;//'C:/xampp/htdocs/TecWeb/images/users/' . $imageName;


            // Move the uploaded file to the specified folder
            if (move_uploaded_file($sourcePath, $destinationPath)) {

                // Image upload successful; save $imageName to the database
                //uploadImageName($_SESSION['username'], $imageName);

                // test echo the image name
                // echo "Image uploaded successfully. Image name: $imageName";
                //header("Location: ../settingPage.php");

            } else {
                echo $_FILES[$idImgInput]["tmp_name"] . "<br />";
                echo $uploadDirectory . "<br />";
                echo "Error uploading the image.";
            }
        } else {
            echo "Please select an image.";
        }
    }
}

function updateImg(string $where, string $idImgInput) {

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
            updateOnFileSystem("images/post/tmp/", $idImgInput, $imgName);
            break;
    }

}



?>
