<header>
  <nav class="navbar navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
      <a href="landingPage.php"> <img id="logo" src="images/logoLetturePremiateSmall.jpg" alt="Logo con libro e medaglia"> </a>
      <form class="d-flex me-auto">
          <!-- TODO: sostittuire con immagine lente: meno spazio occupato-->
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-primary" type="submit">Search</button>
      </form>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Letture Premiate</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
            <li class="nav-item">
              <a href="settingPage.php">Impostazioni</a>
            </li>
            <li class="nav-item">
              <a>Notifiche</a>
            </li>
            <li class="nav-item">
              <a>Discovery</a>
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
    </div>
  </nav>
</header>
