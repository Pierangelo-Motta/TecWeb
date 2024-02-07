
function prepareURLwithOkGet(arrKV){
    let res = "";
    for (let key in arrKV) {
        let value = arrKV[key];

        let toAdd = key + "=";

        if ( Array.isArray(value) ){
            let tmp = ""
            value.forEach(v => tmp += v + "§");
            toAdd += tmp.substring(0, tmp.length-1);
        } else {
            toAdd += value;
        }
        res += toAdd + "&";
    }
    return res.substring(0,res.length-1);
}

let arrayMissMeds; //quelli estratti dalla eventuale query di ricerca


let searchingSection = document.querySelector("#cercaMed");
let mainContainer = document.querySelector("#newMedaglieri");
let footerMore = document.querySelector("#moreRes");
let tmpInputSeachingString = document.getElementById("tmpInputSeachingString");
let actSearchingString = "";

class AJAXManager{

    rel = new ReloaderPage(500);
    userId = 0;
    prevURLquery = "include/controller/newMedagliereController.php?";

    basicAmountShow = 3;
    amountReload = -1;
    amountShowForReload = 2;
    amountChallenged = 0;
    
    constructor() {
        
        this.loadMore = document.getElementById("loadMore");

        //console.log(searchingSection + " / " +  mainContainer + " / " + footerMore);
        this.showMore(false);

        console.log("LL __ " + mainContainer.parentElement.parentElement.getAttribute("data-userId"));
        this.userId = mainContainer.parentElement.parentElement.getAttribute("data-userId");

        this.obtainMissMeds(tmpInputSeachingString.getAttribute("value"));

        this.loadMore.addEventListener("click", () => {this.byIdsToGraphic(false)});

    }

    showMore(mustShow){
        if(mustShow) {
            footerMore.firstChild.nextSibling.style.display = "block";
        } else {
            footerMore.firstChild.nextSibling.style.display = "none";
        }
    }

    showLoading(){
        mainContainer.innerHTML = "<div class=\"loader\"></div>";
    }

    obtainMissMeds(pTitMed){
        this.showLoading();
        // console.log("pT: " + pTitMed);

        let xhr = new XMLHttpRequest();
        
        xhr.onreadystatechange = () => {
            if (xhr.readyState === 4 && xhr.status === 200) {

                // console.log("PRE " + arrayMissMeds);
                console.log(xhr.responseText);
                let res = JSON.parse(xhr.responseText);
                arrayMissMeds = res;
                console.log("POST " + arrayMissMeds);
                this.manageResults();
            }
        };

        console.log("CIAO: " + this.userId);

        let args = {
            "codeQ" : 10,
            "userId" : this.userId,
            "pTitMed" : pTitMed
        }
        let ok = this.prevURLquery + prepareURLwithOkGet(args);
        //console.log("K : " + ok);

        xhr.open('GET', ok, true);
    
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest'); // linea aggiunta per settare l' "X-Requested-With header" che indica che questa è una richiesta AJAX.
        xhr.send();
    
    }

    manageResults(){
        let amountToShow = arrayMissMeds.length;
        this.amountChallenged = 0;

        if(amountToShow == 0){
            
            this.showMore(false);

            if (actSearchingString.length != 0){
                mainContainer.innerHTML = 
                    "<h3 class=\"noresults\"> Nessun medagliere contiene la stringa \"" +
                    actSearchingString +
                    "\"! </h3>";
            } else {
                mainContainer.innerHTML = "<h3 class=\"noresults\"> Niente di nuovo qui, torna la prossima volta! </h3>";
            }

        } else {
            this.amountReload = 0;
            this.byIdsToGraphic(true);
        }
        
    }


    byIdsToGraphic(isFirstTime){
        let xhr = new XMLHttpRequest();
        
        xhr.onreadystatechange = () => {
            if (xhr.readyState === 4 && xhr.status === 200) {
                
                this.showResult(xhr.responseText, isFirstTime);
            }
        };

        //l'ultimo indice all'inizio è ottenibile in questo modo
        let lastIndex = Math.min((this.basicAmountShow + ((this.amountReload) * this.amountShowForReload)), arrayMissMeds.length);
        let prevIndex = (this.amountReload == 0) ? 0 : (this.basicAmountShow + ((this.amountReload - 1) * this.amountShowForReload));
        
        //console.log(lastIndex + " / " + prevIndex + " / " + this.amountReload + " <----> " + isFirstTime);
        let indexToShow = arrayMissMeds.slice(prevIndex, lastIndex);

        let args = {
            "codeQ" : 11,
            "userId" : this.userId,
            "idMeds" : indexToShow
        }
        let ok = this.prevURLquery + prepareURLwithOkGet(args);
        //console.log("EEE " +  ok);

        xhr.open('GET', ok, true);
    
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest'); // linea aggiunta per settare l' "X-Requested-With header" che indica che questa è una richiesta AJAX.
        xhr.send();
    
    }

