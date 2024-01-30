
let messaggioErroreUtente = document.getElementById('messaggioErrore');

document.addEventListener("DOMContentLoaded", function(){
    messaggioErroreUtente.style.display = "none";
    // console.log("here");
    if (window.location.href.endsWith("log=e")){
        messaggioErroreUtente.style.display = "block";
    }

})  