<?php

session_start();
if (!($_SESSION['loggedin'] === true)) {
    //user is not logged in go to login page
    header("Location: index.html");
}

require_once('include/uploadImage.php'); //per gestire il caricamento della foto
require_once('include/insertOnDB.php'); //per gestire la query di INSERT INTO
require("include/selectors.php");

$basicAmount = 10;
$amountLoading = isset($_POST["amountLoad"]) ? $_POST["amountLoad"] : 0;
$amountForLoad = 5;
$toLoad = $basicAmount + ($amountLoading * $amountForLoad);


function createOneMed($medToPrint, $indexToConsider){

    $toAdd = "Med" . $indexToConsider;
    $infos = getMedInfo($medToPrint[$indexToConsider])[0];
    // print_r($infos);

    $titleMed = $infos["titolo"];
    $imgToAdd = "medagliaFacile.png";
    $descMed = $infos["descrizione"];
    $books = "<li>A</li><li>A</li><li>A</li>";

    $buttonText = "Sfidami!"; //TODO o reclamami!!!
    $buttonValue = $infos["id"];

    $complete = "<div class=\"card medContainer\">" .
                    "<div class=\"card-body\" id=\"" . $toAdd . "\">" .
                        "<h1 class=\"card-text titleMed\">" . $titleMed . "</h1>" .
                        "<div class=\"allMedInfo d-flex\">" . 
                            "<div class=\"titlecontainer\" id=\"titlecontainerMed1\">" . 
                            
                            "<img " .
                                "src=\"images/" . $imgToAdd . "\" " .
                                //"alt=""
                                "class=\"rounded float-left imgmedagliere\" " .
                                "id=\"imgmedagliere" . $toAdd . "\" " .
                                "/>" .
                        "</div>" .


                        "<div class=\"infocontainer\" id=\"infocontainer" . $toAdd . "\">" . 
                            "<p class=\"descrzionemed\">" . $descMed . "</p>" . 
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
    return $complete;
    // print_r($medToPrint);
}


$userIdToConsider = $_SESSION["id"];

// $challengedMeds = getMedsChallengedByUserId($userIdToConsider);
// $allallMeds = getAllMeds();
// $remainMedIdx = array_diff($allallMeds, $challengedMeds);

$medToPrint = getMedThatUserNotChallenge($userIdToConsider);

//createOneMed();
// print_r($medToPrint);


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
  
</head>

<body>
    <?php require('navbarSelect.php'); ?>
    
    <section class="d-flex">
        <div class="col-1"></div>

        <div class="col-10" id="newMedaglieri">
        <form id="challengeNewMed" 
            class="form-group" 
            action="newMedagliere.php" 
            method="post" 
            enctype="multipart/form-data">


            <?php
            $upperbound = min(array($toLoad, sizeof($medToPrint))); 
            for ($i=0; $i < $upperbound; $i++) { 
                echo createOneMed($medToPrint, $i);
            } ?>

        
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

</body>

</html>
