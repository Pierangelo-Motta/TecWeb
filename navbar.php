<?php
include_once("include/login.controller.php");
include_once("include/login.model.php");
?>
<header>
    <nav class="navbar navbar-expand navbar-light bg-light">
        <div class="container-fluid"> <!--div contenitore-->
            <a href="landingPage.php"> <img id="logo" src="images/logoLetturePremiateSmall.jpg" alt="Logo con libro e medaglia"> </a>
            <form class="d-flex me-auto">
                <!-- TODO: sostittuire con immagine lente: meno spazio occupato-->
                
                <!-- JP: mi dava un errore di accessibilità, quindi intanto lo segno per posteri
                  Essendo che qua dobbiamo gestire un form, una label è necessaria
                  So che non è completo, ma intanto l'ho segnato per non dimenticarlo -->

                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-primary" type="submit">Search</button>
            </form>

          <div id="username" class="d-flex"><?php echo "Ciao " . ucfirst($_SESSION["username"]);?></div>
          <div class="d-flex" id="navbarSupportedContent"> <!--div schermo ridotto-->
            <ul class="navbar-nav">
              <li class="nav-item">
                <a href="settingPage.php"><img src="images/settingLogo.png" alt="Impostazioni"></a>
              </li>
              <li class="nav-item">
                <img src="images/notifyLogo.png" alt="Notifiche">
              </li>
              <li class="nav-item dropdown">
                <a href="discoveryPage.php"><img src="images/discoveryLogo.png" alt="Scopri"></a>
              </li>
              <li class="nav-item">
                <a href="profilePage.php"><img src=<?php echo getUserImage($_SESSION["username"]); ?> alt="Immagine Profilo"> </a>
              </li>
                <li class="nav-item">
                <a href="logout.php"><img src="images/log-out.png" alt="Logout"></a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
</header>
