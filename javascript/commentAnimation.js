
// console.log("ciao");

// document.write("HELLO WORLD");
// alert("HELO WORLD");

let commentArea = document.getElementById("riflessioneCurrentUser");


document.getElementById("retBut").addEventListener("click", function msg() {
    // alert( this.id );
    if(confirm("Sicuro di voler tornare indietro?")){
        // window.location = this.getAttribute("data-prevLink");
        // window.history.go(-1);
        window.history.back(); 
    }
});

commentArea.addEventListener("input", () => {
    let counter = document.querySelector("label[for=riflessioneCurrentUser]").firstChild.nextElementSibling;
    const maxCharsForComment = 1000; //TODO: da verificare nel DB!
    console.log(commentArea.value.length);
    let newCalc = maxCharsForComment - commentArea.value.length; //DA CONTROLLARE QUESTO VALUE
    counter.innerHTML = newCalc;

    //TODO: decidere se disabilitare il bottone o fare l'alert di avviso
    if(newCalc < 0){
        document.getElementById("createComm").disabled = true;
    } else {
        document.getElementById("createComm").disabled = false;
    }
})


document.getElementById("createComm").addEventListener("click", function () {
    //richiesta AJAX per creare il commento
    let tmp = document.getElementById("createComm");
    if(tmp.disabled){
        alert("Commento troppo lungo!!");
    } else {
        alert("GO");
    }
})

document.querySelectorAll("img.myComment").forEach(elem => {

    let deleteImg = "images/deleteComment.png";
    let actImg = elem.getAttribute("src");

    elem.addEventListener("click", () => {
        
        if(confirm("Sei sicuro di voler eliminare il tuo commento?")){
            //richiesta AJAX per eliminare il commento
        }

    });

    elem.addEventListener('mouseover', () => {
        // Change the button's background color
        portalImg.setAttribute("src",deleteImg);
    });
    
    elem.addEventListener('mouseout', () => {
        // Change the button's background color
        portalImg.setAttribute("src",actImg);
    });
});



