<?php
session_start();
require_once("include/login.controller.php");
require_once("include/login.model.php");
require_once("include/post.php");
require_once("include/model/selectors.php");
require_once("include/model/insertOnDB.php");
require_once("include/view/userBanner.php");

if (!($_SESSION['loggedin'] === true)) {
    //user is not logged in go to login page
    header("Location: index.html");
}

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



$userIdvisited = $_GET["id"];
$typeOfVision = $_GET["mode"];
$visitPost = (strcmp($typeOfVision, "post") == 0);

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

print_r($_POST);
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

            <?php echo getUserBannerById($userIdvisited, $typeOfVision);?>

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
        require("include/view/postPage.php");
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
