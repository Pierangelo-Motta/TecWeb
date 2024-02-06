<?php

require_once("include/config.php");

function checkIfAlreadyLoved($userId, $dataOra) {

    global $conn;
    $utenteAttuale = $_SESSION['id'];
    $sql = "SELECT * FROM notifica WHERE tipo = 'V' AND utenteId = ? AND utenteIdPost = ? AND dataOraPost = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iis",$userId, $utenteAttuale, $dataOra);

    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        return true;
    } else {
        return false;
    }
}

function checkIfAlreadyLiked($userId, $dataOra) {

    global $conn;
    $utenteAttuale = $_SESSION['id'];
    $sql = "SELECT * FROM notifica WHERE tipo = 'K' AND utenteId = ? AND utenteIdPost = ? AND dataOraPost = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iis",$userId ,$utenteAttuale ,$dataOra);

    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        return true;
    } else {
        return false;
    }
}



?>


<section id="userPosts">
        <div class="col-md-12">
                <?php
                  if (empty($posts)) {
                      echo '<p>Nessun post disponibile in questa sezione.</p>';
                  } else {
                      foreach ($posts as $post):
                    //print_r($post["elencoTag"]);
                ?>
                <article>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-inline-flex w-100">

                              <div class="post flex-fill align-bottom">
                                  <a href="profilePage.php?id=<?= $post['utenteId']; ?>">
                                      <img class="post-img" src="<?= getUserImage($post['username']); ?>" alt="Immagine profilo" />
                                  </a>
                              </div>

                                <div class="align-bottom w-25">
                                    <p><?= $post['username']; ?></p>
                                </div>
                                <div class="flex-fill align-bottom float-left text-end">
                                    <p><?= time_elapsed_string($post['dataOra']); ?></p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-7">
                                  <br/>
                                    <div class="row">
                                        <p>Libro <br/> <?= $post['titolo']; ?></p>
                                    </div>
                                    <?php if (!empty($post['citazioneTestuale'])): ?>
                                        <div class="row">
                                            <p>"<?= $post['citazioneTestuale']; ?>"</p>
                                        </div>
                                    <?php endif; ?>

                                    <div class="row">
                                        <p>Sto pensando a... <br/> <?= $post['riflessione']; ?></p>
                                    </div>
                                     <div class="row"> <!--TODO: perchè doppia row?... --> 
                                      <?php if (!empty($post['elencoTag'])): ?>
                                        <div class="row">
                                            <p>
                                                <?php
                                                // echo "<br> --- ";
                                                // print_r($post['elencoTag']);
                                                // echo " --- <br>";
                                                $tags = explode(',', $post['elencoTag']);
                                                foreach ($tags as $tag) {
                                                  $tagUrl = 'searchingTag.php?tag=' . urlencode($tag);
                                                  echo '<a href="' . $tagUrl . '">#' . $tag . '</a> ';
                                                }
                                                ?>
                                            </p>
                                        </div>
                                    <?php endif; ?>
                                    </div>
                                </div>
                                <?php
                                $postImage = getPostImage($post['username'], $post['fotoCitazione']);
                                if (!empty($postImage)):
                                ?>
                                    <div class="col-md-5 fotoCit">
                                        <img src="<?= $postImage; ?>" class="rounded float-left" alt="Foto citazione">
                                    </div>
                                <?php endif; ?>
                            </div>
                            <br/>
                            <div class="row">
                              <p>Questo post ha <?= $post['numeroCommenti']; ?> commenti, <span class="like-count"><?= $post['counterMiPiace']; ?></span> mi piace e <span class="love-count"><?= $post['counterAdoro']; ?></span> adoro</p>
                            </div>
                            <div class="row">
                              <?php
                                $isLikeCheck = checkIfAlreadyLiked($post['utenteId'], $post['dataOra']);
                                $okLE = $isLikeCheck ? "0" : "1";
                                $okLF = $isLikeCheck ? "1" : "0";
                              ?>
                              <div class="col-md-1 col-2">
                                <button class="like-button bi-hand-thumbs-up likeButton" data-utenteID="<?= $post['utenteId']; ?>" data-dataOra="<?= $post['dataOra']; ?>">
                                    <!-- Icona del pollice in su vuota -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hand-thumbs-up emptyThumb" data-mustShow="<?= $okLE ?>" viewBox="0 0 16 16">
                                        <path d="M8.864.046C7.908-.193 7.02.53 6.956 1.466c-.072 1.051-.23 2.016-.428 2.59-.125.36-.479 1.013-1.04 1.639-.557.623-1.282 1.178-2.131 1.41C2.685 7.288 2 7.87 2 8.72v4.001c0 .845.682 1.464 1.448 1.545 1.07.114 1.564.415 2.068.723l.048.03c.272.165.578.348.97.484.397.136.861.217 1.466.217h3.5c.937 0 1.599-.477 1.934-1.064a1.86 1.86 0 0 0 .254-.912c0-.152-.023-.312-.077-.464.201-.263.38-.578.488-.901.11-.33.172-.762.004-1.149.069-.13.12-.269.159-.403.077-.27.113-.568.113-.857 0-.288-.036-.585-.113-.856a2 2 0 0 0-.138-.362 1.9 1.9 0 0 0 .234-1.734c-.206-.592-.682-1.1-1.2-1.272-.847-.282-1.803-.276-2.516-.211a10 10 0 0 0-.443.05 9.4 9.4 0 0 0-.062-4.509A1.38 1.38 0 0 0 9.125.111zM11.5 14.721H8c-.51 0-.863-.069-1.14-.164-.281-.097-.506-.228-.776-.393l-.04-.024c-.555-.339-1.198-.731-2.49-.868-.333-.036-.554-.29-.554-.55V8.72c0-.254.226-.543.62-.65 1.095-.3 1.977-.996 2.614-1.708.635-.71 1.064-1.475 1.238-1.978.243-.7.407-1.768.482-2.85.025-.362.36-.594.667-.518l.262.066c.16.04.258.143.288.255a8.34 8.34 0 0 1-.145 4.725.5.5 0 0 0 .595.644l.003-.001.014-.003.058-.014a9 9 0 0 1 1.036-.157c.663-.06 1.457-.054 2.11.164.175.058.45.3.57.65.107.308.087.67-.266 1.022l-.353.353.353.354c.043.043.105.141.154.315.048.167.075.37.075.581 0 .212-.027.414-.075.582-.05.174-.111.272-.154.315l-.353.353.353.354c.047.047.109.177.005.488a2.2 2.2 0 0 1-.505.805l-.353.353.353.354c.006.005.041.05.041.17a.9.9 0 0 1-.121.416c-.165.288-.503.56-1.066.56z"/>
                                    </svg>
                                    <!-- Icona del pollice in su piena, inizialmente nascosta -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hand-thumbs-up-fill filledThumb" data-mustShow="<?= $okLF ?>" viewBox="0 0 16 16">
                                        <path d="M6.956 1.745C7.021.81 7.908.087 8.864.325l.261.066c.463.116.874.456 1.012.965.22.816.533 2.511.062 4.51a10 10 0 0 1 .443-.051c.713-.065 1.669-.072 2.516.21.518.173.994.681 1.2 1.273.184.532.16 1.162-.234 1.733q.086.18.138.363c.077.27.113.567.113.856s-.036.586-.113.856c-.039.135-.09.273-.16.404.169.387.107.819-.003 1.148a3.2 3.2 0 0 1-.488.901c.054.152.076.312.076.465 0 .305-.089.625-.253.912C13.1 15.522 12.437 16 11.5 16H8c-.605 0-1.07-.081-1.466-.218a4.8 4.8 0 0 1-.97-.484l-.048-.03c-.504-.307-.999-.609-2.068-.722C2.682 14.464 2 13.846 2 13V9c0-.85.685-1.432 1.357-1.615.849-.232 1.574-.787 2.132-1.41.56-.627.914-1.28 1.039-1.639.199-.575.356-1.539.428-2.59z"/>
                                    </svg>
                                </button>
                            </div>

                            <?php
                              $isCheck = checkIfAlreadyLoved($post['utenteId'], $post['dataOra']);
                              $okE = $isCheck ? "0" : "1";
                              $okF = $isCheck ? "1" : "0";
                            ?>

                            <div class="col-md-1 col-5">
                              <button class="love-button bi-suit-heart loveButton" data-utenteID="<?= $post['utenteId']; ?>" data-dataOra="<?= $post['dataOra']; ?>">
                                  <!-- Icona del cuore vuota -->
                                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-suit-heart emptyHeart" data-mustShow="<?= $okE ?>" viewBox="0 0 16 16">
                                    <path d="m8 6.236-.894-1.789c-.222-.443-.607-1.08-1.152-1.595C5.418 2.345 4.776 2 4 2 2.324 2 1 3.326 1 4.92c0 1.211.554 2.066 1.868 3.37.337.334.721.695 1.146 1.093C5.122 10.423 6.5 11.717 8 13.447c1.5-1.73 2.878-3.024 3.986-4.064.425-.398.81-.76 1.146-1.093C14.446 6.986 15 6.131 15 4.92 15 3.326 13.676 2 12 2c-.777 0-1.418.345-1.954.852-.545.515-.93 1.152-1.152 1.595zm.392 8.292a.513.513 0 0 1-.784 0c-1.601-1.902-3.05-3.262-4.243-4.381C1.3 8.208 0 6.989 0 4.92 0 2.755 1.79 1 4 1c1.6 0 2.719 1.05 3.404 2.008.26.365.458.716.596.992a7.6 7.6 0 0 1 .596-.992C9.281 2.049 10.4 1 12 1c2.21 0 4 1.755 4 3.92 0 2.069-1.3 3.288-3.365 5.227-1.193 1.12-2.642 2.48-4.243 4.38z"/>
                                  </svg>
                                  <!-- Icona del cuore piena, inizialmente nascosta -->
                                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-suit-heart-fill filledHeart" data-mustShow="<?= $okF ?>" viewBox="0 0 16 16">
                                    <path d="M4 1c2.21 0 4 1.755 4 3.92C8 2.755 9.79 1 12 1s4 1.755 4 3.92c0 3.263-3.234 4.414-7.608 9.608a.513.513 0 0 1-.784 0C3.234 9.334 0 8.183 0 4.92 0 2.755 1.79 1 4 1"/>
                                  </svg>
                              </button>
                          </div>

                          <div class="col-md-4 col-5">
                              <a href="comments.php?userIdPost=<?= $post['utenteId']; ?>&timePost=<?=  $b = str_replace(" ","+",$post['dataOra']); ?>">Commenta</a>
                          </div>
                      </div>

                        </div>
                    </div>
                </article>
                <br/>
            <?php endforeach; }
            ?>
        </div>
        <div class="col-md-2 d-none d-md-block"></div>
</section>
<?php
// }
?>
