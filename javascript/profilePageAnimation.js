//class PHPGet{


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
    //return this;
}

function getValue(keyName) {
    let tmp =  values.get(keyName);
    return tmp;
}

//function setValue(keyName, newValue){
    //values = values.set(keyName, newValue);
//}

 



//}

class Swapper{

    // import { create as summonPHPget, getValue as getPHPGet, setValue as setPHPValue} from "./PHPGet.js";
    
    constructor() {

        create();

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
        let userName = abbrPortalImg.getAttribute("title");
        abbrPortalImg.setAttribute("title", altText + userName);
        //TODO occhio al riutilizzo
        portalImg.setAttribute("alt", altText + userName);
        
        portalImg.addEventListener("click", () => location.replace("profilePage.php?mode=" + link + "&id=" + getValue("id")));

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
        this.adaptPortal(portalImg, abbrPortalImg, "goal", "Clicca qui per passare al libro dei medaglieri di ", "images/logoLetturePremiate.png");
    }

    adaptPortalByGoalToPost(portalImg, abbrPortalImg){
        this.adaptPortal(portalImg, abbrPortalImg, "post", "Clicca qui per tornare ai post di ", "images/libroMedaglieri.png");
    }
}


new Swapper();


