<?php

session_start();
require_once("include/login.controller.php");
require_once("include/login.model.php");
require_once("include/post.php");
require_once("include/model/selectors.php");
require_once("include/model/insertOnDB.php");
require_once("include/view/userBanner.php");

function userIsVisitingAdminPage() {
    return ($_SESSION["id"] != 7) && ($_GET["id"] == 7);
}

if (!($_SESSION['loggedin'] === true)) {
    header("Location: index.php");
}

$modes = array("post", "goal");

$newValues = array();
if (!isset($_GET["mode"]) || !in_array($_GET["mode"], $modes)) {
    $newValues["post"] = "post";
}

if (!isset($_GET["id"]) || !is_numeric($_GET["id"]) || (existIdUser($_GET["id"]) == -1) || (userIsVisitingAdminPage())) {
    $newValues["id"] = getUserId1($_SESSION["username"]);
}

if (sizeof($newValues) > 0) {
    $modeVOk = array_key_exists("post", $newValues) ? $newValues["post"] : $_GET["mode"];
    $idVOk = array_key_exists("id", $newValues) ? $newValues["id"] : $_GET["id"];
    $okLink = "profilePage.php?mode=" . $modeVOk . "&id=" . $idVOk;
    header("Location: " . $okLink);
    die();
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

$user_id = isset($_GET["id"]) ? $_GET["id"] : null;

if ($user_id !== null) {
    $post = new Post($conn);
    $posts = $post->getProfilePosts($user_id);
} else {
    echo "Errore: Profilo non specificato.";
}

?>

<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile page</title>
 <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

  <link rel="stylesheet" type="text/css" href="css/landingPage.css">
  <link rel="stylesheet" type="text/css" href="css/userInfoBanner.css">
  <link rel="stylesheet" type="text/css" href="css/bookMed.css">
  <link rel="stylesheet" type="text/css" href="css/PMpopup.css">


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

<?php
    $userId = $_GET['id'];
    $listaFollower = ottieniFollower($userId);
    $listaSegue = ottieniSegue($userId);
// inserimento follower
    echo "<div id=\"myPopupFollowers\" class=\"popup\">
        <div class=\"popup-content\">
            <!-- <div class=\"closeMyPopupFollowers\">&times;
             </div> -->
            <div class=\"titoloPopUp\">Followers</div>";
            //foreach($listaSegue as $s) { echo "<div><a href=\"profilePage.php?mode=post&id=3\">" . $s['seguitoId'] . "</a></div>\n";};
    foreach($listaFollower as $f) { echo "<div class=\"rigaUtente\"><img src=\"" . getUserImage(tmpGetUsernameById($f['seguenteId'] )) . "\" alt=\"Immagine Profilo\" class=\"immagineProfilo\"><a href=\"profilePage.php?mode=post&id=" . $f['seguenteId']  . "\">" .  tmpGetUsernameById($f['seguenteId']) . "</a></div>\n";};
// inserimento seguiti
    echo "</div>
        </div>";
    echo "<div id=\"myPopupSeguiti\" class=\"popup\">
            <div class=\"popup-content\">
                <!-- <div class=\"closeMyPopupSeguiti\">&times;
                 </div> -->
                <div class=\"titoloPopUp\">Utenti seguiti</div>";
                //foreach($listaSegue as $s) { echo "<div><a href=\"profilePage.php?mode=post&id=3\">" . $s['seguitoId'] . "</a></div>\n";};
        foreach($listaSegue as $s) { echo "<div class=\"rigaUtente\"><img src=\"" . getUserImage(tmpGetUsernameById($s['seguitoId'])) . "\" alt=\"Immagine Profilo\" class=\"immagineProfilo\"><a href=\"profilePage.php?mode=post&id=" . $s['seguitoId'] . "\">" .  tmpGetUsernameById($s['seguitoId']) . "</a></div>\n";};

    echo "</div>
        </div>";
?>


    <?php if($visitPost): ?>
    <div class="row">
      <div class="col-md-2">
      </div>
      <div class="col-md-8">
        <?php require("include/view/postPage.php"); ?>
      </div>
      <div class="col-md-2">
      </div>
    </div>
    <?php else: ?>
      <?php require("include/view/profilePageUserGoal.php"); ?>
    <?php endif; ?>


    <script src="javascript/likePost.js"></script>
    <script src="javascript/lovePost.js"></script>

    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous">
    </script> -->


    <?php if(!isset($GLOBALS["includedPHPGetLib"])) {
        $GLOBALS["includedPHPGetLib"] = 1;
        echo "<script src=\"javascript/personalLibs/PHPGet.js\"> </script>";
    } ?>
    <script src="javascript/profilePageAnimation.js"></script>
    <script src="javascript/profilePageModal.js"></script>



</body>
</html>
