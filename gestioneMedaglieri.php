<?php
session_start();
require_once 'include/login.model.php';
require_once 'include/config.php';
require_once 'include/medaglieri.php';
require_once 'include/libri.php';

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
    <title>TecWeb - Gestione Medaglieri </title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medaglieri</title>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/landingPage.css">
    <link rel="stylesheet" type="text/css" href="css/gestioneMedaglieri.css">

    <!-- DataTables JS -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js">
    </script>
</head>

<body>
    <?php require('navbarSelect.php'); ?>

    <div class="row">
        <div class="col-md-12 text-center m-1">
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

        <!-- pulsante per aggiungere medaglieri -->
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-5 text-center">
                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal"
                    data-bs-target="#addMedagliere">
                    Aggiungi un nuovo Medagliere
                </button>
            </div>
            <div class="col-md-5"></div>
            <div class="col-md-1"></div>
        </div>

        <!-- Modal aggiungi Medagliere -->
        <div class="modal fade" id="addMedagliere" tabindex="-1" aria-labelledby="modalTitle" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <p class="modal-title" id="modalTitle">Aggiungi Medagliere</p>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post" action="#">
                        <div class="modal-body">
                            <input type="text" placeholder="Titolo" name="titolo" class="form-control m-1" required />
                            <input type="text" lang="" placeholder="Descrizione" name="descrizione" class="form-control m-1" />
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
                <div class="col-md-1"></div>
                <!-- medaglieri dropdown menu -->
                <div class="col-md-5 justify-content-center">
                    <div class="dropdown">
                        <button type="button" id="dropdownButton" class="btn btn-primary dropdown-toggle big"
                            data-bs-toggle="dropdown">
                            Medaglieri
                        </button>
                        <p></p>
                        <!-- FIXME: manca l'id del medagliere -->
                        <?php $medaglieriResult = $medaglieri->getmedaglieri();?>
                        <ul class="dropdown-menu" id="dropdownMenu">
                            <?php foreach($medaglieriResult as $medagliere): ?>
                            <li>
                                <p class="dropdown-item" id="medagliere-<?php echo $medagliere['id'];?>"
                                data-medagliereid="<?php echo $medagliere['id'];?>"
                                data-titolo="<?php echo $medagliere['titolo'];?>"
                                data-descrizione="<?php echo $medagliere['descrizione'];?>"
                                >
                                    <?php echo $medagliere["titolo"] ?>
                            </p>
                            </li>
                            <?php endforeach; ?>
                        </ul>

                        <!-- <form action="include/updateMedagliereDB.php" method="post"> -->
                        <form action="#" method="post">
                            <div class="card">
                                <div class="card-body">
                                    <p>Titolo</p>
                                    <input type="text" class="flexible-input titolo" id="selectedItemTitoloInput"
                                        name="selectedItemTitoloInput">


                                    <p>Descrizione</p>
                                    <!-- TODO: settare il linguaggio corretto -->
                                    <textarea lang="" class="flexible-input descrizione" rows="4" cols="50"
                                        id="selectedItemDescrizioneInput"
                                        name="selectedItemDescrizioneInput"></textarea>

                                </div>
                            </div>

                            <div class="card">
                                <div class="card-body">
                                    <p>Libri</p>
                                    <ul class="list-group" id="libriList">
                                        <?php //$libriInMedagliere = getLibriMedaglieri($medagliereId)?>
                                        <?php //foreach($libriInMedagliere as $libro){?>
                                        <!-- <li class="list-group-item"> -->
                                            <!-- reperire correttamente l'id del libro -->
                                            <!-- <button class="btn btn-danger btn-sm m-2 removebtn" id="btn_1">X</button> -->
                                            <!-- AAA -->
                                        <!-- </li> -->
                                        <!-- <li class="list-group-item"> -->
                                            <!-- <button class="btn btn-danger btn-sm m-2 removebtn" id="btn_2">X</button> -->
                                            <!-- BBB -->
                                            <?php //echo $libro['titolo'] ?>
                                        <!-- </li> -->
                                        <?php //}?>
                                    </ul>
                                </div>
                            </div>
                            <p></p>

                        </form>
                        <div class="text-center">
                        <input  class="btn btn-primary" id="salvaLibriInMedagliere" value="Salva Libri in Medagliere">
                        <input type="submit" class="btn btn-primary" value="Certifica Medagliere">
                        </div>

                    </div>
                </div>

                <!-- libri -->
                <div class="col-md-5 justify-content-center">
                    <div>
                        <p>Selezionare un libro per aggiungerlo al medagliere</p>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <table id="libriTable" class="table table-striped text-center">
                                    <thead>
                                        <tr>
                                            <th>Titolo</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $libriResult = $libri->getLibri();
                                            while ($row = mysqli_fetch_assoc($libriResult)) {?>
                                        <tr>
                                            <td id="libroid-<?php echo $row['id']?>"> <?php echo $row['titolo']; ?> </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                </div>
                <!-- right column -->
                <div class="col-md-1"></div>

                <!-- parte centrale libri -->

                <!-- parte finale -->

            </div>
        </div>




    </main>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <script src="javascript/gestioneMedaglieri.js"></script>
    <script src="javascript/gm.js"></script>
    <script src="javascript/libri.js"></script>


</body>

</html>
