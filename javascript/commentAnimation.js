
const pG = new PHPGet();

function adaptUnit(toAdapt) {
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
}
parseActTime();

let commentArea = document.getElementById("riflessioneCurrentUser");
if (commentArea != null){
    const uIDC = commentArea.getAttribute("data-userIDC");

    document.getElementById("retBut").addEventListener("click", function msg() {
        if(commentArea.value.length == 0 || confirm("Sicuro di voler tornare indietro?")){
            window.history.back(); 
        }
    });

    commentArea.addEventListener("input", () => {
        let counter = document.querySelector("label[for=riflessioneCurrentUser]").firstChild.nextElementSibling;
        const maxCharsForComment = 1020;
        console.log(commentArea.value.length);
        let newCalc = maxCharsForComment - commentArea.value.length;
        counter.innerHTML = newCalc;

        //TODO SOLVED: decidere se disabilitare il bottone o fare l'alert di avviso
        if(newCalc < 0){
            document.getElementById("createComm").disabled = true;
        } else {
            document.getElementById("createComm").disabled = false;
        }
    })


    document.getElementById("createComm").addEventListener("click", function () {
        if (commentArea.value.length > 0) {
            $.ajax({
                type: 'POST',
                url: 'include/controller/commentController.php',
                data: { "codeQ": "1",
                    "userIdP": pG.values.get("userIdPost"),
                    "dateP": pG.values.get("timePost"),
                    "userIdC": uIDC,
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
        window.location.reload();
    })


    document.querySelectorAll("img.myComment").forEach(elem => {

        let deleteImg = "images/deleteComment.png";
        let actImg = elem.getAttribute("src");

        elem.addEventListener("click", () => {
            
            if(confirm("Sei sicuro di voler eliminare il tuo commento?")){

                $.ajax({
                    type: 'POST',
                    url: 'include/controller/commentController.php',
                    data: { "codeQ": "2", 
                        "userIdP": pG.values.get("userIdPost"),
                        "dateP": pG.values.get("timePost"),
                        "userIdC": uIDC, 
                        "dateC": elem.getAttribute("data-thisdate")
                    },
                    dataType: 'json',
                });
                elem.parentElement.parentElement.style.display = "none";
            }

        });

        elem.addEventListener('mouseover', () => {
            // Change the button's background color
            elem.setAttribute("src",deleteImg);
        });
        
        elem.addEventListener('mouseout', () => {
            // Change the button's background color
            elem.setAttribute("src",actImg);
        });
    });


    } else {
        document.getElementById("retButErr").addEventListener("click", () => {
            window.history.back();
        })
    
}
