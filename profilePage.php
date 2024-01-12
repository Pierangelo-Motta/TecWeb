<?php
session_start();
include_once("include/login.controller.php");
include_once("include/login.model.php");
include_once("include/myPost.php");
require("include/selectors.php");

if (!($_SESSION['loggedin'] === true)) {
    //user is not logged in go to login page
    header("Location: index.html");
}

$userDescription = getUserDescription($_SESSION["username"]);

$visitPost=true;
$modes = array("post", "goal");

if(!isset($_GET["mode"]) || !in_array($_GET["mode"], $modes)){
    header("Location: profilePage.php?mode=post");
}
// $nameTmpCookie="mode";
// $valueTmpCookie=$_GET["mode"];
// $timeExpire=time()+30;
$portalImg="images/";
// print_r($_GET);
// echo "<br>";
if (strcmp($_GET["mode"],"post") == 0){
    // $nameTmpCookie="mode";
    //$valueTmpCookie="post";
    $portalImg = $portalImg . "libroMedaglieri.png";
} else {
    // $nameTmpCookie="";
    //$valueTmpCookie="goal";
    $visitPost=false;
    $portalImg = $portalImg . "logoLetturePremiate.png";
}
// setcookie($nameTmpCookie, $valueTmpCookie, $timeExpire);
// print_r($_COOKIE);


// echo getLibroIdFromLibroWhereTitle("L'uomo che cammina");

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
  <link rel="stylesheet" type="text/css" href="css/JPfirstAttemp1.css">
  <link rel="stylesheet" type="text/css" href="css/JPBook.css">



</head>
<body>
  <?php require('navbarSelect.php'); ?>


    <main class="d-flex">
        <div class="col-1"></div>
        <div class="col-10">
            <div class="card">

                <div class="card-body">

                    <div class="d-md-inline-flex bd-highlight"> <!--- "d-md-inline-flex d-flex align-items-center col-12" --->

                        <!-- <div id="mainInfos" class="d-md-inline-flex justify-content-start align-items-center "> <div class="p-6 d-inline-flex flex-wrap align-items-center"> -->
                        <div id="mainInfos" class="bd-highlight p-1 d-md-inline-flex justify-content-start align-items-center float-left">
                            <div id="divContainerImg" class=""><!-- class="p-3" -->
                                <img id="propic"
                                    src=<?php echo getUserImage($_SESSION["username"]); ?>
                                    alt="Immagine Profilo"
                                    class="rounded float-left">
                                <!-- <img id="propic" src="images\userLogo.png" class="rounded float-left" alt="Foto profilo" width="100px"> -->
                                <!-- <img  src="" alt="" width="100px" /> -->
                            </div>

                            <div id="textInfo" class="">
                                <h1 id="username"> <?php echo $_SESSION["username"] ?> </h1>
                                <p class="card-text" id="counterFollower"> Follower: x </p> <!--- TODO query 1 --->
                                <p class="card-text" id="counterFollower"> Seguiti: x </p> <!--- TODO query 2 --->
                                <p class="card-text" id="counterMedaglieri"> Medaglieri completati: x</p> <!--- TODO query 2 --->
                                <!-- <a href="#" class="btn btn-primary">Button</a> -->
                            </div>
                        </div>
                        <!-- <br/> -->

                        <div class="d-flex flex-grow-1 p-1">
                        </div>

                        <!-- <div id="portals" class="d-md-inline-flex justify-content-start align-items-center"> -->
                        <div id="portals" class="bd-highlight p-1 d-md-inline-flex justify-content-end align-items-center float-right">
                            <div id="addInfos" class="">
                                <p><a href="newPost.php">AggiungiPost</a></p>
                            </div>

                            <div id="portalDiv" class="">
                                <!-- <p class="card-text"> Clicca sul libro per passare alla sezione dei medaglieri!</p> -->
                                <abbr id="portalAbbr" lang=it title="Passa alla sezione dei medaglieri!">
                                    <img
                                        id="portal"
                                        class="flex-wrap align-items-center"
                                        src="<?php echo $portalImg; ?>"
                                        />
                                </abbr>
                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>
        <div class="col-1"></div>
    </main>

    <?php if(!empty($userDescription)) {
        echo "<section id='userDescription' class='d-flex'>
        <div class='col-1'></div>
        <div class='col-10'>
            <h2> About me... </h2>
            <p>" .
            $userDescription .
            "</p>
        </div>
        <div class='col-1'></div>
    </section>";}
    ?>

    <?php if($visitPost){
        require("profilePageUserPost.php");
    } else {
        require("profilePageUserGoal.php");
    } ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous">
    </script>
    <script src="javascript/profilePageAnimation.js"></script>



</body>
</html>
