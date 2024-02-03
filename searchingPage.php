<?php
session_start();
require_once("include/login.controller.php");
require_once("include/login.model.php");

require_once("include/view/userBanner.php");

if (!($_SESSION['loggedin'] === true)) {
    //user is not logged in go to login page
    header("Location: index.php");
}

$tmp = isset($_POST["searchingText"]) ? $_POST["searchingText"] : "";
$a = array();

if (!empty($tmp)){
  $a = getUserIdWithSimilarName($tmp);
  if (($key = array_search(7, $a)) !== false) {
    unset($a[$key]);
  }
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
  <link rel="stylesheet" type="text/css" href="css/landingPage.css">
  <link rel="stylesheet" type="text/css" href="css/JPUserInfoBanner.css">
  <!-- <link rel="stylesheet" type="text/css" href="css/JPBook.css"> -->
  <link rel="stylesheet" type="text/css" href="css/PMpopup.css">
  <link rel="stylesheet" type="text/css" href="css/searchingPageAddtionalStyle.css">
  
  <link rel="icon" href="images/favicon_io/favicon.ico">

</head>
<body>
    
    <?php require('navbarSelect.php'); ?>

    <main class="d-flex">
        <div class="col-1"></div>

        <div class="col-10">
            <?php 
            if(empty($a)){
              if(empty($tmp)){
                echo "<h2> Per cercare qualcuno ho bisogno di almeno un carattere! </h2>";
              } else {
                echo "<h2> Nessun utente trovato con \"" . $tmp . "\"! </h2>";
              }
              
            }
            foreach($a as $userId){
                echo getUserBannerById($userId, "search"); // "post" "goal"
            }
            
            ?>
        </div>

        <div class="col-1"></div>
    </main>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous">
    </script>
    <script src="javascript/searchingPageAnimation.js"></script>
    <!-- <script src="javascript/profilePageAnimation.js"></script> si protrebbe anche includere ma devo aggiustare una cosa-->
    <script src="javascript/profilePageModal.js"></script>


</body>
</html>
