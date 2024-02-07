<?php
session_start();

if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    // Utente non autenticato, reindirizza alla pagina di login
    header("Location: index.php");
    exit();
}

require_once 'include/config.php';
require_once 'include/libri.php';

$libri = new Libri($conn);
$libriResult = $libri->getLibri();
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GestioneLibri</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <link rel="stylesheet" type="text/css" href="css/landingPage.css">
    <link rel="icon" type="image/x-icon" href="images/favicon_io/favicon.ico">
    <script src="javascript/libro.js"></script>
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

        <!-- Modal aggiungi libro -->
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

                            <label for="autore">Autore</label>
                            <select id="autore" name="autore" class="form-control" required>
                              <option value="" disabled selected>Scegli un autore</option>
                              <?php
                              $resultAutori = $libri->getAutori();
                              while ($rowAutore = mysqli_fetch_assoc($resultAutori)) {
                                  echo "<option value='{$rowAutore['id']}'>{$rowAutore['nome']}</option>";
                              }
                              ?>
                              <option value="altro">Altro</option>
                            </select>

                            <div id="altroAutore" class="hide">
                                <label for="nuovoAutore">Nuovo Autore</label>
                                <input type="text" id="nuovoAutore" placeholder="Nuovo Autore" name="nuovoAutore" class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
                            <input type="submit" class="btn btn-primary" name="aggiungi_libro" value="Aggiungi" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Fine modal aggiungi libro -->

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <table id="libriTable" class="table table-striped text-center">
                        <thead>
                            <tr>
                                <th>Titolo</th>
                                <th>Autore</th>
                                <th>Modifica</th>
                                <th>Elimina</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($libriResult)) { ?>
                                <tr>
                                    <td><?php echo $row['titolo']; ?></td>
                                    <td><?php echo $row['nome']; ?></td>
                                    <td>
                                        <a href='#' data-bs-toggle="modal" data-bs-target="#modal_modifica_libro_<?php echo $row['id']; ?>" title="Modifica libro">
                                            <!-- Icona modifica -->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                              <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                              <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                            </svg>
                                        </a>
                                    </td>
                                    <td>
                                        <a href='#' data-bs-toggle="modal" data-bs-target="#modal_elimina_libro_<?php echo $row['id']; ?>" title="Elimina Libro">
                                            <!-- Icona elimina -->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                              <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
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

        <!-- Modal modifica libro -->
        <?php
        $libriResult = $libri->getLibri();
        while ($row = mysqli_fetch_assoc($libriResult)) {
        ?>
            <div class="modal fade" id="modal_modifica_libro_<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="mod_exampleModalLabel<?php echo $row['id']; ?>" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="mod_exampleModalLabel<?php echo $row['id']; ?>">Modifica libro</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="#">
                                <label for="tit_lib<?php echo $row['id'];?>">Titolo libro</label>
                                <input type="text" id="tit_lib<?php echo $row['id'];?>" placeholder="Titolo libro" name="titolo" class="form-control" value="<?php echo $row['titolo']; ?>" required>
                                <br>
                                <label for="autore_modifica_<?php echo $row['id']; ?>">Autore</label>
                                <select id="autore_modifica_<?php echo $row['id']; ?>" name="autore" class="form-control autore_modifica" required>
                                  <option value="" disabled>Scegli un autore</option>
                                  <?php
                                  $resultAutori = $libri->getAutori();
                                  while ($rowAutore = mysqli_fetch_assoc($resultAutori)) {
                                      $selected = ($rowAutore['id'] == $row['autoreId']) ? 'selected' : '';
                                      echo "<option value='{$rowAutore['id']}' {$selected}>{$rowAutore['nome']}</option>";
                                  }
                                  ?>
                                  <option value="altro">Altro</option>
                                </select>

                                <div id="altroAutore_lib<?php echo $row['id'];?>" class="hide altroAutore">
                                    <label for="nuovoAutore_lib<?php echo $row['id'];?>">Nuovo Autore</label>
                                    <input type="text" id="nuovoAutore_lib<?php echo $row['id'];?>" placeholder="Nuovo Autore" name="nuovoAutore" class="form-control">
                                </div>

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
        <!-- Fine modal modifica libro -->

        <!-- Modal elimina libro -->
        <?php
        $libriResult = $libri->getLibri();
        while ($row = mysqli_fetch_assoc($libriResult)) {
        ?>
            <div class="modal fade" id="modal_elimina_libro_<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="el_exampleModalLabel<?php echo $row['id']; ?>" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="el_exampleModalLabel<?php echo $row['id']; ?>">Conferma eliminazione</h5>
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
        <!-- Fine modal elimina libro -->
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>
