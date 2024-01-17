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
                <div class="col-md-2"></div>
                <div class="col-md-4">
                    <table id="TabellaMedaglieri" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Titolo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $medaglieriResult = $medaglieri->getmedaglieri();
                            while ($row = mysqli_fetch_assoc($medaglieriResult)) {
                                echo "<tr class='medaglieri-row' data-description='" . $row['descrizione'] . "'>";
                                echo "<td>" . $row['titolo'] . "</td>";
                                // echo "<td>" . $row['descrizione'] . "</td>";
                                echo "</tr>";
                                ?>
                            <!-- <tr> -->
                            <!-- <td> <?php echo $row['titolo']; ?> </td> -->
                            <!-- <td>
                                    <a href='#' data-bs-toggle="modal"
                                    data-bs-target="#modal_modifica_libro_<?php echo $row['id']; ?>"
                                    title="Modifica libro">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path
                                    d="M0 13.622v2.5a.5.5 0 0 0 .5.5H3a.5.5 0 0 0 .5-.5V13h-3v.622zM15.854 1.146a1 1 0 0 0-1.415 0L12 3.586 12 7l3.854-3.854a1 1 0 0 0 0-1.415z" />
                                    <path fill-rule="evenodd"
                                    d="M1 0a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1H1zm12 4h3l-9 9H3V7h3l9-9v3z" />
                                </svg>
                            </a>
                        </td>
                        <td>
                            <a href='#' data-bs-toggle="modal"
                            data-bs-target="#modal_elimina_libro_<?php echo $row['id']; ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                            fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                            <path
                            d="M1 3h1v9H1V3zm2 0h10v9H3V3zm12-2h-3l-1-1h-4l-1 1H2v1h12V1zM5.5 12a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1zm3 0a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1zm3 0a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1z" />
                        </svg>
                    </a>
                </td> -->
                            <!-- </tr> -->
                            <!-- end while -->
                            <?php } ?>
                        </tbody>
                    </table>
                    <?php echo "<div id='descriptionContainer'></div>"?>


                    <div class="col-md-4"></div>
                    <div class="col-md-2"></div>
                </div>

                <!-- parte centrale libri -->

                <!-- parte finale -->







    </main>





    <script src="javascript/medaglieri.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <script>
    $(document).ready(function() {
        $('#TabellaMedaglieri').DataTable();
    });
    </script>

</body>

</html>