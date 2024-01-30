<?php
session_start();
require_once("include/login.controller.php");
require_once("include/login.model.php");

require_once("include/view/userBanner.php");


if (!($_SESSION['loggedin'] === true)) {
    //user is not logged in go to login page
    header("Location: index.php");
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
    <link rel="stylesheet" type="text/css" href="css/PMclassifica.css">
    
    <link rel="icon" href="images/favicon_io/favicon.ico">
</head>

<body>
    <?php require('navbarSelect.php'); ?>

    <main class="container">
        <!-- prima riga -->
        <div class="row">
            <div class="col-md-4">
            </div>
            <div class="col-md-4 text-center">
                <h1>Classifica</h1>
            </div>
            <div class="col-md-4">
            </div>
        </div>

        <!-- seconda riga -->
        <div class="row">
            <div class="col-md-4"></div>
            <div class="card col-md-4 text-center">
                
                
                <!-- foreach classifica utenti (da ordinare per medaglieri?) -->
                <?php
                echo "<table>
                <caption>Tabella dei risultati</caption>    
                <tr>
                    <th>Utente</th>
                    <th>Numero Medaglieri</th>
                </tr>";
                    $utenti = getListaElencoUtenti();
                    // print_r($utenti);

                    //// Define a custom comparison function
                    // function compareByAmountComplete($a, $b) {
                    //     $amountCompleteA = sizeof(getMedCompletatiByUserId($a['id']));
                    //     $amountCompleteB = sizeof(getMedCompletatiByUserId($b['id']));
                    
                    //     // Compare the number of completed medals
                    //     return $amountCompleteB - $amountCompleteA;
                    // }
                    
                    // // Use usort to sort the $utenti array using the custom comparison function
                    // usort($utenti, 'compareByAmountComplete');

                    // print_r($_SESSION);
                    foreach ($utenti as &$user) {
                        $user['medalsCompleted'] = sizeof(getMedCompletatiByUserId($user['id']));
                    }
                    // print_r($utenti);
                    // Use array_column to get the 'medalsCompleted' values
                    $ids = array_column($utenti, 'medalsCompleted');
                    // Use array_multisort to sort the array by 'id'
                    array_multisort($ids, SORT_DESC, $utenti);
                    $classe = "";

                    foreach($utenti as $userId){
                        ($userId['id'] === $_SESSION['id']) ? $classe = "myuser" :  $classe = "";
                        $amountComplete = sizeof(getMedCompletatiByUserId($userId['id']));

                        echo "<tr class=\"" . $classe ."\"><td>" . $userId['username']. "</td><td>" . $userId['medalsCompleted'];
                        echo "</td></tr>";
                    }
                echo "</table>";
                ?>
                
                
                  
            </div>
            
            <div class="col-md-4"></div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="settingPage.js"></script>
</body>

</html>