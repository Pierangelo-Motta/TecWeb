<?php
require_once('include/login.model.php');

function isPresentImg(string $nameInputImg){
    return isset($_FILES[$nameInputImg]) && $_FILES[$nameInputImg]["error"] == 0;
}

//NOTA BENE: questa funzione ha solo lo scopo di spostare l'immagine appena caricata in una directory preposta

//NOTA BENE: in nameInputImg bisogna mettere il name del campo!
//$where indirizzo preciso a partire dalla root
//$newImageName eventuale nuovo nome dell'immagine, mettere "" altrimenti
function updateOnFileSystem(string $where, string $nameInputImg, string $newImgName) {
    
    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        // Check if a file is selected
        if (isset($_FILES[$nameInputImg]) && $_FILES[$nameInputImg]["error"] == 0) {

            ///erasing old photo : ci pensa la chiamante

            // Get the absolute path to the current directory
            $currentDirectory = __DIR__;
            $backDirs = '/../../'; //TODO da porre attenzione se questo file viene spostato!!

            // Construct the full path for the destination directory
            $uploadDirectory = $currentDirectory . $backDirs . $where;

            //creare una cartella se non esiste. Anche questo ci pensa la chiamante

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
            $destinationPath = $uploadDirectory . $imageName;


            // Move the uploaded file to the specified folder
            if (!move_uploaded_file($sourcePath, $destinationPath)) {
                //debug prints: si attivano se non va a buon fine la funzione nell'if (responsabile del salvataggio)
                echo $_FILES[$nameInputImg]["tmp_name"] . "<br />"; 
                echo $uploadDirectory . "<br />";
                echo "Error uploading the image.";
            }

        } else {
            echo "Please select an image.";
        }
    }
}

//$where è un string value che serve per astrarre il vero percorso
//$nameInputImg invece è l'attributo "name" del campo input da considerare
//      che verrà aggiunto in $_POST
function updateImg(string $where, string $nameInputImg) {

    $userNickname = $_SESSION["username"];
    
    switch ($where) {
        case 'post':
            $imgName = $userNickname;
            updateOnFileSystem("images/post/tmp/", $nameInputImg, $imgName);
            break;
    }

}


// $a = date("Y-m-d H:i:s", time());
// // echo $a . "<br>";
// $b = str_replace(" ","__",$a);
// $b = str_replace(":","_",$b);
// $b = str_replace("-","_",$b);
// // echo $b;
// $imgName = $userNickname . "__" . $b;

// $dirPath = "images/post/tmp";
// $files = glob($dirPath . "/" . $_SESSION["username"]. "*");
// foreach ($files as $file) {
//     if (is_file($file)) {
//         unlink($file);
//     }
// }
///

//creazione della cartella
// if (!is_dir($uploadDirectory)){
//     mkdir($uploadDirectory);
// }

?>
