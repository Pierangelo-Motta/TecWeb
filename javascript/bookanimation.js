

const music = new Audio('audio/sfoglia.mp3');
music.playbackRate=4;
// const music2 = new Audio();
// //music.loop = true;
// //music.playbackRate = 2;
// //music.pause();


//class PHPGet{


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
    console.log(tmp);

    let askPointIndex = tmp.indexOf("\?");
    let okURL = tmp.substring(0, askPointIndex);
    let newURL = okURL + obtainNewQuery() + tagToPin;
    //console.log("N " + newURL);
    
    if(mustSaveOnHistory){
        window.history.replaceState({}, "", newURL);
    }
    
    
    // if (res === undefined){
    //     window.location.search =  window.location.search + "&" + keyName + "=" + newValue;
    //     //console.log(window.location.search);
    // } else {
    //     setValue(keyName,newValue);
    // }
}
 
//}


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

document.querySelectorAll(".book").forEach(flipBook);
