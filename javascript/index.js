
let messaggio = document.getElementById('messaggioErrore');

document.addEventListener("DOMContentLoaded", function(){
    messaggio.style.display = "none";
    // console.log("here");
    if (window.location.href.endsWith("log=e")){
        messaggio.style.display = "block";
    }

})  