

const music = new Audio('audio/sfoglia.mp3');
music.playbackRate=4;
// //music.loop = true; // //music.playbackRate = 2; // //music.pause();


const mapValues = new Map();

function create() {
    let allGets = window.location.search.substring(1);
    let gets = allGets.split("&");
    
    gets.forEach(elem => {
        let row = elem.split("=");
        mapValues.set(row[0], row[1]);
    });
    gets.forEach(elem => {
        //console.log(elem);
    });
    //return this;
}

function getValue(keyName) {
    let tmp =  mapValues.get(keyName);
    return tmp;
}

function setValue(keyName, newValue){
    //console.log("setV: " + keyName + " " + newValue);
    // mapValues[keyName] = newValue;
    // values = 
    mapValues.set(keyName, newValue);
}

function obtainNewQuery(){
    let q = "?";
    mapValues.forEach (function(value, key) {
        q += key + '=' + value + "&"; //TODO: funziona solo con valori atomici, non con stinghe (per ora)!
    })
    return q.substring(0, q.length-1);
}

function saveValue(keyName, newValue, mustSaveOnHistory = false, tagToPin = ""){
    // let res = mapValues.get(keyName);
    //console.log(keyName + " " + newValue);
    setValue(keyName,newValue);
    
    let tmp = window.location.href;
    //console.log(tmp);

    let askPointIndex = tmp.indexOf("\?");
    let okURL = tmp.substring(0, askPointIndex);
    let newURL = okURL + obtainNewQuery() + tagToPin;
    //console.log("N " + newURL);
    
    if(mustSaveOnHistory){
        window.history.replaceState({}, "", newURL);
    }
    
}

create();



const flipBook = (elBook) => {
    const myVar = "cP";
    let res = getValue(myVar);
    //console.log("AAA: " + res);

    if(res === undefined){
        saveValue(myVar, 0, true, "");
        // console.log(obtainNewQuery());
        window.location.reload();
        // res = getValue(myVar);
    }
    elBook.style.setProperty("--c", res); // Set current page

    elBook.querySelectorAll(".page").forEach((page, idx) => {
        page.style.setProperty("--i", idx);
        page.addEventListener("click", (evt) => {

            const curr = evt.target.closest(".back") ? idx : idx + 1;
            elBook.style.setProperty("--c", curr);
            music.play();
            
            setTimeout(() => {    
                //console.log(evt);
                
                saveValue(myVar, curr, true, "#userGoal");
                //let res = getValue(myVar);
                

            } , 1250); //TODO : modo becero, ma funziona

            
        });
    });

    // document.querySelectorAll("article ol li p a").forEach(elem => {
    //     elem.addEventListener("click", () => {
    //         let actInd = elBook.style.getProperty("--c");
    //         saveValue(myVar,actInd);
    //     });
    // });
};

// document.querySelectorAll()[1].style.fontSize = 10px;


// const isComputer = () => {
//     const ua = navigator.userAgent;
//     if (/(tablet|ipad|playbook|silk)|(android(?!.*mobi))/i.test(ua)) {
//         return false;
//     }
//     if (
//         /Mobile|iP(hone|od)|Android|BlackBerry|IEMobile|Kindle|Silk-Accelerated|(hpw|web)OS|Opera M(obi|ini)/.test(
//         ua
//         )
//     ) {
//         return false;
//     }
//     return true;
// };

function managePrint(newPage, facciates, classToAdd, isInit = false){

    const maxPageIndex = facciates.length - 1; //indice della copertina
    const delta = 0;
    
    startIndex = (newPage - (delta + 1));
    if(isInit || startIndex < 0){
        startIndex = 0;
    }
    
    endIndex = (newPage + (delta + 1));
    if(isInit || endIndex > maxPageIndex){
        endIndex = maxPageIndex;
    }
    
    // console.log((facciates.length - 1) + " / " + startIndex + " / " + endIndex);


    for(let i = startIndex; i <= endIndex; i++){
        if (Math.abs(i - newPage) > delta){
            facciates[i].classList.remove(classToAdd);
            // facciates[i].classList.parentNode().style
        } else {
            facciates[i].classList.add(classToAdd);
        }
        a = Math.floor(i/2);
        b = Math.floor(newPage/2);
        console.log(i + " pages:  " + a + " / " + b);
        if (a == b) {
            console.log("block");
            facciates[i].parentNode.style.display = "block";
        } else {
            console.log("none");
            facciates[i].parentNode.style.display = "none";
        }
    }

}

