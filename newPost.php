<?php
session_start();

if (!($_SESSION['loggedin'] === true)) {
    //user is not logged in go to login page
    header("Location: index.html");
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <link rel="stylesheet" type="text/css" href="css/JPfirstAttemp.css">
  <link rel="stylesheet" type="text/css" href="css/landingPage.css">


</head>
<body>
  <?php require('navbar.php'); ?>

  <main>
    <h1>Crea un nuovo post!</h1>
    <form id="newPostForm" action="" method="post">
        <div id="newPostForm_pt1">
            <label for="html">Nome libro</label>
            <input type="text" id="nomeLibro" value="">
            <br>

            <!-- <label for="html">Nome libro</label> -->
            <input type="textarea" id="citazioneText" placeholder="Inserisci qui la citazione">
            <br>
            <input type="textarea" id="pensieroText" placeholder="Inserisci qui il tuo pensiero">
            <br>
        </div>

        <div id="newPostForm_pt2">
            <p>Inserisci qui sotto una foto:</p>
            <div id="img1">
              <label for="file"><img src="images\caricaFoto.png" alt="Carica la foto" ></label>
              <input id="file" name="file" type="file" />
            </div>
        </div>
    </form>
  </main>

  <footer>
    <p show="hidden">Rendi il contenuto del tuo pensiero accessibile a tutti! <a href="#">Per più informazioni</a></p>

    <button type="button">Indietro</button>
    <button form="newPostForm" type="submit">Condividi</button>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
      crossorigin="anonymous">
  </script>


</body>
</html>
