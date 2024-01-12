<section id="userPosts" class="d-flex">
    <div class="col-2"></div>
    <div class="col-8">
        <?php foreach ($posts as $post): ?>
            <article>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-1 text-right post">
                                <img src=<?php echo getUserImage($post["username"]); ?> alt="Immagine profilo" />
                            </div>
                            <div class="col-md-2 text-left">
                                <p><?php echo $post['username']; ?></p>
                            </div>
                        </div>

                        <div class="row">
                            <p>Libro: <?php echo $post['titolo']; ?></p>
                        </div>

                        <div id="img">
                            <img id="propic" src="<?php echo getUserImage($post["username"]); ?>" class="rounded float-left" alt="Foto profilo" width="100px">
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
                        </div>
                    </div>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
    <div class="col-2"></div>
</section>
