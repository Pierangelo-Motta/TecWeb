<?php

session_start();

if (!($_SESSION['loggedin'] === true)) {
    //user is not logged in go to login page
    header("Location: index.html");
}


// session_start();
// if (!($_SESSION['loggedin'] === true)) {
//     header("Location: index.html");
// }

// require_once('include/model/uploadImage.php'); //per gestire il caricamento della foto
// require_once('include/model/insertOnDB.php'); //per gestire la query di INSERT INTO
// require_once("include/model/selectors.php");

// //tag name del campo input per la foto
// $imgInterestedName = "imgPrevInputName";

// //gestisco il passaggio dei valori testuali tra un POST e l'altro
// $nomeLibroName = "nomeLibro";
// $nomeLibroNameValue = isset($_POST[$nomeLibroName]) ? $_POST[$nomeLibroName] : "";
// $citazioneName = "citazione";
// $citazioneNameValue = isset($_POST[$citazioneName]) ? $_POST[$citazioneName] : "";
// $pensieroName = "pensiero";
// $pensieroNameValue = isset($_POST[$pensieroName]) ? $_POST[$pensieroName] : "";
// $tagsAreaName = "tagsArea";
// $tagsAreaNameValue = isset($_POST[$tagsAreaName]) ? $_POST[$tagsAreaName] : "";



// if(isPresentImg($imgInterestedName)){
//     //gestisci caricamento della foto nella cartella tmp
//     updateImg('post', $imgInterestedName);
// }

// // print_r($_POST);

// //vecchio strcmp($_POST["sB"], "ok"): ho fatto in modo che sB valesse:
// //1 se si vuole condividere
// //0 se si vuole tornare indietro
// if (isset($_POST["sB"])) {

//     $parsed = intval($_POST["sB"]);
//     //echo "-->" . $parsed;
//     if($parsed == 1){
//         $userIDtmp = $_SESSION["id"]; //chi
//         $date = date("Y-m-d H:i:s", time()); //quando
        
//         /////////get name of photo
//         $dirPath = "images/post/tmp";
//         $files = glob($dirPath . "/" . $_SESSION["username"]. "*");
//         $actImgName = "";
//         $newImgName = "";

//         foreach ($files as $file) {
//             $actImgName = $file;
//         }

//         // TODO : tanto ce n'è solo 1, ma si può migliorare?

//         // echo("<br>");
//         // echo ("newPost.actImgName: " . $actImgName);
//         // echo("<br>");

//         if(!empty($actImgName)){ 
//             $newImgName = savePostedPhoto($actImgName, $_SESSION["username"]);
//             // echo("<br>");
//             //echo ("newImg: " . $newImgName);
//             // echo("<br>");
            
//         } 
//         // else {
//         //     echo "ERR: post non avvenuto con successo";
//         // }

//         // TODO SOLVED l'ultimo 0 deve essere convertito in un id del libro!!
//         createNewPost($userIDtmp, $date, $citazioneNameValue, $newImgName, $pensieroNameValue, getLibroIdFromLibroWhereTitle($nomeLibroNameValue)); 

//         ////////////   

//         //////// creazione tags
        
//         $tags = explode(" ", $tagsAreaNameValue);
//         $tagIndex = array();
//         // print_r($tags);
        
//         foreach($tags as $t){
//             // echo "<br>";
//             // echo $t;
//             $tmp = checkIfTagExists($t);
//             // echo $tmp;
//             if ($tmp < 0){
//                 createNewTag($t);
//                 $tmp = checkIfTagExists($t);
//             }
//             array_push($tagIndex, $tmp);
//         }
        
//         $ntI = array_unique($tagIndex);
//         // print_r($tagIndex);

//         foreach($ntI as $ti){
//             embedTagPost($ti, $userIDtmp, $date);
//         }
//         //////////////

    
//     } else {
//         print_r($_POST);
//         $dirPath = "images/post/tmp";
//         $files = glob($dirPath . "/" . $_SESSION["username"]. "*");
//         foreach ($files as $file) {
//             if (is_file($file)) {
//                 unlink($file);
//             }
//         }
//     }
//     header("Location: profilePage.php");
    
