<?php

session_start();
if (!($_SESSION['loggedin'] === true)) {
    //user is not logged in go to login page
    header("Location: index.html");
}

require_once('include/model/uploadImage.php'); //per gestire il caricamento della foto
require_once('include/model/insertOnDB.php'); //per gestire la query di INSERT INTO
require("include/model/selectors.php");

require_once("include/view/formattators.php");


$searchingMedStr = isset($_POST["searchingMed"]) ? $_POST["searchingMed"] : "";
$basicAmount = 10;

$amountLoading = isset($_GET["amountLoad"]) ? $_GET["amountLoad"] : 0;
$nextValue = $amountLoading + 1;
$amountForLoad = 1;
$toLoad = $basicAmount + ($amountLoading * $amountForLoad);

function getCorrectImg($amountLeastBooks){
    $imgName = "";
    $altImg = "";
    $limits = array(5,15);
    $category = 0;
    while ($amountLeastBooks > 0 && $category < sizeof($limits)){
        $delta = $limits[$category];
        if ($category > 0) {
            $delta = $delta - $limits[$category-1];
        }

        $amountLeastBooks = $amountLeastBooks - $delta;

        if ($amountLeastBooks > 0) {
            $category = $category + 1;
        }
    }

    //magari implementare ricerca binaria?
    switch ($category){
        case 0:
            $imgName = "medagliaFacile.png";
            $altImg = "Ce l'hai quasi fatta!";
            break;
        case 1:
            $imgName = "medagliaMedia.png";
            $altImg = "Non manca troppo dai...";
            break;
        case 2:
            $imgName = "medagliaDifficile.png";
            $altImg = "Meglio se guardi altrove!";
            break;
        default:
            $imgName = "err.png";
            $altImg = "err.png";
            break;
    }
    return array($imgName, $altImg);
    
}

function createOneMed($medToPrint, $indexToConsider, $libriLetti, $who){

    $toAdd = "Med" . $indexToConsider;
    $infos = getMedInfo($medToPrint[$indexToConsider])[0];

    $libriInMedagliere = getLibroEAutoreByMedagliereId($medToPrint[$indexToConsider]);
    // echo "<br>";
    // echo $medToPrint[$indexToConsider];
    // echo "<br>";
    // print_r($libriInMedagliere);
    $medBookIndex = array();
    foreach (array_column($libriInMedagliere,"titolo") as $titolo) {
        array_push($medBookIndex,getLibroIdFromLibroWhereTitle($titolo));
    }
    // echo "<br>";
    // echo print_r($medBookIndex);
    // echo "<br>";
    $remainsBook = array_diff($medBookIndex, $libriLetti);
    $canReclame = empty($remainsBook);
    //echo $medToPrint[$indexToConsider];
    //print_r($libriInMedagliere);

    $titleMed = $infos["titolo"];
    
    $descMed = $infos["descrizione"];

    // print_r($libriInMedagliere);
    $books = obtainList($libriInMedagliere, $who);

    $buttonText = "Sfidami!";
    if($canReclame){
        $buttonText = "Reclamami!";
    }
    $buttonValue = $infos["id"];

    $decorativeInfos = getCorrectImg(sizeof($remainsBook));
    // print_r($decorativeInfos);
    $imgToAdd = $decorativeInfos[0];
    $altImg = $decorativeInfos[1];

    $complete = "<div class=\"card medContainer\">" .
                    "<div class=\"card-body\" id=\"" . $toAdd . "\">" .
                        "<h1 class=\"card-text titleMed\">" . $titleMed . "</h1>" .

                        "<div class=\"allMedInfo d-md-flex\">" . 
                            "<div class=\"mx-auto titlecontainer order-md-1\" id=\"titlecontainer" . $toAdd . "\">" . 
                                //d-flex justify-content-center 
                                "<img " .
                                    "src=\"images/medagliereNewIcons/" . $imgToAdd . "\" " .
                                    "alt=\"" . $altImg . "\" " .
                                    "class=\"rounded text-center imgmedagliere mx-auto\" " .
                                    "id=\"imgmedagliere" . $toAdd . "\" " .
                                    "/>" .

                            "</div>" .

                            "<div class=\"infocontainer order-md-0\" id=\"infocontainer" . $toAdd . "\">" . 
                                "<p class=\"descrizioneMed\">" . $descMed . "</p>" . 
                                "<p class=\"messaggio\"> Per completare questo medagliere è necessario:</p>" .
                                "<ol>" . 
                                    $books .
                                "</ol>" . 
                            "</div>" .

                        "</div>" .

                        "<footer>" . 
                            "<button class=\"btn btn-secondary\" " . 
                                "form=\"challengeNewMed\" " . 
                                "type=\"submit\" " .
                                "name=\"submitButton\" ".
                                "value=\"" . $buttonValue . "\">" . $buttonText . "</button>" .
                        "</footer>" .

                    "</div>" .

                "</div>";
    return $complete; //valuta se ritornare un array medagliere-da-stampare / quantità libri mancante per poi sortarlo
}


