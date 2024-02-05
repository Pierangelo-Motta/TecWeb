<?php
include_once("include/login.controller.php");
include_once("include/login.model.php");
include_once("include/model/insertOnDB.php");


// userID non esiste
//$userID = isset($_SESSION["userID"]) ? $_SESSION["userID"] : null;

//TODO: sistemare la navbar del tel se OK!
$userID = isset($_SESSION['id']) ? $_SESSION['id'] : null;  //FIXME: errore nella variabile
// print_r($_SESSION);
// if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
  // $notifications = getNotifications($userID);  //FIXME: non necessario?
// }
$notifications = "";

if ($userID != 7) {
  echo "<script src=\"https://code.jquery.com/jquery-3.6.4.min.js\"></script>";
}

?>
<!-- <head> -->
  <!-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> -->
  <script src="javascript/update_notifications.js"></script>
<!-- </head> -->

<header>
    <nav class="navbar navbar-expand navbar-light bg-light">
        <div class="container-fluid"> <!--div contenitore-->
            <a href="landingPage.php"> <img id="logo" src="images/logoLetturePremiateSmall.png" alt="Logo con libro e medaglia"> </a>
            <form action="searchingPage.php" method="post" class="d-flex me-auto" >
                <!-- TODO: sostittuire con immagine lente: meno spazio occupato-->

                <label for="searchingText" hidden>Cerca</label>
                <input name="searchingText" id="searchingText" class="form-control me-2" type="search" placeholder="Search" aria-label="Search" />
                <button class="btn btn-primary" type="submit" title="Ricerca">Search</button>
            </form>

          <div id="username" class="d-flex"><?php echo "Ciao " . ucfirst($_SESSION["username"]);?></div>
          <div class="d-flex" id="navbarSupportedContent"> <!--div schermo ridotto-->
            <ul class="navbar-nav">
              <li class="nav-item">
                  <a href="infoPoint.php" title="Informazioni"><img src="images/infoimg_no_background.png" alt="Informazioni"></a>
                </li>
              <li class="nav-item">
                <a href="settingPage.php" title="Settings"><img src="images/settingLogo.png" alt="Impostazioni"></a>
              </li>
              <li class="nav-item">
                <a href="classifica.php" title="Classifica"><img src="images/medagliereNewIcons/medagliaLogo.png" alt="Impostazioni"></a>
              </li>

              <?php if($userID != 7): ?>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false" title="Notifiche">
                  <img src="images/notifyLogo.png" alt="Notifiche">
                </a>
                  <ul id="notification-list" class="dropdown-menu">
                  <?php
                    if($notifications){
                      foreach ($notifications as $notification) {
                          echo '<li><a class="dropdown-item" href="#">' . $notification . '</a></li>';
                      }
                    }
                  ?>
                </ul>
              </li>
              <?php endif; ?>

              <li class="nav-item dropdown">
                <a href="discoveryPage.php" title="Discovery Page"><img src="images/discoveryLogo.png" alt="Scopri"></a>
              </li>
              <li class="nav-item">
                <a href="profilePage.php" title="Profilo"><img src=<?php echo getUserImage($_SESSION["username"]); ?> alt="Immagine Profilo"> </a>
              </li>
                <li class="nav-item">
                <a href="logout.php" title="Esci"><img src="images/log-out.png" alt="Logout"></a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
</header>
