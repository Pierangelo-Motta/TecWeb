<?php
include_once("include/login.controller.php");
include_once("include/login.model.php");
include_once("include/model/insertOnDB.php");

$userID = isset($_SESSION["userID"]) ? $_SESSION["userID"] : null;

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    $notifications = getNotifications($userID);
}
?>
<head>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="javascript/update_notifications.js"></script>
</head>

<header>
    <nav class="navbar navbar-expand navbar-light bg-light">
        <div class="container-fluid"> <!--div contenitore-->
            <a href="landingPage.php"> <img id="logo" src="images/logoLetturePremiateSmall.jpg" alt="Logo con libro e medaglia"> </a>
            <form action="searchingPage.php" method="post" class="d-flex me-auto" >
                <!-- TODO: sostittuire con immagine lente: meno spazio occupato-->

                <!-- JP: mi dava un errore di accessibilità, quindi intanto lo segno per posteri
                  Essendo che qua dobbiamo gestire un form, una label è necessaria
                  So che non è completo, ma intanto l'ho segnato per non dimenticarlo -->

                <input name="searchingText" class="form-control me-2" type="search" placeholder="Search" aria-label="Search" />
                <button class="btn btn-primary" type="submit">Search</button>
            </form>

          <div id="username" class="d-flex"><?php echo "Ciao " . ucfirst($_SESSION["username"]);?></div>
          <div class="d-flex" id="navbarSupportedContent"> <!--div schermo ridotto-->
            <ul class="navbar-nav">
              <li class="nav-item">
                <a href="settingPage.php"><img src="images/settingLogo.png" alt="Impostazioni"></a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">
                  <img src="images/notifyLogo.png" alt="Notifiche">
                </a>
                <ul id="notification-list" class="dropdown-menu">
                  <?php
                  foreach ($notifications as $notification) {
                      $followerId = $notification["utenteIdPost"];
                      $followerUsername = getUserName($followerId, $conn);
                      $notificationMessage = "$followerUsername ha iniziato a seguirti!";
                      echo '<li><a class="dropdown-item" href="#">' . $notificationMessage . '</a></li>';
                  }
                  ?>
              </ul>
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
