
let messaggioErroreUtente = document.getElementById('messaggioErrore');
let messaggioErroreBan = document.getElementById('messaggioErroreBan');

document.addEventListener("DOMContentLoaded", function(){
    messaggioErroreUtente.style.display = "none";
    messaggioErroreBan.style.display = "none";
    // console.log("here");
    if (window.location.href.endsWith("log=e")) {
        messaggioErroreUtente.style.display = "block";
    }
    if (window.location.href.endsWith("log=b")) {
        messaggioErroreBan.style.display = "block";
    }

})  