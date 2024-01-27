<?php
session_start();
require_once("include/login.controller.php");
require_once("include/login.model.php");

require_once("include/view/userBanner.php");


if (!($_SESSION['loggedin'] === true)) {
    //user is not logged in go to login page
    header("Location: index.html");
}

?>

<!DOCTYPE html>
<html lang="it">

<head>
    <title>TecWeb - Classifica</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/landingPage.css">
    <link rel="stylesheet" type="text/css" href="css/settingPage.css">
    <link rel="stylesheet" type="text/css" href="css/PMpopup.css">
    <link rel="icon" href="images/favicon_io/favicon.ico">
</head>

<body>
    <?php require('navbarSelect.php'); ?>

    <main class="container">
        <div class="row">
            <div class="col-md-4">
            </div>
            <div class="col-md-4 text-center">
                <h1>Classifica</h1>
            </div>
            <div class="col-md-4">
            </div>
        </div>
        <br />
        <br />
        <div class="row">
            <div class="col-md-4">
            </div>
            <div class="col-md-4 text-center">
                <ul class="list-unstyled">
            
                <!-- foreach classifica utenti (da ordinare per medaglieri?) -->
                    <?php
                    $utenti = getListaElencoUtenti();
                    // print_r($utenti);
                    foreach ($utenti as &$user) {
                        $user['medalsCompleted'] = sizeof(getMedCompletatiByUserId($user['id']));
                    }
                    // print_r($utenti);
                
                    // Use array_column to get the 'medalsCompleted' values
                    $ids = array_column($utenti, 'medalsCompleted');
                    // Use array_multisort to sort the array by 'id'
                    array_multisort($ids, SORT_DESC, $utenti);
                
                    foreach($utenti as $userId){
                        // echo getUserBannerById($userId, "goal"); // "post" "goal"
                        $amountComplete = sizeof(getMedCompletatiByUserId($userId['id']));
                        // echo "[id: " . $userId['id'] . "] " . $userId['username']. " -       medaglieri: " .$amountComplete;
                        echo "[id: " . $userId['id'] . "] " . $userId['username']. " -      medaglieri: " . $userId['medalsCompleted'];
                        echo "<br />";
                    }
                    ?>
                </ul>
            </div>
            <div class="col-md-4">
            </div>
            

        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="settingPage.js"></script>
</body>

</html>