$userIdToConsider = $_SESSION["id"];
// echo $userIdToConsider;
$libriLetti = getLibriLettiDaUserId($userIdToConsider);
//print_r($libriLetti);
// $challengedMeds = getMedsChallengedByUserId($userIdToConsider);
// $allallMeds = getAllMeds();
// $remainMedIdx = array_diff($allallMeds, $challengedMeds);

$medToPrint = getMedThatUserNotChallenge($userIdToConsider, $searchingMedStr);

//createOneMed();
// print_r($medToPrint);

$_POST["amount"] = $toLoad;
// print_r($_POST);

if(isset($_POST["submitButton"])) {
    $startURL = $_SERVER['REQUEST_URI'];
    $substr = "#Med";
    $link = "";
    if(str_contains($startURL, $substr)){
        $link = substr($startURL, 0, sizeof($startURL)-5);
    } else {
        $link = $startURL;
    }
    if(sizeof($medToPrint)!=1){
        $actIndex = array_search($_POST["submitButton"], $medToPrint);
        if ($actIndex == (sizeof($medToPrint)-1)){
            $actIndex = $actIndex-1;
        }
        $link .= $substr . $actIndex;
    }
    subscribeUserToMed($userIdToConsider, $_POST["submitButton"]);
    header("Location: " . $link);
}
//TODO si dovrebbe gestire il max di post da caricare, e il bottone di incremento

$showMoreMed = true;
$upperbound = sizeof($medToPrint); 
$somethingNew = sizeof(getMedThatUserNotChallenge($userIdToConsider, "")) > 0;

?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuovi medaglieri</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- <link rel="stylesheet" type="text/css" href="css/JPfirstAttemp.css"> -->
    <link rel="stylesheet" type="text/css" href="css/JPNewMed.css">
    <link rel="stylesheet" type="text/css" href="css/landingPage.css">

    <link rel="icon" href="images/favicon_io/favicon.ico">
  
</head>

<body>
    <?php require('navbarSelect.php'); 
    
    if ($somethingNew) :?>
    
    <section id="cercaMed" class="d-flex">
        <div class="col-1"></div>
        <div class="col-10">
            <div class="container-fluid float-right">
                <form class="d-inline-flex" action="newMedagliere.php" method="post">
                    <label>Ricerca nome medagliere:</label>
                    <input name="searchingMed" 
                        class="form-control me-2 float-right" 
                        type="search" 
                        placeholder="Search" 
                        aria-label="Search"
                        value="<?php echo $searchingMedStr; ?>" />
                    <!-- <button class="btn btn-primary float-right" type="submit">Cerca Medaglione</button> -->
                </form>
            </div>
        </div>
        <div class="col-1"></div>
    </section>

    <?php endif; ?>

    <section class="d-flex">
        <div class="col-1"></div>

        <div class="col-10" id="newMedaglieri">
        <form id="challengeNewMed" 
            class="form-group" 
            action="newMedagliere.php" 
            method="post" 
            enctype="multipart/form-data">


            <?php
            // $upperbound = min(array($toLoad, sizeof($medToPrint))); 
            if($upperbound > 0){
                for ($i=0; $i < $toLoad; $i++) { 
                    if ($i < $upperbound){
                        echo createOneMed($medToPrint, $i, $libriLetti, $userIdToConsider);
                    } else {
                        $i += $toLoad;
                        $showMoreMed = false;
                    }
                    
                }
            } else if($somethingNew) {
                $showMoreMed = false;
                echo "<h3 class=\"noresults\"> Nessun medagliere contiene la stringa \"" . $searchingMedStr . "\"! </h3>";
            } else {
                echo "<h3 class=\"noresults\"> Niente di nuovo qui, torna la prossima volta! </h3>";
            }

            if ($showMoreMed && $somethingNew) : ?>
                <div id="moreRes" class="d-flex float-right justify-content-end">
                    <button id="loadMore" 
                        class="btn btn-secondary float-right" 
                        form="challengeNewMed"
                        type="button" 
                        name="amountLoad" 
                        value="<?php echo $nextValue ?>"> Mostra di più
                    </button>
                </div>
            <?php endif; ?>
        
        </form> 
        </div>

        

        <div class="col-1"></div>
    </section>

    <footer class="col-12">
        <button id="retBut" type="button" class="btn btn-primary">Indietro</button>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous">
    </script>
    <script src="javascript/newMedagliereAnimations.js"></script>
    <!-- <script type="module" src="javascript/ReloaderPage.js"></script> -->
</body>

</html>
