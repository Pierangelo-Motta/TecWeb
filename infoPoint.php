<?php

require_once("include/login.model.php");
require_once("include/login.controller.php");
require_once("include/model/selectors.php");

session_start();
if (!($_SESSION['loggedin'] === true)) {
    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TecWeb - Informazioni</title>


    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="css/landingPage.css">
    <link rel="stylesheet" type="text/css" href="css/infopointStyle.css">

    <link rel="icon" href="images/favicon_io/favicon.ico">


</head>
<body>
    <?php require('navbarSelect.php'); ?>

    <div class="d-flex">

        <div class="col-1"> </div>

        <div class="col-10">

            <h1> Letture premiate: il sito per lettori attenti</h1>
            <small class="form-text text-muted blockDisplay mx-auto text-center">...in ricerca di ricompensa per i loro pensieri!</small>
            <article id="introTag">
                <h2 class="subtitle">Un rapido escursus</h2>
                <p> Benvenuto nel social di riflessioni che tutti i lettori stavano aspettando! Uno spazio in cui si pubblicano frasi per il puro gusto di farlo, o magari per iniziare un piccolo dibattito su qualsiasi tematica.
                    Inoltre, per dimostrare a tutti che sei una persona che ami leggere, ti proponiamo una serie di collezioni di libri chiamate "Medaglieri".
                    Mmaa... una cosa alla volta!
                </p>
            </article>

            <article id="landingTag">
                <h2 class="h2subtitle">Partiamo dall'inizio: Landing Page  <a href="landingPage.php"><img src="images/logoLetturePremiate.png" alt="#" /></a></h2>
                <p> È la pagina di benvenuto, quella dove si "atterra" subito dopo il login.
                    Se sei nuovo di questo sito probabilmente la vedrai vuota... è normale così!
                    Infatti, in questa pagina vedrai tutti i post degli utenti che decidi di seguire
                </p>
            </article>

            <article id="discoveryTag">
            <h2 class="h2subtitle">Scoprire nuove riflessioni: Discovery Page <a href="discoveryPage.php"> <img src="images/discoveryLogo.png" alt="#" /> </a> </h2>
            <p> È la pagina dove puoi trovare riflessioni e post di persone che ancora non segui.
                Ottima per fare nuove conoscenze!
                Se non vedi alcun post probabilmente perché stai seguendo tutte le persone che hanno fatto dei post e quindi li troverai sulla landing page!
            </p>
            </article>

            <article id="profileTag">
            <h2 class="h2subtitle">La tua casa (e non solo): Profile Page <a href="profilePage.php"> <img src="<?php echo getUserImage(tmpGetUsernameById($_SESSION["id"]))?>" alt="#" /> </a> </h2>
            <p> È la pagina personale di ogni utente. È l'insieme dei tuoi post e delle tue medaglie. In giro nel sito è possibile accederci cliccando sulla sua immagine profilo o sul nickname dell'utente.
                Per accedere a una zona del profilo piuttosto che l'altra, sarà sufficente premere sull'immagine che si vedono sottostante (nel banner dell'utente ovviamente)</p>
            <h3>Zona post <img src="images/libroMedaglieri.png" alt="#" /></h3>
            <p>Semplicemente simili alla discovery e alla landing page, ma in questo caso ci saranno tutti i tuoi post</p>
            <h3>Zona medaglieri <img src="images/logoLetturePremiate.png" alt="#" /></h3>
            <p>Diamo valore alla tua partecipazione nel nostro progetto e per questo abbiamo deciso di lanciarti una sfida: creare una serie di post per poter
                collezionare quante più "medaglie" possibili. L'insieme delle "medaglie" forma quindi il "medagliere", questo librone che raccoglie tutti i tuoi successi.
                Una medaglia è univoca per un libro, e vale per più medaglieri.
                </p>
                <p>Puoi vedere il tuo ranking rispetto ad altri utenti nella apposita pagina di classifica, accessibile dalla coccarda presente sempre nella corsia dei pulsanti di controllo
                </p>
            <h3>Come lanciarsi in nuove sfide o semplicemente condividere nuove riflessioni?</h3>
            <p>Con gli appositi pulsanti presenti vicino alle icone mostrate per le due zone</p>
            <h3>Come posso seguire nuovi utenti?</h3>
            <p>Se si sta visitando la profile page di un utente diverso da sè stessi, tali pulsanti, indipendentemente dalla zona visitata, daranno questa possibilità</p>
            <p>È possibile trovare il profilo di un determinato utente cercandolo con l'apposita barra di ricerca presente nella stessa corsia dove sono presenti gli altri pulsanti di controllo</p>
        </article>


            <article id="commentTag">
            <h2 class="h2subtitle">Un piccolo focus sui commenti: Comment Page / mi piace / ADORO</h2>
            <p> Per ogni post chiunque può</p>
            <ul>
                <li><p>Apporre "mi piace" (con l'iconcina del pollicione classica)</p></li>
                <li><p>Apporre "ADORO" (con l'iconcina del cuoricino)</p></li>
                <li><p>Visualizzare la quantità di "riflessioni" (commenti) che ha ricevuto, e visualizzarli</p></li>
            </ul>
            <p> In particolare, per visualizzare, ed effuttare, i commenti a un post, è possibile aprire una pagina apposita premento sull'apposita scritta "Commenta" presente in ogni post
                Si aprirà una apposita pagina dove sarà quindi possibile:
            </p>
            <ul>
                <li><p>Vedere i commenti fatti fin ora</p></li>
                <li><p>Crearne uno nuovo (grazie all'apposito pulsante "pubblica")</p></li>
                <li><p>Eliminarne uno proprio (per farlo è possibile cliccare sulla propria immagine profilo che compare vicino al profilo utente)</p></li>
            </ul>
            </article>

            <article id="settingPage">
            <h2 class="h2subtitle">Darsi un pò di stile: Setting Page <a href="settingPage.php"> <img src="images/settingLogo.png" alt="#" /> </a> </h2>
            <p> È la pagina dove ogni utente può caricare una propria nuova foto profilo o cambiare la propria descrizione</p>
            </article>


            <article id="lastTag">
            <h2 class="h2subtitle">E infine...</h2>
            <p> Vicino alle icone prima viste, è presente quella di logout (l'ultima, in alto a sinistra), e quella delle notifiche, che mostra le ultime novità che altri utenti hanno effettuato sul tuo profilo</p>
            </article>


            <article id="acc">
                <h2> Buone norme di accessibilità.</h2>
                <p> Mettere una foto del tuo passo preferito è sicuramente il modo più interessante per permettere a molte persone di partecipare
                    alla tua rilessione... ma non per tutte!
                    Infatti, alcune sono "cieche", ma ciò nonostante si possono dilettare alla lettura grazie ai moderni screen-reader.
                    Quindi, quando effettui un post, ti preghiamo, se desideri pubblicare una foto, di scrivere un piccolo testo, anche parafrasato,
                    riportante il punto più importante della citazione. Grazie!
                </p>
            </article>

        </div>

        <div class="col-1"> </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous">
    </script>


</body>
</html>
