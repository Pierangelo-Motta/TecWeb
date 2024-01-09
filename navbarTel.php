<header>
  <nav class="navbar navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
      <a href="landingPage.php"> <img id="logo" src="images/logoLetturePremiateSmall.jpg" alt="Logo con libro e medaglia"> </a>
      <form class="d-flex me-auto">
          <!-- Utilizzo dell'icona di ricerca come input -->
          <label for="search" class="visually-hidden">Search</label>
          <input id="search" class="form-control" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-primary" type="submit">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                  <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
              </svg>
          </button>
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
