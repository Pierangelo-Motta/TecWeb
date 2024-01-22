
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
        // console.log(elem + " - " + mapValues.get(elem));
    });
    //return this;
}

function getValue(keyName) {
    let tmp =  mapValues.get(keyName);
    return tmp;
}

function setValue(keyName, newValue){
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
    
    setValue(keyName,newValue);
    
    mapValues.forEach(function(value, key) {
        console.log(key + " = " + value);
    });

    let tmp = window.location.href;

    let askPointIndex = tmp.indexOf("\?");
    let okURL = tmp.substring(0, askPointIndex);
    let newURL = okURL + obtainNewQuery() + tagToPin;
    console.log(obtainNewQuery() + " § " + newURL);
    //console.log("N " + newURL);
    
    if(mustSaveOnHistory){
        window.history.replaceState({}, "", newURL);
        //window.history.pushState({}, "", newURL);
    }
    
}


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

};

//setta la pagina attuale da vedere
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

    for(let i = startIndex; i <= endIndex; i++){
        if (Math.abs(i - newPage) > delta){
            facciates[i].classList.remove(classToAdd);
            // facciates[i].classList.parentNode().style
        } else {
            facciates[i].classList.add(classToAdd);
        }
        a = Math.floor(i/2);
        b = Math.floor(newPage/2);
        //console.log(i + " pages:  " + a + " / " + b);
        if (a == b) {
            ////console.log("block");
            facciates[i].parentNode.style.display = "block";
        } else {
            //console.log("none");
            facciates[i].parentNode.style.display = "none";
        }
    }

}

const changePage = (elBook) => {
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
    //console.log("ALFA :" + res);
    managePrint(res,facciates,special, true);
    
    //facciates[res].classList.add(special); //View act page
    

    elBook.querySelectorAll(".facciata").forEach((facc,idx) => {
        facc.style.setProperty("--i", idx); //questa la eredito ma per ora non mi serve

        facc.addEventListener("click", (evt) => {
            let width = (window.innerWidth > 0) ? window.innerWidth : screen.width;
            let critVal = width/2;
            music.play();
            
            let newPage = res;

            if (evt.x < critVal) {
                if(newPage != 0){
                    // console.log("BBBB");
                    newPage--;
                }
                //console.log("GIRA A SX: " + newPage);

            } else {
                if(newPage != maxPageIndex){
                    // console.log("AAAA");
                    newPage++;
                }
                //console.log("GIRA A DX: " + newPage);
            
            }

            managePrint(newPage, facciates, special);

            res = newPage;
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




/////////////////////////////////////////////////////////////////////////////////////////////////////////




create();


// console.log(isComputer());
const criticalSize = 768;
let width = (window.innerWidth > 0) ? window.innerWidth : screen.width;

const isLittle = width < criticalSize;
const bigSize = (600*2);
const isVeryBig = width > bigSize;
this.startView();



/////////////////////////////////////////////////////////////////

function checkReload(){
    if(isVeryBig && width <= bigSize ){
        window.location.reload();
    } else if (!isVeryBig && width > bigSize){
        window.location.reload();
    }

    if (!isLittle && ((width <= criticalSize))){
        //ricarica : diventa piccolo
        
        let a = getValue("cP");
        //setTimeout(() => console.log("ATTEMP " + a), 700);
        let b = (a == 0) ? a : ((a * 2) - 1);
        let c = Math.floor(b);
        console.log("ATTEMP2 " + a + " / " + b + " / " + c);
        saveValue("cP", c, true, "#userGoal");
        console.log("ATTEMP3 " + getValue("cP"));
        console.log("LINK: " + window.location.href);
        
        window.location.reload();
        
    } else if (isLittle && width > criticalSize){
        //ricarica : diventa grande
        let a = parseInt(getValue("cP"));
        let b = (a + 1) / 2;
        let c = Math.floor(b);
        console.log("ATTEMP4 " + a + " / " + Number.isInteger(a) + " / " + b + " / " + c);
        setValue("cP", c);
        saveValue("cP", c, true, "#userGoal");
        console.log("ATTEMP5 " + getValue("cP"));
        console.log("LINK: " + window.location.href);
        
        window.location.reload();
        
    } else {
        width = (window.innerWidth > 0) ? window.innerWidth : screen.width;
    }
}

function recCheck(){
    setTimeout(() => {
        checkReload();
        recCheck();
    }, 500);
}

//cambiare dispositivo (ma anche banalmente dimensione)
window.addEventListener("resize", () => checkReload());

recCheck();

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
        let maxDimPerc = isLittle ? 40 : isVeryBig ? 5 : 25;
        let offset = (maxCharsDescp - sogliaValueDescp);
        let coeff = (maxCharsDescp - descript.innerHTML.length) / offset;

        //console.log(title.innerHTML);
        //console.log(descript.innerHTML);

        coeff = 1 - coeff;
        //console.log("opp " + coeff);
        coeff = coeff * maxDimPerc;
        ///console.log("adapt " + coeff);
        coeff = coeff / 100;
        //console.log("div " + coeff);
        coeff = 1 - coeff;
        //console.log(coeff);

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
            listLibri.style.maxHeight = (defaultListaLibriHeight / (isVeryBig ? 1.5 : 2)) + "px";
            listLibri.style.minHeight = (defaultListaLibriHeight / (isVeryBig ? 1.5 : 2)) + "px";
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
