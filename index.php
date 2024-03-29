<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="icon" type="image/x-icon" href="images/favicon_io/favicon.ico">
    <link rel="stylesheet" type="text/css" href="css/popUpStyle.css">
    <link rel="stylesheet" type="text/css" href="css/index.css">


</head>

<body>
    <div class="container">
        <!-- Cookie Consent Pop-up -->
        <div id="cookieConsent" class="cookie-consent">
            <?php include 'cookie_consent_form.php'; ?>
        </div>
        <div class="row">
            <div class="col-md-4">
            </div>
            <div class="col-md-4 text-center">
                <img id="logo" src="images/logoLetturePremiateSmall.png" alt="Logo con libro e medaglia">
            </div>
            <div class="col-md-4">
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
            </div>
            <div class="col-md-4 text-center">
                <h1>Letture Premiate</h1>
                <div class="messaggioErrore" id="messaggioErrore">Nome utente o password non corretti. Riprova per favore.</div>
                <div class="messaggioErroreBan" id="messaggioErroreBan">
                    <p>Utente Bannato!</p>
                    <a href="mailto:admin@tecweb.it?subject=Utente%20Bannato">Contatta l'amministratore</a>
                </div>
              
            </div>
            <div class="col-md-4">
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
            </div>
            <div class="col-md-6 text-center">
                <div class="card">
                    <div class="card-body">
                        <form action="login.php" method="post">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label col-form-label-sm" for="username">Username:</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" id="username" name="username" required autocomplete="username">
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label col-form-label-sm" for="password">Password:</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="password" id="password" name="password" required>
                                </div>

                            </div>
                           
                            <input class="btn btn-primary" type="submit" value="Login">
                            </form>
                            </div>
                </div>
                </div>
            <div class="col-md-3">
            </div>
            </div>

      

        <div class="row">
            <div class="col-md-4">
            </div>
            <div class="col-md-4 text-center">
                <p>Non sei ancora registrato: <a href="register.html">Registrati</a></p>
            </div>
            <div class="col-md-4">
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
            </div>
            <div class="col-md-4 text-center">
                <p id="supporto"><a href="mailto:admin@tecweb.it?subject='Richiesta%20Supporto%20Login'">Serve
                        aiuto?</a></p>
                </div>
                <div class="col-md-4">
                </div>
                </div>
                </div>

    <script src="cookie_script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
    <script src="javascript/index.js"></script>
    </body>

</html>
