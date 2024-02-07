
const pG = new PHPGet();

function refresh() {
    window.location.reload();
}

let commentArea = document.getElementById("riflessioneCurrentUser");

if (commentArea != null) {

    const uIDC = commentArea.getAttribute("data-userIDC");

    document.getElementById("retBut").addEventListener("click", () => {
        if(commentArea.value.length == 0 || confirm("Sicuro di voler tornare indietro?")){
            window.history.back(); 
        }
    });

    commentArea.addEventListener("input", () => {
        let counter = document.querySelector("label[for=riflessioneCurrentUser]").firstChild.nextElementSibling;
        const maxCharsForComment = 1020;
        //console.log(commentArea.value.length);
        let newCalc = maxCharsForComment - commentArea.value.length;
        counter.innerHTML = newCalc;

        if (newCalc <= 0 || (commentArea.value.length == 0)) {
            document.getElementById("createComm").disabled = true;
        } else {
            document.getElementById("createComm").disabled = false;
        }
    })
    document.getElementById("createComm").disabled = true;


    document.getElementById("createComm").addEventListener("click", function () {
        let actPres = commentArea.value.replace(/\s+/g,' ').trim();
        if (actPres.length > 0) {
            $.ajax({
                type: 'POST',
                url: 'include/controller/commentController.php',
                data: { "codeQ": "1",
                    "userIdP": pG.values.get("userIdPost"),
                    "dateP": pG.values.get("timePost"),
                    "userIdC": uIDC,
                    "comm": actPres
                },
                dataType: 'json',
                
                success: function(response) {
                    //console.log("OK");
                },
                error: function(xhr, status, error) {
                    commentArea.value = "";
                    window.location.reload();
                }
            });
        } else {
            //console.log(commentArea.value.length);
        }
        
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
                    success: function(response) {
                    },
                    error: function(xhr, status, error) {
                        // commentArea.value = "";
                        window.location.reload();
                    }
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
