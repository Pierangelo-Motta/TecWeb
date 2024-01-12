<?php

session_start();
if (!($_SESSION['loggedin'] === true)) {
    //user is not logged in go to login page
    header("Location: index.html");
}

require_once('include/uploadImage.php'); //per gestire il caricamento della foto
require_once('include/insertOnDB.php'); //per gestire la query di INSERT INTO


//tag name del campo input per la foto
$imgInterestedName = "imgPrevInputName";


//gestisco il passaggio dei valori testuali tra un post e l'altro
$nomeLibroName = "nomeLibro";
$nomeLibroNameValue = isset($_POST[$nomeLibroName]) ? $_POST[$nomeLibroName] : "";
$citazioneName = "citazione";
$citazioneNameValue = isset($_POST[$citazioneName]) ? $_POST[$citazioneName] : "";
$pensieroName = "pensiero";
$pensieroNameValue = isset($_POST[$pensieroName]) ? $_POST[$pensieroName] : "";

// print_r($_FILES);


if(isPresentImg($imgInterestedName)){
    //gestisci caricamento della foto nella cartella tmp
    updateImg('post', $imgInterestedName);
} 
// else {
//     // cancella "tutte le foto" (quelle dell'utente) attualmente presenti
//     $dirPath = "images/post/tmp";
//     $files = glob($dirPath . "/" . $_SESSION["username"]. "*");
//     foreach ($files as $file) {
//         if (is_file($file)) {
//             unlink($file);
//         }
//     }
// }
// else {
//     //foto eliminata: resetta tmp
//     $dirPath = "images/post/tmp";
//     $files = glob($dirPath . "/" . $_SESSION["username"]. "*");
//     foreach ($files as $file) {
//         unlink($file);
//     }
// }


if (isset($_POST["sB"]) && strcmp($_POST["sB"], "ok") == 0){

    $userIDtmp = $_SESSION["id"]; //chi
    $date = date("Y-m-d H:i:s", time()); //quando
    
    /////////get name of photo
    $dirPath = "images/post/tmp";
    $files = glob($dirPath . "/" . $_SESSION["username"]. "*");
    $actImgName = "";
    $newImgName = "";

    foreach ($files as $file) {
        $actImgName = $file;
    }

    // TODO : tanto ce n'è solo 1, ma si può migliorare?

    // echo("<br>");
    // echo ("newPost.actImgName: " . $actImgName);
    // echo("<br>");

    if(strcmp($actImgName, "") != 0){ 
        $newImgName = savePostedPhoto($actImgName, $_SESSION["username"]);
    }

    ////////////


    // echo("<br>");
    //echo ("newImg: " . $newImgName);
    // echo("<br>");
    
    // TODO l'ultimo 0 deve essere convertito in un id del libro!!
    createNewPost($userIDtmp, $date, $citazioneNameValue, $newImgName, $pensieroNameValue, 0); 
    
    
    header("Location: profilePage.php");
} 

// print_r($_FILES);
// echo "    " . isPresentImg("imgPrev");


?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New post</title>


    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- <link rel="stylesheet" type="text/css" href="css/JPfirstAttemp.css"> -->
    <link rel="stylesheet" type="text/css" href="css/JPfirstAttemp2.css">
    <link rel="stylesheet" type="text/css" href="css/landingPage.css">
  

</head>
<body>
  <?php require('navbarSelect.php'); ?>

  <main class="d-flex">
        <div class="col-1"></div>

        <div id="mainCont" class="col-10">
            <h1>Crea un nuovo post!</h1>
            <form id="newPostForm" class="form-group" action="newPost.php" method="post" enctype="multipart/form-data">
                    
                    <div class="col-md-6 col-12" id="newPostForm_pt1">

                        <label for="nomeLibro">Nome libro: </label>
                        <input type="text" 
                            id="nomeLibro" 
                            name=<?php echo "'".$nomeLibroName."'"?>
                            value=<?php echo "'".$nomeLibroNameValue."'"?>>
                        <br/>

                        <label for="citazioneText"></label>
                        <textarea class="form-control" 
                            id="citazioneText" 
                            name=<?php echo "'".$citazioneName."'"?>
                            rows="10" 
                            cols="100" 
                            placeholder="Inserisci qui la citazione"><?php echo "".$citazioneNameValue.""?></textarea>

                        <label for="pensieroText"></label>
                        <textarea class="form-control" 
                            id="pensieroText" 
                            name=<?php echo "'".$pensieroName."'"?>
                            rows="10" 
                            cols="100" 
                            placeholder="Inserisci qui il tuo pensiero"><?php echo "".$pensieroNameValue.""?></textarea>

                        <!-- <label for="html">Nome libro</label> -->
                        <!-- <textarea id="citazioneText" name="citazione" rows="10" cols="100" placeholder="Inserisci qui la citazione"></textarea>
                        <textarea id="pensieroText" name="pensiero" rows="10" cols="100" placeholder="Inserisci qui il tuo pensiero"></textarea> -->
                    </div>

                    <!-- <div class="col-1"></div> -->

                    <div class="col-md-6 col-12" id="newPostForm_pt2">
                        <p>Inserisci qui sotto una foto:</p>
                        <div id="imgPrevDiv">
                            <label id="imgLabel" for="imgPrevInput"> 
                                <img id="imgPrev" 
                                    src = <?php 
                                        if (!isPresentImg($imgInterestedName)){
                                            echo "images/caricaFoto.png";
                                        } else {
                                            echo "images/post/tmp/" . $_FILES[$imgInterestedName]["name"];
                                        }?>
                                    alt="Carica la foto" /> 
                            </label>
                            <input type="file" id="imgPrevInput" name="imgPrevInputName" accept="image/png, image/jpeg" />
                        </div>
                        <div id="imgPrevMods">
                            <button type="button" id="imgRem">delete</button>
                        </div>
                    </div>

                <!-- </div> -->
            </form>

            <footer>
                <p id="accessibilityMessage">Rendi il contenuto del tuo pensiero accessibile a tutti! <a href="#">Per più informazioni</a></p>

                <button class="btn btn-secondary" type="button" id="test">Indietro</button>
                <button class="btn btn-secondary" 
                    form="newPostForm" 
                    type="submit" 
                    id="shareButton"
                    name="sB"
                    value="ok">Condividi</button>
            </footer>
        </div>

        <div class="col-1"></div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous">
    </script>

    <!-- <script src="add_new_post.js" type="text/javascript"></script> -->
    <script src="add_new_post.js"></script>

    <!-- <script type="text/javascript">
    document.getElementById("test").onclick = function () {
        location.href = "profilePage.php";
    };
    </script> -->


</body>
</html>
