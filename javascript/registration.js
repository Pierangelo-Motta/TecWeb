
let messaggioErroreUtente = document.getElementById('messaggioErroreUsername');
let messaggioErrorePassword = document.getElementById('messaggioErrorePassword');
let utenteRegistratoForm = document.getElementsByTagName ('form')[0];
let utenteRegistratoMessaggio = document.getElementById('messaggioUtenteRegistrato');


document.addEventListener("DOMContentLoaded", function () {
    messaggioErroreUtente.style.display = "none";
    // console.log("here");
    if (window.location.href.endsWith("log=u")) {
        messaggioErroreUtente.style.display = "block";
    }

    messaggioErrorePassword.style.display = "none";
    // console.log("here");
    if (window.location.href.endsWith("log=p")) {
        messaggioErrorePassword.style.display = "block";
    }

    //utente registrato correttamente
    //utenteRegistrato.style.display = "none";
    if (window.location.href.endsWith("log=ok")) {
        utenteRegistratoForm.style.display = "none";
        utenteRegistratoMessaggio.style.display = "block";
    }
})  