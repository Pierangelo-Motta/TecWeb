<?php
session_start();

if (!($_SESSION['loggedin'] === true)) {
    //user is not logged in go to login page
    header("Location: index.html");
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
  <link rel="stylesheet" type="text/css" href="css/JPfirstAttemp1.css">
  <link rel="stylesheet" type="text/css" href="css/landingPage.css">


</head>
<body>
    <?php require('navbar.php'); ?>
    
    <main class="d-flex">
        <div class="col-1"></div>
        <div class="col-10">
            <div class="card">

                <div class="card-body">

                    <div class="d-flex">
                        <div id="mainInfos" class="d-inline-flex flex-wrap align-items-center "> <!-- <div > -->
                            <div id="img" class="p-3">
                                <img id="propic" src="images\userLogo.png" class="rounded float-left" alt="Foto profilo" width="100px">
                                <!-- <img  src="" alt="" width="100px" /> -->
                            </div>

                            <div id="textInfo" class="p-3">
                                <h1 id="username"> Username </h1>
                                <p class="card-text" id="counterFollower"> Follower: x </p>
                                <p class="card-text" id="counterFollower"> Seguiti: x </p>
                                <p class="card-text" id="counterMedaglieri"> Medaglieri completati: x</p>
                                <!-- <a href="#" class="btn btn-primary">Button</a> -->
                            </div>
                        </div>
                        <br/>

                        <div id="portal" class="auto p-3">
                            <!-- <p class="card-text"> Clicca sul libro per passare alla sezione dei medaglieri!</p> -->
                            <abbr lang=it title="Passa alla sezione dei medaglieri!"> <img id="libroMedaglieri" class="flex-wrap align-items-center" src="images\libroMedaglieri.png" alt="Clicca qui per passare al libro dei medaglieri di username" width="100px"/></abbr>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-1"></div>
    </main>

    <section id="userDescription" class="d-flex">
        <div class="col-1"></div>
        <div class="col-10">
            <h2> About me... </h2>
            <p> Ipsum sit amet vulputate efficitur, nulla erat placerat tortor, at iaculis eros elit ac risus. Proin aliquam erat in quam luctus pretium. Nullam non libero lobortis, rhoncus felis at, hendrerit mi. Aenean turpis orci, vestibulum ultricies pellentesque non, malesuada cursus neque. Donec blandit tempus vestibulum. Integer scelerisque eros ac aliquam pulvinar. Donec at arcu pharetra, porttitor ipsum id, sagittis turpis</p>
            <p><a href="newPost.php">AggiungiPost</a></p>
        </div>
        <div class="col-1"></div>
    </section>

    <section id="userPosts" class="d-flex">
        <div class="col-2"></div>
        <div class="col-8">
            <article>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-1 text-right post">
                                <img src="images/userLogo.png" alt="Immagine profilo" />
                            </div>
                            <div class="col-md-2 text-left">
                                <p>Username</p>
                            </div>
                        </div>

                        <div class="row">
                            <p>Libro:</p>
                        </div>

                        <div id="img"> <!--  class="p-3" -->
                            <img id="propic" src="images/post/user1__2024_01_01__23_26_40.jpeg" class="rounded float-left" alt="Foto profilo" width="100px">
                            <!-- <img  src="" alt="" width="100px" /> -->
                        </div>

                        <div class="row">
                            <p>Tags: #empty</p>
                        </div>

                        <div class="row">
                            <p>Questo post ha x riflessioni, y "mi piace" e z "WOW"</p>
                        </div>

                        <div class="row">
                            <div class="col-md-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hand-thumbs-up-fill" viewBox="0 0 16 16">
                                    <path d="M6.956 1.745C7.021.81 7.908.087 8.864.325l.261.066c.463.116.874.456 1.012.965.22.816.533 2.511.062 4.51a10 10 0 0 1 .443-.051c.713-.065 1.669-.072 2.516.21.518.173.994.681 1.2 1.273.184.532.16 1.162-.234 1.733q.086.18.138.363c.077.27.113.567.113.856s-.036.586-.113.856c-.039.135-.09.273-.16.404.169.387.107.819-.003 1.148a3.2 3.2 0 0 1-.488.901c.054.152.076.312.076.465 0 .305-.089.625-.253.912C13.1 15.522 12.437 16 11.5 16H8c-.605 0-1.07-.081-1.466-.218a4.8 4.8 0 0 1-.97-.484l-.048-.03c-.504-.307-.999-.609-2.068-.722C2.682 14.464 2 13.846 2 13V9c0-.85.685-1.432 1.357-1.615.849-.232 1.574-.787 2.132-1.41.56-.627.914-1.28 1.039-1.639.199-.575.356-1.539.428-2.59z"/>
                                    </svg>
                            </div>
                            <div class="col-md-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314"/>
                                    </svg>
                            </div>
                        </div>

                    </div>
                </div>
            </article>
        </div>

        <div class="col-2"></div>
    </section>

<!--
        <div id="mainInfos">
            <div id="img">
                <img id="propic" src="images\userLogo.png" alt="Foto profilo" />
            </div>
            <div id="textInfo">
                <h1 id="username"> Username </h1>
                <p id="counterFollower"> Follower: x </p>
                <p id="counterFollower"> Seguiti: x </p>
                <p id="counterMedaglieri"> Medaglieri completati: x</p>
            </div>
        </div>

        <div id="portal">
            <p> Clicca sul libro per passare alla sezione dei medaglieri!</p>
            <img id="libroMedaglieri" src="images\libroMedaglieri.png" alt="Clicca qui per passare al libro dei medaglieri di username" />
        </div>
    </main>

    <section id="selfDescription">
        <h2> About me...</h2>
        <p>Ciao! sono Jacopo e mi piace tanto leggere (o quasi)</p>
    </section>

    <footer>

    </footer> -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous">
    </script>


</body>
</html>
