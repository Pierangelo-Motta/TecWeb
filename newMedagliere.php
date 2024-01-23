<?php

session_start();
if (!($_SESSION['loggedin'] === true)) {
    //user is not logged in go to login page
    header("Location: index.html");
}

$res = isset($_POST["searchingMed"]) ? $_POST["searchingMed"] : "";

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
  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous">
    </script>
    <!-- <script type="module" src="javascript/ReloaderPage.js"></script> -->

</head>

<body>
    <?php require('navbarSelect.php'); 
        //if ($somethingNew) : //ci pensa js
    ?>
    
    <section id="cercaMed" class="d-flex">
        <div class="col-1"></div>
        <div class="col-10">
            <div class="container-fluid float-right">
                <form class="d-inline-flex" action="newMedagliere.php" method="post">
                    <label id="labelSearchingInput">Ricerca nome medagliere:</label>
                    <input name="searchingMed" 
                        class="form-control me-2 float-right" 
                        type="search" 
                        placeholder="Search" 
                        aria-label="Search"
                        id="tmpInputSeachingString"
                        value="<?php echo $res; ?>"/>
                    <!-- <?php //echo $searchingMedStr; ?> 
                        <button class="btn btn-primary float-right" type="submit">Cerca Medaglione</button> -->
                </form>
            </div>
        </div>
        <div class="col-1"></div>
    </section>

    <section class="d-flex" data-userId="<?php echo $_SESSION["id"];?>">
        <div class="col-1"></div>


        <div class="col-10" id="newMedaglieri">
        
        </div>


        <div class="col-1"></div>
    </section>


    <section class="d-flex">
        <div class="col-1"></div>

        <div class="col-10">
            <div id="moreRes" class="d-flex float-right justify-content-end">
                    <button id="loadMore" 
                        class="btn btn-secondary float-right" 
                        
                        type="button" 
                        name="amountLoad" 
                        value="<?php //echo $nextValue ?>"> Mostra di più <!-- form="challengeNewMed" -->
                    </button>
            </div>
        </div>
        
        <div class="col-1"></div>
    </section>

    <footer class="col-12">
        <button id="retBut" type="button" class="btn btn-primary">Indietro</button>
    </footer>


    <script src="javascript/newMedagliereAnimations.js"></script>
    <script src="javascript/newMedAJPAX.js"></script>
</body>
</html>