    showResult(textToShow, reset) {

        if (reset) {
            mainContainer.innerHTML = textToShow;
        } else {
            mainContainer.innerHTML += textToShow;
        }
        
        this.showMore(true);
        console.log(arrayMissMeds.length  + " / " + this.basicAmountShow + " / " + (this.basicAmountShow + (this.amountReload * this.amountShowForReload)));
        
        if (arrayMissMeds.length < (this.basicAmountShow + (this.amountReload * this.amountShowForReload)) ) {
            this.showMore(false);
            ///console.log(arrayMissMeds.length  + " / " + this.basicAmountShow);
        }

        this.amountReload = this.amountReload + 1;

        this.activateAdapRoutine();
    }

    activateAdapRoutine(){
        document.querySelectorAll(".descrizioneMed").forEach(elem => {
            let content = elem.innerHTML;
            const lengOfContent = content.length;
            const sogliaValue = (this.rel.isWindowLittle() ? 200 : 500);
            const redValue = (this.rel.isWindowLittle() ? 200 : 500);
            const contenitore = elem.parentElement.parentElement.parentElement.parentElement;
            const list = elem.nextElementSibling.nextElementSibling;
            let maxHeightDefault = (this.rel.isWindowLittle() ? 600 : 500);
            let maxHeightList = 200;
            let minHeightList = 200;

            let titleOfMed = elem.parentElement.parentElement.previousElementSibling;
            let titleOfMedLeng = titleOfMed.innerHTML.length;
            let sogliaTitleValue = (this.rel.isWindowLittle() ? 11 : 25);
            //console.log(" ->" + lengOfContent);
            
            if (lengOfContent > sogliaValue || titleOfMedLeng > sogliaTitleValue) {
                maxHeightDefault = maxHeightDefault + (this.rel.isWindowLittle() ? 500 : 250);
                list.style.maxHeight = ((maxHeightList / 2) + "px");
                list.style.minHeight = ((minHeightList / 2) + "px");
            }
            let text = "...<p class=\"expandMe\"> more";
            if(lengOfContent > redValue){
                elem.setAttribute("data-AllText",elem.innerHTML);
                let tmp = content.substring(0,lengOfContent/2);
                elem.innerHTML = tmp + text;
                maxHeightDefault = maxHeightDefault + 100;
            }

            contenitore.style.maxHeight = maxHeightDefault + "px";
        });
        
        
        document.querySelectorAll(".expandMe").forEach((elem) => {
            const textToExpand = elem.parentElement;
            const contenitore = elem.parentElement.parentElement.parentElement.parentElement;
            elem.addEventListener("click", () => {
                let newText = textToExpand.getAttribute("data-AllText");
                textToExpand.innerHTML = newText;
                contenitore.style.maxHeight = "2000px";
            })
        });


        document.querySelectorAll("button[name='submitButton']").forEach(elem => {
            elem.addEventListener("click", () => {
                
                let tmp = elem.getAttribute("value");
                let xhr = new XMLHttpRequest();

                //salvo l'associazione
                let args = {
                    "codeQ" : 12,
                    "userId" : this.userId,
                    "medId" : tmp
                }
                let ok = this.prevURLquery + prepareURLwithOkGet(args);
        
                //console.log(ok);

                xhr.open('GET', ok, true);
        
                xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest'); // linea aggiunta per settare l' "X-Requested-With header" che indica che questa è una richiesta AJAX.
                xhr.send();

                //nascondo la card-container
                let contToHide = elem.parentNode.parentNode.parentNode;
                contToHide.style.display = "none";
                
                
                //ricaricamento nel caso la pagina sia vuota
                let actDisplay = Math.min((this.basicAmountShow + ((this.amountReload - 1) * this.amountShowForReload)), arrayMissMeds.length);
                this.amountChallenged = this.amountChallenged + 1;
                if (this.amountChallenged == actDisplay){
                    window.location.reload();
                }
            })
        })
        
    }

}


a = new AJAXManager();

this.tmpInputSeachingString.addEventListener('input', 
                    function (evt) { 
                        actSearchingString = this.value;
                        a.obtainMissMeds(this.value);
                    });

document.getElementById("retBut").addEventListener("click", () => window.history.back() );




