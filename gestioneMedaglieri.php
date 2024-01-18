<?php
session_start();
require_once 'include/login.model.php';
require_once 'include/config.php';
require_once 'include/medaglieri.php';

if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    // Utente non autenticato, reindirizza alla pagina di login
    header("Location: index.html");
    exit();
}

if(isset($_POST['aggiungiMedagliere'])){
    unset($_POST['aggiungiMedagliere']);
}

?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medaglieri</title>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/landingPage.css">
    <!-- DataTables JS -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js">
    </script>
</head>

<body>
    <?php require('navbarSelect.php'); ?>

    <div class="row">
        <div class="col-md-12 text-center m-4">
            <h1>Medaglieri</h1>
        </div>
    </div>
    <?php
    if (!isUserAdmin($_SESSION['username'])) {
    // Utente non admin
        die("Per accedede alla pagina occorre loggarsi come utente amministratore!");
        exit();
    }
    ?>

    <main class="container">
        <!-- parte alta -->
        <!-- <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-4  text-center">
                <h2>Medaglieri</h2>
            </div>
            <div class="col-md-4  text-center">
                <h2>Libri</h2>
            </div>
            <div class="col-md-2"></div>
        </div> -->

        <!-- pulsante per aggiungere medaglieri -->
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-4 text-center">
                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal"
                    data-bs-target="#addMedagliere">
                    Aggiungi un nuovo Medagliere
                </button>
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-2"></div>
        </div>

        <!-- Modal aggiungi Medagliere -->
        <div class="modal fade" id="addMedagliere" tabindex="-1" aria-labelledby="modalTitle" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <p class="modal-title" id="modalTitle">Aggiungi Medagliere</p>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post" action="">
                        <div class="modal-body">
                            <input type="text" placeholder="Titolo" name="titolo" class="form-control m-1" required />
                            <input type="text" placeholder="Descrizione" name="descrizione" class="form-control m-1" />
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
                            <input type="submit" class="btn btn-primary" name="aggiungiMedagliere" value="Aggiungi" />
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- parte centrale medaglieri-->

        <div class="container">
            <div class="row">
                <!-- left column -->
                <div class="col-md-2"></div>
                <!-- medaglieri dropdown menu -->
                <div class="col-md-4 justify-content-center">
                    <div class="dropdown">
                        <button type="button" id="dropdownButton" class="btn btn-primary dropdown-toggle"
                            data-bs-toggle="dropdown">
                            Medaglieri
                        </button>
                        <?php $medaglieriResult = $medaglieri->getmedaglieri();?>
                        <ul class="dropdown-menu" id="dropdownMenu">
                            <?php foreach($medaglieriResult as $medagliere): ?>
                            <li>
                                <a class="dropdown-item" href="#" data="
                                    <?php echo "Titolo: " . $medagliere['titolo'];
                                    echo "\n\n";   
                                    echo "Descrizione: " .  $medagliere['descrizione']; ?>">
                                    <?php echo $medagliere["titolo"] ?>
                                </a>
                            </li>
                            <?php endforeach; ?>
                        </ul>

                        <div class="card">
                            <div class="card-body">
                                <div id="selectedItemText"></div>
                                <div id="selectedItemDescription"></div>
                                <p></p>
                                <div id="selectedItemDescription">Libri</div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- libri -->
                <div class="col-md-4"></div>
                <!-- right column -->
                <div class="col-md-2"></div>

                <!-- parte centrale libri -->

                <!-- parte finale -->

            </div>
        </div>




    </main>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <script src="javascript/gestioneMedaglieri.js"></script>


</body>

</html>