<?php

session_start();

if (!($_SESSION['loggedin'] === true)) {
    //user is not logged in go to login page
    header("Location: index.php");
}

require_once("include/view/commentGenerator.php");
require_once("include/post.php");
require_once("include/model/selectors.php");


$existPost = true;

if(!isset($_GET["userIdPost"]) || !isset($_GET["timePost"]) || !checkIfPostExist($_GET["userIdPost"], $_GET["timePost"])) {
    $existPost = false;
} else {
    $us = $_GET['userIdPost'];
    $tp = $_GET['timePost'];

    $post = new Post($conn);
    $posts = $post->getSpecificPost($us, $tp);

}

?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New post</title>


    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- <link rel="stylesheet" type="text/css" href="css/JPfirstAttemp.css"> -->
    <link rel="stylesheet" type="text/css" href="css/commentsStyle.css">
    <link rel="stylesheet" type="text/css" href="css/landingPage.css">


    <link rel="icon" href="images/favicon_io/favicon.ico">


</head>
<body>
    <?php require('navbarSelect.php'); ?>

    <div class="d-flex">

        <div id="allContainer" class="col-12 d-md-flex">

            <?php if ($existPost) : ?>

            <section id="postPart" class="col-12 col-md-6">
              <?php require("include/view/postPage.php"); ?>
            </section>

            <section id="commentPart" class="col-12 col-md-5">
                <h2> Il tuo commento: </h2>
                <form action="" method="post">
                    <div class="d-flex w-100" id="userCommentControls">
                        <!-- <div class="flex-fill"> solo per far andare il flex fill che tanto non vaaaaaaaaaaa - -->
                        <button id="retBut" class="flex-fill btn btn-secondary" type="button" data-prevLink="landingPage.php">Indietro</button>
                        <!-- </div> -->

                        <div class="flex-fill riempitivo"></div>

                        <!-- <div class="flex-fill"> -->
                        <button id="createComm" class="flex-fill btn btn-primary" type="button">Condividi!</button>
                        <!-- </div> -->
                    </div>

                    <textarea class="form-control"
                            id="riflessioneCurrentUser"
                            name="riflession"
                            rows="10"
                            cols="100"
                            placeholder="...Sto pensando a..."
                            data-userIDC="<?php echo $_SESSION["id"] ?>"></textarea>
                    <label for="riflessioneCurrentUser" class="notDisplay">Spazio rimasto per la tua riflessione: <span id="counterChars"> </span> </label>
                </form>

                <h2 class="subTitle"> Gli altri utenti: </h2>
                <div id="commentContainer">
                    <?php
                        $toPrint = collectAllComments($us, $tp);
                        if (!empty($toPrint)){
                            echo $toPrint;
                        } else {
                            echo "<h3>Questo post non ha ancora commenti! </h3><p>Ne facciamo qualcuno? 😏</p>";
                        }
                    //inserire qui collectAllComments di commentController.php
                    //gestire il caso di empty!!!
                    ?>
                    <!-- <div class="comment">
                        <img alt="#" class="userCommentedImg" src="images/userLogo.png"/> <p class="titleOfComment">Jacopo<p>
                        <p class="commentText">WOW CHE FIKOOOO<p>
                    </div>
                    <div class="comment">
                        <img alt="#" class="userCommentedImg" src="images/userLogo.png"/> <p class="titleOfComment">Jacopo<p>
                        <p class="commentText">WOW CHE FIKOOOO<p>
                    </div>
                    <div class="comment">
                        <img alt="#" class="userCommentedImg" src="images/userLogo.png"/> <p class="titleOfComment">Jacopo<p>
                        <p class="commentText">WOW CHE FIKOOOO<p>
                    </div>
                    <div class="comment">
                        <img alt="#" class="userCommentedImg" src="images/userLogo.png"/> <p class="titleOfComment">Jacopo<p>
                        <p class="commentText">WOW CHE FIKOOOO<p>
                    </div>
                    <div class="comment">
                        <img alt="#" class="userCommentedImg" src="images/userLogo.png"/> <p class="titleOfComment">Jacopo<p>
                        <p class="commentText">WOW CHE FIKOOOO<p>
                    </div>

                    <div class="comment">
                        <img alt="#" class="userCommentedImg" src="images/userLogo.png"/> <p class="titleOfComment">Jacopo<p>
                        <p class="commentText">WOW CHE FIKOOOO<p>
                    </div>

                    <div class="comment">
                        <img alt="#" class="userCommentedImg" src="images/userLogo.png"/> <p class="titleOfComment">Jacopo<p>
                        <p class="commentText">WOW CHE FIKOOOO<p>
                    </div> -->

                </div>
            </section>



            <?php else : ?>
            <section id="postNotFoundContainer" class="col-12 col-md-6">
                <h1> Il post richiesto non esiste! </h1>
                <button id="retBut" class="flex-fill btn btn-secondary" type="button" data-prevLink="landingPage.php">Indietro</button>
            </section>
            <?php endif?>


          </div>

    </div>






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="javascript/likePost.js"></script>
    <script src="javascript/lovePost.js"></script>
    <script src="javascript/commentAnimation.js"></script>


    <!-- <script src="javascript/addNewPost.js"></script> -->
    <!-- <script src="javascript/addNewPost.js"></script> -->
    <!-- <script src="javascript/newMedAJPAX.js"></script> -->
</body>
</html>
