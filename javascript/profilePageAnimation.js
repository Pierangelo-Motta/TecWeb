class Swapper{

    constructor(){
        this.sections = document.querySelectorAll("section");
        this.actSections = this.sections[this.sections.length-1];

        this.portalImg = document.getElementById("portal");
        this.portalAbbr = document.getElementById("portalAbbr");
        if(this.actSections.getAttribute("id") === "userPosts"){
            this.adaptPortalByPostToGoal(this.portalImg, this.portalAbbr);
        } else {
            this.adaptPortalByGoalToPost(this.portalImg, this.portalAbbr);
        }

        
    }

    adaptPortal(portalImg, abbrPortalImg, link, altText, otherImg){
        abbrPortalImg.setAttribute("title", altText);
        portalImg.setAttribute("alt", altText);
        portalImg.addEventListener("click", () => location.replace("profilePage.php?mode=" + link));
        let actImg = portalImg.getAttribute("src");

        abbrPortalImg.addEventListener('mouseover', () => {
            // Change the button's background color
            portalImg.setAttribute("src",otherImg);
        });
        
        abbrPortalImg.addEventListener('mouseout', () => {
            // Change the button's background color
            portalImg.setAttribute("src",actImg);
        });
    }

    adaptPortalByPostToGoal(portalImg, abbrPortalImg){
        this.adaptPortal(portalImg, abbrPortalImg, "goal", "Clicca qui per passare al libro dei medaglieri di username", "images/logoLetturePremiate.png");
    }

    adaptPortalByGoalToPost(portalImg, abbrPortalImg){
        this.adaptPortal(portalImg, abbrPortalImg, "post", "Clicca qui per tornare ai post dell'utente", "images/libroMedaglieri.png");
    }
}

swapper = new Swapper();