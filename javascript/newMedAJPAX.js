
function prepareURLwithOkGet(arrKV){
    let res = "";
    for (let key in arrKV) {
        let value = arrKV[key];

        let toAdd = key + "=";

        if ( Array.isArray(value) ){
            let tmp = ""
            value.forEach(v => tmp += v + "§"); //anche qui gestire caso stringhe
            toAdd += tmp.substring(0, tmp.length-1);
        } else if (false) {
            //se è stringa, ma ancora non ho avuto modo di farlo
        } else {
            toAdd += value;
        }
        res += toAdd + "&";
    }
    return res.substring(0,res.length-1);
}

const arrayMissMeds = []; //quelli estratti dalla eventuale query di ricerca


let searchingSection = document.querySelector("#cercaMed");
let mainContainer = document.querySelector("#newMedaglieri");
let footerMore = document.querySelector("#moreRes");
let tmpInputSeachingString = document.getElementById("tmpInputSeachingString");


class AJAXManager{

    
    constructor() {
        // this.searchingSection = document.querySelector("#cercaMed");
        // this.mainContainer = document.querySelector("#newMedaglieri");
        // this.footerMore = document.querySelector("#moreRes");
        //  = document.getElementById("tmpInputSeachingString");
        this.loadMore = document.getElementById("loadMore");

        console.log(searchingSection + " / " +  mainContainer + " / " + footerMore);
        this.showMore(false);

        this.userId = mainContainer.parentElement.getAttribute("data-userId");
        //console.log("BARANDO: " + this.userId);

        this.prevURLquery = "include/controller/newMedagliereController.php?";

        //tmpInputSeachingString

        this.basicAmountShow = 2;
        this.amountReload = 0;
        this.amountShowForReload = 1;
        this.amountChallenged = 0;

        this.obtainMissMeds(tmpInputSeachingString.getAttribute("value"));

        this.loadMore.addEventListener("click", () => {this.byIdsToGraphic(false)});

    }

