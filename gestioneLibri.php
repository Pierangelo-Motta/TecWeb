<?php
session_start();

if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    // Utente non autenticato, reindirizza alla pagina di login
    header("Location: index.php");
    exit();
}

require_once 'include/config.php';
require_once 'include/libri.php';
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GestioneLibri</title>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/landingPage.css">
    <!-- DataTables JS -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
</head>

<body>
    <?php require('navbarSelect.php'); ?>

    <main class="container">
        <br />
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addbook">
                    Aggiungi un nuovo libro
                </button>
            </div>
            <div class="col-md-4"></div>
        </div>

        <!-- Modal aggiungi libro-->
        <div class="modal fade" id="addbook" tabindex="-1" aria-labelledby="modalTitle" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitle">Aggiungi libro</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post" action="#">
                        <div class="modal-body">
                            <label for="titolo">Titolo</label>
                            <input type="text" id="titolo" placeholder="Titolo" name="titolo" class="form-control" required />
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
                            <input type="submit" class="btn btn-primary" name="aggiungi_libro" value="Aggiungi" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--Fine modal aggiungi libro-->

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <table id="libriTable" class="table table-striped text-center">
                        <thead>
                            <tr>
                                <th>Titolo</th>
                                <th>Modifica</th>
                                <th>Elimina</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $libriResult = $libri->getLibri();
                            while ($row = mysqli_fetch_assoc($libriResult)) {
                            ?>
                                <tr>
                                    <td> <?php echo $row['titolo']; ?> </td>
                                    <td>
                                        <a href='#' data-bs-toggle="modal" data-bs-target="#modal_modifica_libro_<?php echo $row['id']; ?>" title="Modifica libro">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                <path d="M0 13.622v2.5a.5.5 0 0 0 .5.5H3a.5.5 0 0 0 .5-.5V13h-3v.622zM15.854 1.146a1 1 0 0 0-1.415 0L12 3.586 12 7l3.854-3.854a1 1 0 0 0 0-1.415z" />
                                                <path fill-rule="evenodd" d="M1 0a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1H1zm12 4h3l-9 9H3V7h3l9-9v3z" />
                                            </svg>
                                        </a>
                                    </td>
                                    <td>
                                        <a href='#' data-bs-toggle="modal" data-bs-target="#modal_elimina_libro_<?php echo $row['id']; ?>" title="Elimina Libro">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                <path d="M1 3h1v9H1V3zm2 0h10v9H3V3zm12-2h-3l-1-1h-4l-1 1H2v1h12V1zM5.5 12a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1zm3 0a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1zm3 0a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1z" />
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!--Inizio modal modifica libro-->
        <?php
        $libriResult = $libri->getLibri();
        while ($row = mysqli_fetch_assoc($libriResult)) {
        ?>
            <div class="modal fade" id="modal_modifica_libro_<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="mod_exampleModalLabel<?php echo $row['id'];?>" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="mod_exampleModalLabel<?php echo $row['id'];?>">Modifica libro</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="#">
                                <label for="tit_lib<?php echo $row['id'];?>">Titolo libro</label>
                                <input type="text" id="tit_lib<?php echo $row['id'];?>" placeholder="Titolo libro" name="titolo" class="form-control" value="<?php echo $row['titolo']; ?>" required>
                                <br>
                                <input type="hidden" name="id" class="form-control" value="<?php echo $row['id']; ?>">
                                <div class="modal-footer">
                                    <input type="submit" class="btn btn-warning" name="modifica_libro" value="Modifica">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        <!--Fine modal modifica libro -->

        <!--Inizio modal elimina libro-->
        <?php
        $libriResult = $libri->getLibri();
        while ($row = mysqli_fetch_assoc($libriResult)) {
        ?>
            <div class="modal fade" id="modal_elimina_libro_<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="el_exampleModalLabel<?php echo $row['id'];?>" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="el_exampleModalLabel<?php echo $row['id'];?>">Conferma eliminazione</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="#">
                                <label>Ne sei sicuro?</label>
                                <input type="hidden" name="id" class="form-control" value="<?php echo $row['id']; ?>">
                                <div class="modal-footer">
                                    <input type="submit" class="btn btn-danger" name="elimina_libro" value="Elimina">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        <!--Fine modal elimina libro-->

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- TODO: è per caso da spostare fuori dal php, tipo onclick? -->

    <script>
        $(document).ready(function () {
            $('#libriTable').DataTable();
        });
    </script>
</body>

</html>
