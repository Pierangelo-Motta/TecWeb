
const pGaa = new PHPGet();


class Swapper{

    constructor() {

        this.sections = document.querySelectorAll("section");
        this.actSections = this.sections[this.sections.length - 1];

        this.portalImg = document.getElementById("portal");
        
        this.portalAbbr = document.getElementsByClassName("AbbrImgPortal")[0];

        if(this.actSections.getAttribute("id") === "userPosts"){
            this.adaptPortalByPostToGoal(this.portalImg, this.portalAbbr);
        } else {
            this.adaptPortalByGoalToPost(this.portalImg, this.portalAbbr);
        }
        
        this.addSomethingToMyAccount = document.getElementById("addSomethingToMyAccount");

        if(this.addSomethingToMyAccount !== null){
            this.addSomethingToMyAccount.addEventListener("click", () => this.redirectTo());
        }
        
    }

    redirectTo(){
        let pageMod = pGaa.values.get("mode");
        if (pageMod == "post") {
            window.location = "newPost.php";
        } else {
            window.location = "newMedagliere.php";
        }
    }

    adaptPortal(portalImg, abbrPortalImg, link, altText, otherImg){
        let userName = abbrPortalImg.getAttribute("title");
        abbrPortalImg.setAttribute("title", altText + userName);
        //TODO occhio al riutilizzo
        portalImg.setAttribute("alt", altText + userName);
        
        portalImg.addEventListener("click", () => location.replace("profilePage.php?mode=" + link + "&id=" + pGaa.values.get("id")));

        let actImg = portalImg.getAttribute("src");

        abbrPortalImg.addEventListener('mouseover', () => {
            // Change the button's background color
            portalImg.setAttribute("src", otherImg);
        });
        
        abbrPortalImg.addEventListener('mouseout', () => {
            // Change the button's background color
            portalImg.setAttribute("src", actImg);
        });
    }

    adaptPortalByPostToGoal(portalImg, abbrPortalImg) {
        this.adaptPortal(portalImg, abbrPortalImg, "goal", "Clicca qui per passare al libro dei medaglieri di ", "images/logoLetturePremiate.png");
    }

    adaptPortalByGoalToPost(portalImg, abbrPortalImg) {
        this.adaptPortal(portalImg, abbrPortalImg, "post", "Clicca qui per tornare ai post di ", "images/libroMedaglieri.png");
    }
}


new Swapper();


