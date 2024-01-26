<?php

session_start();
// if (!($_SESSION['loggedin'] === true)) {
//     header("Location: index.html");
// }

// require_once('include/model/uploadImage.php'); //per gestire il caricamento della foto
// require_once('include/model/insertOnDB.php'); //per gestire la query di INSERT INTO
// require_once("include/model/selectors.php");

?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New post</title>


    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- <link rel="stylesheet" type="text/css" href="css/JPfirstAttemp.css"> -->
    <link rel="stylesheet" type="text/css" href="css/JPNewPost.css">
    <link rel="stylesheet" type="text/css" href="css/landingPage.css">

    <link rel="icon" href="images/favicon_io/favicon.ico">
  

</head>
<body>
    <?php require('navbarSelect.php'); ?>

    <div class="d-flex">

        <div class="col-1"> </div>
        
        <div class="col-10"> 
        <h1> A proposito di libri...</h1>
        <article>
            <h2> Buone norme di accessibilità.</h2>
            <p> Mettere una foto del tuo passo preferito è sicuramente il modo più interessante per permettere a molte persone di partecipare
                alla tua rilessione... ma non per tutte!
                Infatti, alcune sono "cieche", ma ciò nonostante si possono dilettare alla lettura grazie ai moderni screen-reader.
                Quindi, quando effettui un post, ti preghiamo, se desideri pubblicare una foto, un piccolo testo, anche parafrasato,
                riportante il punto più importante della citazione. Grazie!
            </p>
        </article>
        </div>

        <div class="col-1"> </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous">
    </script>

    <script src="javascript/addNewPost.js"></script>

</body>
</html>
