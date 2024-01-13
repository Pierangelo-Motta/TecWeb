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
    print_r($medToPrint);
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


            <div class="card medContainer"> 
            
                <div class="card-body" id="Med1">

                    <h1 class="card-text titleMed1" id="username"> Benvenuto! </h1>

                    <div class="allMedInfo d-flex">
                        <div class="titlecontainer" id="titlecontainerMed1">
                            <!-- <div id="textInfo" class=""> -->
                            <!-- </div> -->
                            <img
                                src="images/medagliaFacile.png"
                                alt=""
                                class="rounded float-left imgmedagliere"
                                id="imgmedagliereMed1"
                                />
                        </div>


                        <div class="infocontainer" id="infocontainerMed1">
                            <p class="descrzionemed">descdescdesc</p>
                            <p class="messaggio">Per completare questo medagliere è necessario:</p>
                            <ol>
                                <li>libro di autore</li>
                                <li>libro di autore</li>
                            </ol>
                        </div>
                    </div>

                    <footer>
                        <button class="btn btn-secondary" 
                            form="challengeNewMed" 
                            type="submit"
                            name="submitButton"
                            value="1"> Sfidami! </button>
                            <!-- Reclamami (se il medagliere in realtà è completo) -->
                            <!-- id="shareButton" -->
                    </footer>

                </div>

            </div>

            <div class="card medContainer"> 
            
                <div class="card-body" id="Med1">

                    <h1 class="card-text titleMed1" id="username"> Benvenuto! </h1>

                    <div class="allMedInfo d-flex">
                        <div class="titlecontainer" id="titlecontainerMed1">
                            <!-- <div id="textInfo" class=""> -->
                            <!-- </div> -->
                            <img
                                src="images/medagliaMedia.png"
                                alt=""
                                class="rounded float-left imgmedagliere"
                                id="imgmedagliereMed1"
                                />
                        </div>


                        <div class="infocontainer" id="infocontainerMed1">
                            <p class="descrzionemed">descdescdesc</p>
                            <p class="messaggio">Per completare questo medagliere è necessario:</p>
                            <ol>
                                <li>libro di autore</li>
                                <li>libro di autore</li>
                            </ol>
                        </div>
                    </div>

                    <footer>
                        <button class="btn btn-secondary" 
                            form="challengeNewMed" 
                            type="submit"
                            name="submitButton"
                            value="2"> Sfidami! </button>
                            <!-- Reclamami (se il medagliere in realtà è completo) -->
                            <!-- id="shareButton" -->
                    </footer>

                </div>

            </div>

            <div class="card medContainer"> 
            
                <div class="card-body" id="Med1">

                    <h1 class="card-text titleMed1" id="username"> Benvenuto! </h1>

                    <div class="allMedInfo d-flex">
                        <div class="titlecontainer" id="titlecontainerMed1">
                            <!-- <div id="textInfo" class=""> -->
                            <!-- </div> -->
                            <img
                                src="images/medagliaDifficile.png"
                                alt=""
                                class="rounded float-left imgmedagliere"
                                id="imgmedagliereMed1"
                                />
                        </div>


                        <div class="infocontainer" id="infocontainerMed1">
                            <p class="descrzionemed">descdescdesc</p>
                            <p class="messaggio">Per completare questo medagliere è necessario:</p>
                            <ol>
                                <li>libro di autore</li>
                                <li>libro di autore</li>
                            </ol>
                        </div>
                    </div>

                    <footer>
                        <button class="btn btn-secondary" 
                            form="challengeNewMed" 
                            type="submit"
                            name="submitButton"
                            value="3"> Sfidami! </button>
                            <!-- Reclamami (se il medagliere in realtà è completo) -->
                            <!-- id="shareButton" -->
                    </footer>

                </div>

            </div>
        
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
