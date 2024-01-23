//import ReloaderPage from './ReloaderPage.js'
//module.exports = ReloaderPage // 👈 Export class


class ReloaderPage{

    constructor(freqReload, a, b) {
        //this.byLittleToBig = () => console.log("byLittleToBig");
        //this.byBigToLitle = () => console.log("byBigToLittle");
        
        this.whenGrow = a;
        this.whenLittle = b;

        const critValue = 768;
        this.myWidth = (window.innerWidth > 0) ? window.innerWidth : screen.width;
        this.isLittle = this.myWidth < critValue;
        
        this.freq = freqReload;

        window.addEventListener("resize", () => this.checkReload());
        this.recCheck();
    }

    checkReload(){
        if (!this.isLittle && (this.myWidth <= this.critValue)) {
            this.whenGrow();
            // this.byBigToLitle();
            window.location.reload();

        } else if (this.isLittle && this.myWidth >= this.critValue){
            this.whenLittle();
            // this.byLittleToBig();
            window.location.reload();

        } else {
            this.myWidth = (window.innerWidth > 0) ? window.innerWidth : screen.width;
        }
    }

    recCheck() {
        setTimeout(() => {
            console.log("ciao");
            this.checkReload();
            this.recCheck();
        }, this.freq);
    }

    isWindowLittle(){
        return this.isLittle;
    }

}



const rel = new ReloaderPage(500, 
    () => console.log("SONO GRANDE"), 
    () => console.log("SONO PICCOLO"));

// console.log(rel.isWindowLittle());


/***********************************
 * *************************************
 * ********************************** */




















class ChallengeMed {

    constructor(){

        this.retBut = document.getElementById("retBut");

        //this.loadMore = document.getElementById("loadMore");

        let page = "profilePage.php";
        let getVars = "?mode=goal";
        this.retBut.addEventListener("click", () => window.location.href = page + getVars );

        // if(this.loadMore != null){
        //     this.loadMore.addEventListener("click", () => this.computeNewLink() );
        // }
        

        console.log("go");

    }

    // computeNewLink(){
    //     const a = new Map();
    //     let allGets = window.location.search.substring(1);
    //     let gets = allGets.split("&");
        
    //     gets.forEach(elem => {
    //         let row = elem.split("=");
    //         a.set(row[0], row[1]);
    //     });

    //     let myKeyword = "amountLoad";
    //     let b = a.get(myKeyword);

    //     let idToJump = document.querySelector("#moreRes").previousSibling.previousSibling.firstChild.getAttribute("id");

    //     let actLink = window.location.href;
    //     if (b === undefined){
    //         window.location.href = actLink + "?" + myKeyword + "=1#" + idToJump;
    //     } else {
    //         b = parseInt(b) + 1;
    //         window.location.href = actLink.substring(0, actLink.indexOf("?")) + "?" + myKeyword + "=" + b + "#" + idToJump;
    //     }

    // }

}

a = new ChallengeMed(); 

// document.querySelectorAll(".medContainer").forEach(elem => {
//     const descrMed = elem.firstChild.firstChild.nextSibling.firstChild.nextElementSibling.firstChild;
//     const sogliaValue = 600;
//     let maxHeightDefault = 500;
//     // max-height
//     //elem.sytle.maxHeight = maxHeightDefault + "px";
//     // console.log(.lenght);
//     console.log(descrMed.innerHTML.lenght);
//     //parentNode.parentElement.parentElement.parentElement

//     // const a = descrMed.innerHTML;
//     // console.log(a.lenght);

//     if (descrMed.innerHTML.lenght > sogliaValue) {
//         maxHeightDefault = maxHeightDefault + 100;
//     }
    
//     elem.style.maxHeight = maxHeightDefault + "px";

// });

document.querySelectorAll(".descrizioneMed").forEach(elem => {
    let content = elem.innerHTML;
    const lengOfContent = content.length;
    const sogliaValue = (rel.isWindowLittle ? 400 : 500);
    const redValue = (rel.isWindowLittle ? 600 : 500);
    const contenitore = elem.parentElement.parentElement.parentElement.parentElement;
    const list = elem.nextElementSibling.nextElementSibling;
    let maxHeightDefault = (rel.isWindowLittle ? 600 : 500);
    let maxHeightList = 200;
    let minHeightList = 200;
    // max-height
    //elem.sytle.maxHeight = maxHeightDefault + "px";
    // console.log(.lenght);
    console.log(lengOfContent);
    //parentNode.parentElement.parentElement.parentElement

    // const a = descrMed.innerHTML;
    // console.log(a.lenght);

    if (lengOfContent > sogliaValue) {
        maxHeightDefault = maxHeightDefault + (rel.isWindowLittle ? 250 : 500);
        list.style.maxHeight = ((maxHeightList / 2) + "px");
        list.style.minHeight = ((minHeightList / 2) + "px");
    }
    
    contenitore.style.maxHeight = maxHeightDefault + "px";

    console.log(elem);
    let text = "...<p class=\"expandMe\"> more"; //href=\"#\"
    if(lengOfContent > redValue){
        elem.setAttribute("data-AllText",elem.innerHTML);
        let tmp = content.substring(0,lengOfContent/2);
        // contenitore.style.maxHeight = "500px";
        elem.innerHTML = tmp + text;
    }
});


document.querySelectorAll(".expandMe").forEach((elem, index) => {
    console.log(index);
    const textToExpand = elem.parentElement;
    const contenitore = elem.parentElement.parentElement.parentElement.parentElement.parentElement;
    elem.addEventListener("click", () => {
        console.log(textToExpand.getAttribute("AllText"));
        let newText = textToExpand.getAttribute("data-AllText");
        textToExpand.innerHTML = newText;
        contenitore.style.maxHeight = "2000px";
    })
});






























