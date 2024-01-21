<?php
  session_start();

  if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    //user is not logged in go to login page
    header("Location: index.html");
    exit;
  }

  require_once 'include/post.php';

  $post = new Post($conn);
  $following_users = getFollowingUsers($_SESSION['id'], $conn);
  if (!empty($following_users)) {
    $posts = $post->getPost($_SESSION['id'], $following_users);
  } else {
    $posts = array();
    $no_posts_message = 'Non stai seguendo nessuno. Inizia a seguire qualcuno per vedere i loro post.';
  }
?>
<!DOCTYPE html>
<html lang="it">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
    crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/landingPage.css">
    <link rel="icon" href="images/favicon_io/favicon.ico">
  </head>
  <body>
    <?php require('navbarSelect.php'); ?>
    <main class="container">
      <?php require("include/view/postPage.php"); ?>
    </main>
    <!-- Includi jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- Includi il tuo script JavaScript -->
    <script src="javascript\likePost.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous">
    </script>
  </body>
</html>
