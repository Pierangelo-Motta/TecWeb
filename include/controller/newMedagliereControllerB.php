<?php

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