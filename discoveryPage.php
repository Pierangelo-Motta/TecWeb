<?php
session_start();

if (!($_SESSION['loggedin'] === true)) {
    //user is not logged in go to login page
    header("Location: index.html");
}

require_once 'include/post.php';

$post = new Post($conn);
$posts = $post->getPost();
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>landingPage</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
          crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/landingPage.css">
</head>
<body>
  <?php require('navbarSelect.php'); ?>

<main class="container">
    <?php foreach ($posts as $post): ?>
      <br/>
        <div class="row">
            <div class="col-md-3">
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-1 post">
                                <a href=<?php echo "profilePage.php?id=" . getUserId1($post["username"]) ?> >
                                <img src=<?php echo getUserImage($post["username"]); ?> alt="Immagine Profilo"> </a>
                            </div>
                            <div class="col-md-8">
                                <p><?php echo $post['username']; ?></p>
                            </div>
                            <div class="col-md-3">
                              <p><?php echo time_elapsed_string($post['dataOra']); ?></p>
                            </div>
                        </div>

                        <div class="row">
                          <div class="col-md-6">
                            <div class="row">
                                <p>Libro: <?php echo $post['titolo']; ?></p>
                            </div>
                            <div class="row">
                              <p>Citazione: <?php echo $post['citazioneTestuale']; ?></p>
                            </div>
                            <div class="row">
                              <p>Riflessione: <?php echo $post['riflessione']; ?></p>
                            </div>
                            <div class="row">
                                <p>Tags: #empty</p>
                            </div>
                          </div>
                          <div class="col-md-6 fotoCit">
                            <?php
                              $postImage = getPostImage($post['username'], $post['fotoCitazione']);
                              if ($postImage !== null) {
                                  echo '<img src="' . $postImage . '" class="rounded float-left" alt="Foto citazione">';
                              }
                            ?>
                          </div>
                        </div>
                        <br/>
                          <div class="row">
                              <p>Questo post ha x riflessioni, <?php echo $post['counterMiPiace']; ?> "mi piace" e <?php echo $post['counterAdoro']; ?> "WOW"</p>
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
                              <div class="col-md-3">
                                <p>Commenta</p>
                              </div>
                          </div>


                    </div>
                </div>
            </div>
            <div class="col-md-3">
            </div>
        </div>
        <br/>
    <?php endforeach; ?>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous">
</script>
</body>
</html>