const changePage = (elBook) => {
    // document.querySelector("p").forEach(e => {console.log("ciao");});
    
    const facciates = document.querySelectorAll(".facciata");
    const special = "actFac";

    const myVar = "cP";
    let res = getValue(myVar);

    if(res === undefined) { //se non è settato settalo
        saveValue(myVar, 0, true, "");
        window.location.reload();
    }

    const maxPageIndex = facciates.length - 1; //indice della copertina
    if (res > facciates.length) { //se per qualche motivo eccede, riportalo al max accettabile
        res = maxPageIndex;
    }

    elBook.style.setProperty("--c", res); // Set current page
    console.log("ALFA :" + res);
    managePrint(res,facciates,special, true);
    
    //facciates[res].classList.add(special); //View act page
    

    elBook.querySelectorAll(".facciata").forEach((facc,idx) => {
        facc.style.setProperty("--i", idx); //questa la eredito ma per ora non mi serve

        facc.addEventListener("click", (evt) => {
            var width = (window.innerWidth > 0) ? window.innerWidth : screen.width;
            var critVal = width/2;
            music.play();

            var newPage = res;
            // console.log(evt);

            if (evt.x < critVal) {
                if(newPage != 0){
                    // console.log("BBBB");
                    newPage--;
                }
                console.log("GIRA A SX: " + newPage);

            } else {
                if(newPage != maxPageIndex){
                    // console.log("AAAA");
                    newPage++;
                }
                console.log("GIRA A DX: " + newPage);
            
            }


            // console.log(facciates[res].classList + " / " + facciates[newPage].classList);
            
            // console.log(facciates[res].classList + " / " + facciates[newPage].classList);
            managePrint(newPage, facciates, special);

            res = newPage;
            
            // const curr = evt.target.closest(".back") ? idx : idx + 1;
            // elBook.style.setProperty("--c", curr);
            // music.play();
            
            setTimeout(() => {    
                
                saveValue(myVar, res, true, "#userGoal");
                //let res = getValue(myVar);
                

                } , 250); //TODO : modo becero, ma funziona
            
            });
    });

};

function startView() {
    if (!isLittle){
        document.querySelectorAll(".book").forEach(flipBook);
    } else {
        document.querySelectorAll(".book").forEach(changePage);
    }
    
}




// console.log(isComputer());
const criticalSize = 768;
var width = (window.innerWidth > 0) ? window.innerWidth : screen.width;

const isLittle = width < criticalSize;
const bigSize = (600*2);
const isVeryBig = width > bigSize;
this.startView();



//cambiare dispositivo (ma anche banalmente dimensione)
window.addEventListener("resize", function(){
    if(isVeryBig && width <= bigSize ){
        window.location.reload();
    } else if (!isVeryBig && width >= bigSize){
        window.location.reload();
    }

    if (!isLittle && ((width <= criticalSize))){
        window.location.reload();
        //ricarica : diventa piccolo
    } else if (isLittle && width >= criticalSize){
        window.location.reload();
        //ricarica : diventa grande
    } else {
        width = (window.innerWidth > 0) ? window.innerWidth : screen.width;
    }

});


const amount = document.querySelectorAll(".facciata").length;
document.querySelectorAll(".facciata").forEach((elem, index) => {
    if ((index == 0) || (index == (amount-1))){
        return;
    }
    
    const firstArt = elem.firstChild;
    const secArt = firstArt.nextSibling;

    const title = firstArt.firstChild.nextSibling;
    const descript = title.nextSibling.nextSibling;
    const subtitle = secArt.firstChild;
    const listLibri = subtitle.nextSibling;

    let defaultTitleSize = isLittle ? 22 : 36; //TODO controlla 20
    let defaultdescriptSize = isLittle ? 16 : 18;
    let defaultSubtitleSize = isLittle ? 16 : 25;  //TODO controlla 16
    let defaultListaLibriHeight = isLittle ? 150 : 200;

    const maxCharsTitle = 50;
    const maxCharsDescp = 800;
    const sogliaValueTitle = 25;
    const sogliaValueDescp = isLittle ? 450 : 600;

    let flag = false;

    if (descript.innerHTML.length > sogliaValueDescp){
        let maxDimPerc = isLittle ? 40 : 30;
        let offset = (maxCharsDescp - sogliaValueDescp);
        let coeff = (maxCharsDescp - descript.innerHTML.length) / offset;

        console.log(title.innerHTML);
        console.log(descript.innerHTML);

        coeff = 1 - coeff;
        console.log("opp " + coeff);
        coeff = coeff * maxDimPerc;
        console.log("adapt " + coeff);
        coeff = coeff / 100;
        console.log("div " + coeff);
        coeff = 1 - coeff;
        console.log(coeff);

        defaultdescriptSize = defaultdescriptSize * coeff;
        
        flag = true;
    }

    descript.style.fontSize = Math.round(defaultdescriptSize) + "px";


    if (title.innerHTML.length > sogliaValueTitle){
        
        let maxDimPerc = 25;
        let offset = (maxCharsTitle - sogliaValueTitle);

        let coeff = (maxCharsTitle - title.innerHTML.length) / offset;
        //console.log("- " + coeff);
        
        coeff = 1 - coeff;
        //console.log("opp " + coeff);
        coeff = coeff * maxDimPerc;
        //console.log("adapt " + coeff);
        coeff = coeff / 100;
        //console.log(coeff);
        coeff = (1 - coeff);

        defaultTitleSize = defaultTitleSize * coeff;
        
        defaultSubtitleSize = defaultSubtitleSize * coeff;
        
        if(flag){
            listLibri.style.maxHeight = (defaultListaLibriHeight / 2) + "px";
            listLibri.style.minHeight = (defaultListaLibriHeight / 2) + "px";
        }
        //let coeff = 1 - ((300 + (element.innerHTML.length - 800)) / 1000);
        // console.log(coeff);
        
        // console.log(newHight);
    }
    title.style.fontSize = Math.round(defaultTitleSize) + "px";
    subtitle.style.fontSize = Math.round(defaultSubtitleSize) + "px";

    if ((window.innerWidth > (600*2))){
        secArt.style.marginTop = "10%";
    }
});

