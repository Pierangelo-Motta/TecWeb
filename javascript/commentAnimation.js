const values = new Map();

function create() {
    let allGets = window.location.search.substring(1);
    let gets = allGets.split("&");
    // fore
    //this. 
    
    gets.forEach(elem => {
        let row = elem.split("=");
        values.set(row[0], row[1]);
    });
    gets.forEach(elem => {
        console.log(elem);
    });
    //return this;
}

function getValue(keyName) {
    let tmp =  values.get(keyName);
    return tmp;
}

function setValue(keyName, newValue){
    values = values.set(keyName, newValue);
}

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
    $.ajax({

        // $_POST["userIdP"];
        // $dateP = $_POST["dateP"];
        // $userIdC = $_POST["userIdC"];
        // $dateC = $_POST["dateC"];
        // $comm = $_POST["comm"];

        type: 'POST',
        url: 'include/commentController.php',
        data: { "codeQ": "2", 
            "userIdP": dataOra,  //ricavare da link (?)
            "dateP": dataOra,  //ricavare da link (?)
            "userIdC": $_SESSION["id"], 
            "dateC": dataOra, //ricavare da foto (prob)
            "comm": commentArea.value
        },
        dataType: 'json',
        // success: function(response) {
        //     console.log(response);
        // },
        // error: function(xhr, status, error) {
        //     console.error("Errore durante la richiesta AJAX:", status, error);
        //     console.log(xhr.responseText);
        // }
    });
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

            $.ajax({

                // $_POST["userIdP"];
                // $dateP = $_POST["dateP"];
                // $userIdC = $_POST["userIdC"];
                // $dateC = $_POST["dateC"];
                // $comm = $_POST["comm"];


                type: 'POST',
                url: 'include/commentController.php',
                data: { "codeQ": "2", 
                    "userIdP": dataOra,  //ricavare da link (?)
                    "dateP": dataOra,  //ricavare da link (?)
                    "userIdC": $_SESSION["id"], 
                    "dateC": dataOra //ricavare da foto (prob)
                    // "comm": commentArea.value
                },
                dataType: 'json',
                // success: function(response) {
                //     console.log(response);
                // },
                // error: function(xhr, status, error) {
                //     console.error("Errore durante la richiesta AJAX:", status, error);
                //     console.log(xhr.responseText);
                // }
            });

        } //

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



