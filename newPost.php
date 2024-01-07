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
  <title>profile page</title>

  
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  
  <!-- <link rel="stylesheet" type="text/css" href="css/JPfirstAttemp.css"> -->
  <link rel="stylesheet" type="text/css" href="css/JPfirstAttemp2.css">
  <link rel="stylesheet" type="text/css" href="css/landingPage.css">
  

</head>
<body>
  <?php require('navbar.php'); ?>

  <main class="d-flex">
        <div class="col-1"></div>
        
        <div id="mainCont" class="col-10">
            <h1>Crea un nuovo post!</h1>
            <form id="newPostForm" class="form-group" method="get">
                    
                    <div class="col-md-6 col-12" id="newPostForm_pt1">
                        
                        <label for="nomeLibro">Nome libro: </label>
                        <input type="text" id="nomeLibro" name="nomeLibro" value="">
                        <br/>

                        <label for="citazioneText"></label>
                        <textarea class="form-control" id="citazioneText" name="citazione" rows="10" cols="100" placeholder="Inserisci qui la citazione"></textarea>

                        <label for="pensieroText"></label>
                        <textarea class="form-control" id="pensieroText" name="pensiero" rows="10" cols="100" placeholder="Inserisci qui il tuo pensiero"></textarea>

                        <!-- <label for="html">Nome libro</label> -->
                        <!-- <textarea id="citazioneText" name="citazione" rows="10" cols="100" placeholder="Inserisci qui la citazione"></textarea>
                        <textarea id="pensieroText" name="pensiero" rows="10" cols="100" placeholder="Inserisci qui il tuo pensiero"></textarea> -->
                    </div>

                    <!-- <div class="col-1"></div> -->

                    <div class="col-md-6 col-12" id="newPostForm_pt2">
                        <p>Inserisci qui sotto una foto:</p>
                        <div id="img1">
                            <label id="imgLabel" for="file"> <img src="images/caricaFoto.png" alt="Carica la foto" /> </label>
                            <input id="file" name="file" type="file" />
                        </div>
                    </div>

                <!-- </div> -->
            </form>

            <footer>
                <p>Rendi il contenuto del tuo pensiero accessibile a tutti! <a href="#">Per più informazioni</a></p>
        
                <button class="btn btn-secondary" type="button">Indietro</button>
                <button class="btn btn-secondary" type="submit">Condividi</button>
            </footer>
        </div>

        <div class="col-1"></div>
    </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
      crossorigin="anonymous">
  </script>


</body>
</html>