// } 


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
    <link rel="stylesheet" type="text/css" href="css/commentsStyle.css">
    <link rel="stylesheet" type="text/css" href="css/landingPage.css">
    

    <link rel="icon" href="images/favicon_io/favicon.ico">
  

</head>
<body>
    <?php require('navbarSelect.php'); ?>
    
    <div class="d-flex">

        <div class="col-1"></div>
        
        <div id="allContainer" class="col-10 d-md-flex">

            <section id="postPart" class="col-12 col-md-6">
                <!-- TODO: inserirePostEstratto... GET? -->
                <p class="tmpText"> ciao </p>
            </section>

            <section id="commentPart" class="col-12 col-md-6">
                <h2> Il tuo commento: </h2>
                <form action="" method="post">
                    <div class="d-flex w-100" id="userCommentControls">
                        <!-- <div class="flex-fill"> solo per far andare il flex fill che tanto non vaaaaaaaaaaa - -->
                        <button id="retBut" class="flex-fill btn btn-secondary" type="button" data-prevLink="landingPage.php">Indietro</button>    
                        <!-- </div> -->
                        
                        <div class="flex-fill riempitivo"></div>

                        <!-- <div class="flex-fill"> -->
                        <button class="flex-fill btn btn-primary" type="submit">Condividi!</button>
                        <!-- </div> -->
                    </div>

                    <textarea class="form-control" 
                            id="riflessioneCurrentUser" 
                            name="riflession"
                            rows="10" 
                            cols="100" 
                            placeholder="...Sto pensando a..."></textarea>
                    <label for="riflessioneCurrentUser" class="notDisplay">Spazio rimasto per la tua riflessione: xxx </label>
                </form>

                <h2 class="subTitle"> Gli altri utenti: </h2>
                <div id="commentContainer">
                    <div class="comment">
                        <img alt="#" class="userCommentedImg" src="images/userLogo.png"/> <p class="titleOfComment">Jacopo<p>
                        <p class="commentText">WOW CHE FIKOOOO<p>
                    </div>
                    <div class="comment">
                        <img alt="#" class="userCommentedImg" src="images/userLogo.png"/> <p class="titleOfComment">Jacopo<p>
                        <p class="commentText">WOW CHE FIKOOOO<p>
                    </div>
                    <div class="comment">
                        <img alt="#" class="userCommentedImg" src="images/userLogo.png"/> <p class="titleOfComment">Jacopo<p>
                        <p class="commentText">WOW CHE FIKOOOO<p>
                    </div>
                    <div class="comment">
                        <img alt="#" class="userCommentedImg" src="images/userLogo.png"/> <p class="titleOfComment">Jacopo<p>
                        <p class="commentText">WOW CHE FIKOOOO<p>
                    </div>
                    <div class="comment">
                        <img alt="#" class="userCommentedImg" src="images/userLogo.png"/> <p class="titleOfComment">Jacopo<p>
                        <p class="commentText">WOW CHE FIKOOOO<p>
                    </div>

                    <div class="comment">
                        <img alt="#" class="userCommentedImg" src="images/userLogo.png"/> <p class="titleOfComment">Jacopo<p>
                        <p class="commentText">WOW CHE FIKOOOO<p>
                    </div>

                    <div class="comment">
                        <img alt="#" class="userCommentedImg" src="images/userLogo.png"/> <p class="titleOfComment">Jacopo<p>
                        <p class="commentText">WOW CHE FIKOOOO<p>
                    </div>


                </div>

            </section>


        </div>


        <div class="col-1"></div>

    </div>




    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous">
    </script>

    <script src="javascript/commentAnimation.js"></script>

    
    <!-- <script src="javascript/addNewPost.js"></script> -->
    <!-- <script src="javascript/addNewPost.js"></script> -->
    <!-- <script src="javascript/newMedAJPAX.js"></script> -->
</body>
</html>
