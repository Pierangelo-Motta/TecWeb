const allGets = window.location.search.substring(1);
const gets = allGets.split("&");
const uIDP = gets[0].split("=")[1];
const tP = gets[1].split("=")[1];

console.log(uIDP + " / " + tP);


function adaptUnit(toAdapt){
    console.log(toAdapt);
    if (toAdapt < 10){
        return "0" + toAdapt;
    } else {
        return toAdapt + "";
    }
}

function parseActTime(){
    const date = new Date();
    let res = date.getFullYear() + "-";
    res += adaptUnit(date.getMonth()+1) + "-";
    res += adaptUnit(date.getDate()) + " ";
    res += adaptUnit(date.getHours()) + ":";
    res += adaptUnit(date.getMinutes()) + ":";
    res += adaptUnit(date.getSeconds());
    console.log(res);
}
parseActTime();
// const values = new Map();

// function create() {
    
//     let gets = allGets.split("&");
//     // fore
//     //this. 
    
//     gets.forEach(elem => {
//         let row = elem.split("=");
//         values.set(row[0], row[1]);
//     });
//     //return this;
// }

// function getValue(keyName) {
//     let tmp =  values.get(keyName);
//     return tmp;
// }

// create();
// // console.log("ciao");

// // document.write("HELLO WORLD");
// // alert("HELO WORLD");

let commentArea = document.getElementById("riflessioneCurrentUser");
const uIDC = commentArea.getAttribute("data-userIDC");
// console.log(uIDC);



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
    if (commentArea.value.length > 0) {
        $.ajax({
            // $_POST["userIdP"];
            // $dateP = $_POST["dateP"];
            // $userIdC = $_POST["userIdC"];
            // $dateC = $_POST["dateC"];
            // $comm = $_POST["comm"];
            type: 'POST',
            url: 'include/controller/commentController.php',
            data: { "codeQ": "1",
                "userIdP": uIDP,//values.getValue("userIdPost"),  //ricavare da link (?)
                "dateP": tP,// values.getValue("timePost"),  //ricavare da link (?)
                "userIdC": uIDC,
                // "dateC": parseActTime(), //ricavare da foto (prob)
                "comm": commentArea.value
            },
            dataType: 'json',
            success: function(response) {
                console.log("OK");
            },
            error: function(xhr, status, error) {
                console.log("NO OK");
                console.error("Errore durante la richiesta AJAX:", status, error);
                console.log(xhr.responseText);
            }
        });
    } else {
        console.log(commentArea.value.length);
    }
    commentArea.value = "";
    // let tmp = document.getElementById("createComm");
    // if(tmp.disabled){
    //     alert("Commento troppo lungo!!");
    // } else {
    //     alert("GO");
    // }
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
                    "userIdP": values.getValue("userIdPost"),  //ricavare da link (?)
                    "dateP": values.getValue("timePost"),  //ricavare da link (?)
                    "userIdC": uIDC, 
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



