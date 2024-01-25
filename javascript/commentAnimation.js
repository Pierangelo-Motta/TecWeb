
// console.log("ciao");

// document.write("HELLO WORLD");
// alert("HELO WORLD");



document.getElementById("retBut").addEventListener("click", function msg() {
    // alert( this.id );
    if(confirm("Sicuro di voler tornare indietro?")){
        // window.location = this.getAttribute("data-prevLink");
        // window.history.go(-1);
        window.history.back(); 

    }
});

