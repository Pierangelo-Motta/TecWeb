
let messaggioErroreUtente = document.getElementById('messaggioErroreUsername');
let messaggioErrorePassword = document.getElementById('messaggioErrorePassword');


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
})  