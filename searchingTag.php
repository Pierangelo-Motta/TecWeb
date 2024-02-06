<?php

session_start();

require_once("include/model/selectors.php");

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Utente non autenticato, reindirizza alla pagina di login
    header("Location: index.php");
    exit;
}

if (!isset($_GET['tag'])) {
    header("Location: landingPage.php");
    exit;
}

require_once 'include/post.php';

$post = new Post($conn);

$tagExist = true;
$idTag = getIdTagByString($_GET["tag"]);

if ($idTag < 0) {
    $tagExist = false;
}
// echo "<br>";
// print_r($idTag);
// echo "<br>";

$posts = array();
if ($tagExist) {
    $tmp = getPostByTag($idTag);
    // print_r($tmp);
    foreach ($tmp as $row) {
        // echo "<br>";
        // echo "-->";  
        // print_r($row);
        // echo "<br>";
        // $a = $post->getSpecificPost($row["utenteIdPost"], $row["dataOraPost"]);
        // echo "---->";  
        // print_r($a);
        // echo "<br>";
        

        $alfa = $post->getSpecificPost($row["utenteIdPost"], $row["dataOraPost"]);
        array_push($posts,$alfa[0]);


        // $res =  
        // // echo "---->";  
        // // print_r($res);
        
        // // // print_r($res);
        // // // print "<br><br>";
        // // // $res .=

        // $alfa = $post->getSpecificPost($row["utenteIdPost"], $row["dataOraPost"]);
        // if (!empty($alfa)){
        //   array_push($posts,$alfa[0]);
        //   // print_r($posts);
        // }
    }
}

// print_r($posts);

// Ottenere i post delle persone che stai seguendo (Landing Page)
 //$posts = $post->getIdTagByString($_GET["tag"]);

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
          <?php if ($tagExist) {

            // foreach ($res as $post) {
            //     print_r($post);
            //     // echo "<br>";
                require("include/view/postPage.php");
            // }

          } else {

            echo "<h3>Nessun utente ha fatto post con questo tag!</h3>";

          } ?>
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