    showMore(mustShow){
        if(mustShow){
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
        console.log("pT: " + pTitMed);

        let xhr = new XMLHttpRequest();
        
        xhr.onreadystatechange = () => {
            if (xhr.readyState === 4 && xhr.status === 200) {
    
                //console.log("pppp -> " + xhr.responseText);
                console.log("PRE " + arrayMissMeds);
                arrayMissMeds.length = 0;
                console.log("DURANTE " + arrayMissMeds);
                let res = JSON.parse(xhr.responseText);
                res.forEach(id => arrayMissMeds.push(id));
                console.log("POST " + arrayMissMeds);
                this.manageResults();
            }
        };

        
        // let askFor = ("?codeQ=" + 0);
        let args = {
            "codeQ" : 10,
            "userId" : this.userId,
            "pTitMed" : pTitMed
        }
        let ok = this.prevURLquery + prepareURLwithOkGet(args);
        console.log("K : " + ok);

        xhr.open('GET', ok, true);
    
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest'); // linea aggiunta per settare l' "X-Requested-With header" che indica che questa è una richiesta AJAX.
        xhr.send();
    
        // console.log("xhr done: inside");
    
    }

    manageResults(){
        let amountToShow = arrayMissMeds.length;
        this.amountChallenged = 0;
        if(amountToShow == 0){
            
            this.showMore(false);
            mainContainer.innerHTML = "<h3 class=\"noresults\"> Nessun medagliere contiene la stringa \"\"! </h3>";

            //NO RISULTATI
        } else {
            this.byIdsToGraphic(true);
        }
        
    }


    byIdsToGraphic(isFirstTime){
        let xhr = new XMLHttpRequest();
        
        xhr.onreadystatechange = () => {
            if (xhr.readyState === 4 && xhr.status === 200) {
    
                //console.log("pppp -> " + xhr.responseText);
    
                // let res = JSON.parse(xhr.responseText);
                // res.forEach(id => arrayMissMeds.push(id));
                // mainContainer.innerHTML = xhr.responseText;
                this.showResult(xhr.responseText, isFirstTime);
            }
        };

        //l'ultimo indice all'inizio è ottenibile in questo modo
        let lastIndex = Math.min((this.basicAmountShow + ((this.amountReload) * this.amountShowForReload)), arrayMissMeds.length);
        let prevIndex = (this.amountReload == 0) ? 0 : (this.basicAmountShow + ((this.amountReload - 1) * this.amountShowForReload));
        this.amountReload = this.amountReload + 1;
        let indexToShow = arrayMissMeds.slice(prevIndex, lastIndex);

        // if(isFirstTime){
        //     lastIndex = 
        //     indexToShow = ;
        // } else {
        //     lastIndex = Math.min(this.basicAmountShow, arrayMissMeds.length);
        //     indexToShow = arrayMissMeds.slice(0, lastIndex);
        // }

        let args = {
            "codeQ" : 11,
            "userId" : this.userId,
            "idMeds" : indexToShow
        }
        let ok = this.prevURLquery + prepareURLwithOkGet(args);
        // console.log("EEE " +    ok);

        xhr.open('GET', ok, true);
    
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest'); // linea aggiunta per settare l' "X-Requested-With header" che indica che questa è una richiesta AJAX.
        xhr.send();
    
        // console.log("xhr done: inside");
    }

    showResult(textToShow, reset) {

        if (reset) {
            mainContainer.innerHTML = textToShow;
        } else {
            mainContainer.innerHTML += textToShow;
        }
        
        this.showMore(true);
        if(arrayMissMeds.length < (this.basicAmountShow + (this.amountReload * this.amountShowForReload))) {
            this.showMore(false);
            ///console.log(arrayMissMeds.length  + " / " + this.basicAmountShow);
        }

        this.activateAdapRoutine();
    }

    activateAdapRoutine(){
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


        document.querySelectorAll("button[name='submitButton']").forEach(elem => {
            elem.addEventListener("click", () => {
                
                let tmp = elem.getAttribute("value");
                // let medId = arrayMissMeds[tmp];
                //console.log("INDEX : " + tmp + " / " + medId);

                let xhr = new XMLHttpRequest();

                //salvo l'associazione
                let args = {
                    "codeQ" : 12,
                    "userId" : this.userId,
                    "medId" : tmp
                }
                let ok = this.prevURLquery + prepareURLwithOkGet(args);
        
                console.log(ok);

                xhr.open('GET', ok, true);
        
                xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest'); // linea aggiunta per settare l' "X-Requested-With header" che indica che questa è una richiesta AJAX.
                xhr.send();

                //xhr.onreadystatechange = () => {
                //if (xhr.readyState === 4 && xhr.status === 200) {
        
                //nascondo la card-container
                let contToHide = elem.parentNode.parentNode.parentNode;
                contToHide.style.display = "none";
                
                
                //ricaricamento nel caso la pagina sia vuota
                let actDisplay = Math.min((this.basicAmountShow + ((this.amountReload - 1) * this.amountShowForReload)), arrayMissMeds.length);
                this.amountChallenged = this.amountChallenged + 1;
                //console.log(this.amountChallenged + " / " + actDisplay);
                if (this.amountChallenged == actDisplay){
                    window.location.reload();
                }
                    //if(this.)
                //}
                //};

            })
        })
        
    }


}


a = new AJAXManager();

this.tmpInputSeachingString.addEventListener('input', 
                    //(evt) => { console.log(evt.srcElement.value); });
                    //(evt) => this.tmpInputSeachingString.getAttribute()));
                    // (evt) => this.obtainMissMeds(evt.srcElement.value)
                    function (evt) { a.obtainMissMeds(this.value)});






// function showAutocompleteBooks(inputValue, tipologia, classe) {

//     let tipo = tipologia;
//     let cl = classe;
    
//     let xhr = new XMLHttpRequest();

//     xhr.onreadystatechange = function () {
//         if (xhr.readyState === 4 && xhr.status === 200) {

//             //console.log(xhr.responseText);

//             let bookList = JSON.parse(xhr.responseText);
//             filteredBooks = bookList.filter(function (book) {
//                 return book.titolo;//.toLowerCase().includes(inputValue.toLowerCase());
//             });

//             // console.log(filteredUsers);
//             fb = filteredBooks;

//             let autocompleteResults = document.getElementById(cl);
//             autocompleteResults.innerHTML = '';

//             filteredBooks.forEach(function (book) {
//                 // console.log(book);
//                 let option = document.createElement('div');
//                 option.textContent = book.titolo;
//                 option.addEventListener('click', function () {
//                     document.getElementById(tipo).value = book.titolo;
//                     autocompleteResults.innerHTML = '';
//                 });
//                 autocompleteResults.appendChild(option);
//                 // console.log(option);
//             });

//             // Show/hide the autocomplete results container based on the number of results
//             autocompleteResults.style.display = filteredBooks.length > 0 ? 'block' : 'none';
//             autocompleteResults.style.color = "#0b5ed7";
//             // console.log(autocompleteResults);


//         }
//     };

//     let askFor = ("?pTit=" + inputValue);
//     let prev = "include/called/obtainSimilarBook.php";
//     let ok = prev + askFor;
//     xhr.open('GET', ok, true);

//     xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest'); // linea aggiunta per settare l' "X-Requested-With header" che indica che questa è una richiesta AJAX.
//     xhr.send();

//     // console.log("xhr done: inside");

// }


// document.addEventListener('click', function (event) {
    
//     // manage user
//     document.getElementById('nomeLibroId').addEventListener('input', function () {
//         showAutocompleteBooks(this.value, 'nomeLibroId', 'autocompleteBoooksResults');
//         // console.log("xhr done: outside");
//     });

// });