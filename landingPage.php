<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Utente non autenticato, reindirizza alla pagina di login
    header("Location: index.php");
    exit;
}

require_once 'include/post.php';

$post = new Post($conn);

// Ottenere i post delle persone che stai seguendo (Landing Page)
$posts = $post->getLandingPosts($_SESSION['id']);

// Se non ci sono post, puoi impostare un messaggio di avviso
if (empty($posts)) {
    $no_posts_message = 'Non stai seguendo nessuno. Inizia a seguire qualcuno per vedere i loro post.';
}
?>

<!DOCTYPE html>
<html lang="it">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
     <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
    crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/landingPage.css">
    <link rel="icon" href="images/favicon_io/favicon.ico">
  </head>
  <body>
    <?php require('navbarSelect.php'); ?>
    <br/>
    <main class="container">
      <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
          <?php require("include/view/postPage.php"); ?>
        </div>
        <div class="col-md-2">
        </div>
      </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="javascript/likePost.js"></script>
    <script src="javascript/lovePost.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous">
    </script>

  </body>
</html>
