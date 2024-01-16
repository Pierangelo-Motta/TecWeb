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

$visitPost = true;

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


$tmpKey = tmpGetUsernameById($userIdvisited);
$userDescription = getUserDescription($tmpKey);

////////per popolare il medagliere
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
    $buttonId = "addSomethingToMyAccount";
    $redirectTo = "";

    if ($visitPost){
        $redirectTo = "#";
    } else {
        $redirectTo = "#";
    }


    //$initB = "<a href=\"" . $redirectTo . "\">";
    $initB = "";

    $middle1 = "<button class=\"" . $classType 
                . "\" type=\"" . $buttonType 
                . "\" id=\"" . $buttonId 
                . "\">";
    $middle2 = "";

    if ($visitPost){
        $middle2 = $nuovoPost;
    } else {
        $middle2 = $nuovoMedagliere;
    }
    
    $middle = $middle1 . $middle2;

    $endB = "</button>";
    //$endB = "</button></a>";

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



    $initB = "<form action=\"#\" method=\"post\"><button ";

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

    $endB = "</button></form>";
    
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
  <link rel="stylesheet" type="text/css" href="css/JPUserInfoBanner.css">
  <link rel="stylesheet" type="text/css" href="css/JPBook.css">
  
  <link rel="icon" href="images/favicon_io/favicon.ico">



</head>
<body>
    
    <?php require('navbarSelect.php'); ?>

    <main class="d-flex">
        <div class="col-1"></div>

        <div class="col-10">
            <div class="card">

                <div class="card-body">

                    <!---"d-md-inline-flex d-flex align-items-center col-12"--->  
                    <div class="d-inline-flex align-items-md-center align-items-end"> 

                        <!--<div id="mainInfos" class="d-md-inline-flex justify-content-start align-items-center "> <div class="p-6 d-inline-flex flex-wrap align-items-center">-->
                        <div id="mainInfos" class="d-md-inline-flex align-items-center">

                            <!--class="p-3"-->
                            <div id="divContainerImg" class="">
                                <img id="propic"
                                    src="<?php echo getUserImage($tmpKey); ?>"
                                    alt="Immagine Profilo"
                                    class="rounded float-left">
                            </div>

                            <div id="textInfo" class="">
                                <h1 id="usernameInProfilePage"> <?php echo $tmpKey ?> </h1>
                                <p class="card-text" id="counterFollower"> Follower: <?php echo $counterFollower; ?> </p> 
                                <p class="card-text" id="counterSegue"> Segue: <?php echo $counterSeguo; ?> </p> 
                                <p class="card-text" id="counterMedaglieri"> Medaglieri completati: <?php echo $amountComplete?> </p> 
                            </div>

                            
                        </div>

                        <div class="d-inline-flex">
                        </div>

                        <div id="portals" class="d-md-inline-flex align-items-center">
                            
                            <div id="portalDiv" class="order-md-1">
                                <abbr id="portalAbbr" lang="it" title="<?php echo tmpGetUsernameById($_GET["id"]); ?>" >
                                    <img
                                        id="portal"
                                        class="flex-wrap align-items-center"
                                        alt="<?php echo tmpGetUsernameById($_GET["id"]); ?>"
                                        src="<?php echo $portalImg; ?>"
                                        />
                                </abbr>
                            </div>

                            <div id="addInfos" class="order-md-0">
                                <?php echo $addButt; ?>
                                
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
