<?php

session_start();
if (!($_SESSION['loggedin'] === true)) {
    header("Location: index.php");
}

require_once('include/model/uploadImage.php'); //per gestire il caricamento della foto
require_once('include/model/insertOnDB.php'); //per gestire la query di INSERT INTO
require_once("include/model/selectors.php");

//tag name del campo input per la foto
$imgInterestedName = "imgPrevInputName";

//gestisco il passaggio dei valori testuali tra un POST e l'altro
$nomeLibroName = "nomeLibro";
$nomeLibroNameValue = isset($_POST[$nomeLibroName]) ? $_POST[$nomeLibroName] : "";
$citazioneName = "citazione";
$citazioneNameValue = isset($_POST[$citazioneName]) ? $_POST[$citazioneName] : "";
$pensieroName = "pensiero";
$pensieroNameValue = isset($_POST[$pensieroName]) ? $_POST[$pensieroName] : "";
$tagsAreaName = "tagsArea";
$tagsAreaNameValue = isset($_POST[$tagsAreaName]) ? $_POST[$tagsAreaName] : "";

if(empty($nomeLibroNameValue) &&
    empty($citazioneNameValue) &&
    empty($pensieroNameValue) &&
    empty($tagsAreaNameValue) ){
        $tmp = __DIR__;
        $remain = DIRECTORY_SEPARATOR . "images" . DIRECTORY_SEPARATOR . "post" . DIRECTORY_SEPARATOR . "tmp" . DIRECTORY_SEPARATOR;
        $myDir = $tmp . $remain;
        $who = $_SESSION["username"];
        foreach (glob($myDir . $who . "*.*") as $nomefile) {
            unlink($nomefile);
        }

}

if(isPresentImg($imgInterestedName)){
    //gestisci caricamento della foto nella cartella tmp
    updateImg('post', $imgInterestedName);
}

//vecchio strcmp($_POST["sB"], "ok"): ho fatto in modo che sB valesse:
//1 se si vuole condividere - 0 se si vuole tornare indietro
if (isset($_POST["sB"])) {
    $parsed = intval($_POST["sB"]);
    if($parsed == 1){
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

        if(!empty($actImgName)){
            $newImgName = savePostedPhoto($actImgName, $_SESSION["username"]);
        }

        createNewPost($userIDtmp, $date, $citazioneNameValue, $newImgName, $pensieroNameValue, getLibroIdFromLibroWhereTitle($nomeLibroNameValue));
        ////////////

        //////// creazione tags

        $tags = explode(" ", $tagsAreaNameValue);
        $tagIndex = array();

        foreach ($tags as $t) {
            $newT = trim($t);
            if (strlen($newT > 0)){
                $tmp = checkIfTagExists($t);
                if ($tmp < 0) {
                    createNewTag($t);
                    $tmp = checkIfTagExists($t);
                }
                array_push($tagIndex, $tmp);
            }
        }

        $ntI = array_unique($tagIndex);

        foreach ($ntI as $ti) {
            embedTagPost($ti, $userIDtmp, $date);
        }
        //////////////


    } else {
        //// error status
        print_r($_POST);
        $dirPath = "images/post/tmp";
        $files = glob($dirPath . "/" . $_SESSION["username"]. "*");
        foreach ($files as $file) {
            if (is_file($file)) {
                unlink($file);
            }
        }
    }
    //force return to profile page
    header("Location: profilePage.php");
}

?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TecWeb - New post</title>


    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="css/newPost.css">
    <link rel="stylesheet" type="text/css" href="css/landingPage.css">

    <link rel="icon" href="images/favicon_io/favicon.ico">


</head>
<body>
  <?php require('navbarSelect.php'); ?>

  <main class="d-flex">
        <div class="col-1"></div>

        <div id="mainCont" class="col-10">
            <h1>Crea un nuovo post!</h1>
            <form id="newPostForm" class="form-group" action="newPost.php" method="post" enctype="multipart/form-data">

                    <div class="col-md-6 col-12" id="newPostForm_pt1">

                        <label for="nomeLibroId"> Nome libro: </label>
                        <div id="acCont" class="my-1 my-md-0 autocomplete-container"> <!-- acCont -> autocompleteContainer -->
                            <input type="text"
                            class="form-control"
                            id="nomeLibroId"
                            name="<?php echo $nomeLibroName ?>"
                            value="<?php echo $nomeLibroNameValue ?>"
                            />
                            <div id="autocompleteBoooksResults" class="autocomplete-results"></div>
                        </div>

                        <label for="citazioneTextId" class="notDisplay">Citazione: </label>
                        <textarea class="my-1 my-md-0 form-control"
                            id="citazioneTextId"
                            name=<?php echo "'".$citazioneName."'"?>
                            rows="10"
                            cols="100"
                            placeholder="Inserisci qui la citazione"><?php echo "".$citazioneNameValue.""?></textarea>

                        <label for="pensieroTextId" class="notDisplay">Pensiero: </label>
                        <textarea class="my-1 my-md-0 form-control"
                            id="pensieroTextId"
                            name=<?php echo "'".$pensieroName."'"?>
                            rows="10"
                            cols="100"
                            placeholder="Inserisci qui il tuo pensiero"><?php echo "".$pensieroNameValue.""?></textarea>

                        <label for="tagsAreaId" class="notDisplay">Tags: </label>
                        <textarea class="my-1 my-md-0 form-control"
                            id="tagsAreaId"
                            name=<?php echo "'".$tagsAreaName."'"?>
                            rows="10"
                            cols="100"
                            placeholder="Via con i tags!"><?php echo "".$tagsAreaNameValue."" ?></textarea>

                    </div>

                    <div class="col-md-6 col-12" id="newPostForm_pt2">
                        <p class="my-1 my-md-0 align-bottom m-0 mt-2">Inserisci qui sotto una foto:</p>
                        <div id="imgPrevDiv">
                            <label id="imgLabel" for="imgPrevInput">
                                <img id="imgPrev"
                                    src="<?php
                                        if (!isPresentImg($imgInterestedName)){
                                            echo "images/caricaFoto.png";
                                        } else {
                                            echo "images/post/tmp/" . $_FILES[$imgInterestedName]["name"];
                                        }?>"
                                    alt="Carica la foto" />
                            </label>
                            <input type="file" id="imgPrevInput" name="imgPrevInputName" accept="image/png, image/jpeg" />
                        </div>
                        <div id="imgPrevMods" class="align-items-center mx-auto">
                            <small class="form-text text-muted blockDisplay mx-auto text-center">
                                Premi sulla foto per cambiarla.
                            </small><button class="blockDisplay mx-auto" type="button" data-actusername="<?= $_SESSION["username"] ?>" id="imgRem">
                                Elimina
                            </button>
                        </div>
                    </div>
            </form>

            <footer id="footerNewPost">
                <p id="accessibilityMessage">Rendi il contenuto del tuo pensiero accessibile a tutti! <a href=<?php echo "\"" . $linkForMoreInfos . "#acc\"" ?>> Per più informazioni</a></p>

                <button class="btn btn-secondary"
                    form="newPostForm"
                    type="submit"
                    id="retBut"
                    name="sB"
                    value="0">Indietro
                </button><button class="btn btn-secondary"
                    form="newPostForm"
                    type="submit"
                    id="shareButton"
                    name="sB"
                    value="1">Condividi</button>
            </footer>
        </div>

        <div class="col-1"></div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous">
    </script>

    <script src="javascript/addNewPost.js"></script>

</body>
</html>
