class ChallengeMed {

    constructor(){

        this.retBut = document.getElementById("retBut");

        let page = "profilePage.php";
        let getVars = "?mode=goal";
        this.retBut.addEventListener("click", () => window.location.href = page + getVars );

        console.log("go");
    }

}

a = new ChallengeMed(); 