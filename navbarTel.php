<?php
include_once("include/login.controller.php");
include_once("include/login.model.php");
include_once("include/model/insertOnDB.php");

// $userID = isset($_SESSION["userID"]) ? $_SESSION["userID"] : null;

$userID = isset($_SESSION['id']) ? $_SESSION['id'] : null;

// if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
//     $notifications = getNotifications($userID);
// }
// $notifications = "";

// if ($userID != 7) {
//   echo "<script src=\"https://code.jquery.com/jquery-3.6.4.min.js\"></script>";
// }

?>

  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="javascript/update_notifications.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/navbarTel.css">


<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="landingPage.php">
                <img id="logo" src="images/logoLetturePremiateSmall.jpg" alt="Logo con libro e medaglia">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
              <br />
                <form action="searchingPage.php" method="post" class="d-flex me-auto">
                    <label for="searchingText" hidden>Cerca</label>
                    <input name="searchingText" id="searchingText" class="form-control me-2" type="search" placeholder="Cerca" aria-label="Cerca" />
                    <button class="btn btn-primary" type="submit">Cerca</button>
                </form>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a href="settingPage.php">Impostazioni</a>
                    </li>
                    <li class="nav-item">
                         <a href="classifica.php">Classifica</a>
                    </li>
                    <?php if($userID != 7): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">Notifiche</a>
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
                    <?php endif; ?>
                    <li class="nav-item">
                        <a href="discoveryPage.php">Discovery</a>
                    </li>
                    <li class="nav-item">
                        <a href="profilePage.php">Profilo</a>
                    </li>
                    <li class="nav-item">
                        <a href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
