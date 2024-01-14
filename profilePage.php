<?php
session_start();
require_once("include/login.controller.php");
require_once("include/login.model.php");
require_once("include/post.php");
require_once("include/model/selectors.php");
require_once("include/model/insertOnDB.php");


if (!($_SESSION['loggedin'] === true)) {
    //user is not logged in go to login page
    header("Location: index.html");
}


$visitPost=true;
$modes = array("post", "goal");

//$modified = 0;
$newValues = array();
if(!isset($_GET["mode"]) || !in_array($_GET["mode"], $modes)){
    $newValues["post"] = "post";
}
if(!isset($_GET["id"]) || (existIdUser($_GET["id"]) == -1)){
    $newValues["id"] = getUserId1($_SESSION["username"]);
}

if(sizeof($newValues) > 0){
    $modeVOk = array_key_exists("post", $newValues) ? $newValues["post"] : $_GET["mode"];
    $idVOk = array_key_exists("id", $newValues) ? $newValues["id"] : $_GET["id"];
    $okLink = "profilePage.php?mode=" . $modeVOk . "&id=" . $idVOk;
    header("Location: " . $okLink);
}


$portalImg="images/";

if (strcmp($_GET["mode"],"post") == 0){
    $portalImg = $portalImg . "libroMedaglieri.png";
} else {
    $visitPost = false;
    $portalImg = $portalImg . "logoLetturePremiate.png";
}



$userIdvisited = $_GET["id"];

////////per popolare il medagliere
$tmpKey = tmpGetUsernameById($userIdvisited);
$userDescription = getUserDescription($tmpKey);

$allMeds = getAllMedOfUserId($userIdvisited);
$completeMeds = getMedCompletatiByUserId($userIdvisited);
$notCompleteMeds = array_diff($allMeds, $completeMeds);

$medIndex = array_merge($completeMeds,$notCompleteMeds);

$amountComplete = sizeof($completeMeds);
/////////////


$post = new Post($conn);
$posts = $post->getPost($_GET["id"]);



//////////controllo utente loggato == id
$userIdLogged = $_SESSION["id"];
$isMyProfilePage = true;
if ($userIdvisited != $userIdLogged){
    $isMyProfilePage = false;
} 
// echo $isMyProfilePage;

$nuovoPost = "Aggiungi post";
$nuovoMedagliere = "Aggiungi medagliere";
$toFollow = "Segui";
$followed = "Seguito";

$initB = "";
$middle = "";
$endB = "";
$tmp = array();
if($isMyProfilePage) {

    $classType="btn btn-primary";
    $buttonType = "button";
    $redirectTo = "";

    if ($visitPost){
        $redirectTo = "newPost.php";
    } else {
        $redirectTo = "newMedagliere.php";
    }


    $initB = "<a href=\"" . $redirectTo . "\">";

    $middle1 = "<button class=\"" . $classType . "\" type=\"" . $buttonType . "\">";
    $middle2 = "";

    if ($visitPost){
        $middle2 = $nuovoPost;
    } else {
        $middle2 = $nuovoMedagliere;
    }
    
    $middle = $middle1 . $middle2;

    $endB = "</button></a>";

} else {

    $imFollowU = checkIfUserFollowUser($_SESSION["id"], $userIdvisited);
    $buttonValue = 0;
    $classType="btn btn-primary";
    if ($imFollowU){
        $buttonValue = 1;
        $classType="btn btn-secondary";
    }
    
    $buttonType = "submit";
    $idButton = "followButtonId";
    $nameButton = "followButton";



    $initB = "<form action=\"\" method=\"post\"><button ";

    $middle1 = "class=\"" . $classType
                . "\" type=\"" . $buttonType
                . "\" id=\"" . $idButton
                . "\" name=\"" . $nameButton
                . "\" value=\"" . $buttonValue 
                . "\">";

    $middle2 = "";
    if ($imFollowU){
        $middle2 = $followed;
    } else {
        $middle2 = $toFollow;
    }
    $middle = $middle1 . $middle2;

    $endB = "</form></button>";
    
    if (isset($_POST[$nameButton])) {
        // echo $_SESSION["id"] . " " . $userIdvisited;
        if ($imFollowU){
            destroyFollow($_SESSION["id"], $userIdvisited);
        } else {
            createFollow($_SESSION["id"], $userIdvisited);
        }
        // print_r($_POST);
        // echo $nameButton;
        header("Location: " . $_SERVER['REQUEST_URI']);
    }
    
}

$addButt = $initB . $middle . $endB;


// $tmp["a"] = $addButt;
// print_r($tmp);
//////////////

$counterFollower = sizeof(ottieniFollower($userIdvisited));
$counterSeguo = sizeof(ottieniSegue($userIdvisited));
// echo "<br>";
// echo "POST: ";
// print_r($_POST);
// echo "<br>";
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
                                    src="<?php echo getUserImage($tmpKey); ?>"
                                    alt="Immagine Profilo"
                                    class="rounded float-left">
                                <!-- <img id="propic" src="images\userLogo.png" class="rounded float-left" alt="Foto profilo" width="100px"> -->
                                <!-- <img  src="" alt="" width="100px" /> -->
                            </div>

                            <div id="textInfo" class="">
                                <h1 id="username"> <?php echo $tmpKey ?> </h1>
                                <p class="card-text" id="counterFollower"> Follower: <?php echo $counterFollower; ?> </p> <!--- TODO query 1 --->
                                <p class="card-text" id="counterFollower"> Segue: <?php echo $counterSeguo; ?> </p> <!--- TODO query 2 --->
                                <p class="card-text" id="counterMedaglieri"> Medaglieri completati: <?php echo $amountComplete?> </p> <!--- TODO query 2 IN REALTà FATTA DEVO SOLO AGGIUSTARE --->
                                <!-- <a href="#" class="btn btn-primary">Button</a> -->
                            </div>
                        </div>
                        <!-- <br/> -->

                        <div class="d-flex flex-grow-1 p-1">
                        </div>

                        <!-- <div id="portals" class="d-md-inline-flex justify-content-start align-items-center"> -->
                        <div id="portals" class="bd-highlight p-1 d-md-inline-flex justify-content-end align-items-center float-right">
                            <div id="addInfos" class="">
                                <?php echo $addButt; ?>
                                
                            </div>
<!-- <p><a href="newPost.php">AggiungiPost</a></p> -->
                            <div id="portalDiv" class="">
                                <!-- <p class="card-text"> Clicca sul libro per passare alla sezione dei medaglieri!</p> -->
                                <abbr id="portalAbbr" lang="it" title="<?php echo tmpGetUsernameById($_GET["id"]); ?>" >
                                    <img
                                        id="portal"
                                        class="flex-wrap align-items-center"
                                        alt="<?php echo tmpGetUsernameById($_GET["id"]); ?>"
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
        require("include/view/profilePageUserPost.php");
    } else {
        require("include/view/profilePageUserGoal.php");
    } ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous">
    </script>
    <script src="javascript/profilePageAnimation.js"></script>



</body>
</html>
