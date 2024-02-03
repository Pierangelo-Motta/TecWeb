
const music = new Audio('audio/sfoglia.mp3');
music.playbackRate = 4;

const pG = new PHPGet();

const flipBook = (elBook) => {
    const myVar = "cP";
    let res = pG.values.get(myVar); 
    
    if(res === undefined){
        pG.saveValue(myVar, 0, true, "");
        window.location.reload();
    }
    elBook.style.setProperty("--c", res); // Set current page

    elBook.querySelectorAll(".page").forEach((page, idx) => {
        page.style.setProperty("--i", idx);
        page.addEventListener("click", (evt) => {

            const curr = evt.target.closest(".back") ? idx : idx + 1;
            elBook.style.setProperty("--c", curr);
            music.play();
            
            setTimeout(() => {    
                pG.saveValue(myVar, curr, true, "#userGoal");
            } , 1250); 
            
        });
    });

};

//setta la pagina attuale da vedere
function managePrint(newPage, facciates, classToAdd, isInit = false){

    const maxPageIndex = facciates.length - 1; 
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
        } else {
            facciates[i].classList.add(classToAdd);
        }
        a = Math.floor(i/2);
        b = Math.floor(newPage/2);
        if (a == b) {
            facciates[i].parentNode.style.display = "block";
        } else {
            facciates[i].parentNode.style.display = "none";
        }
    }

}

const changePage = (elBook) => {
    const facciates = document.querySelectorAll(".facciata");
    const special = "actFac";

    const myVar = "cP";
    let res = pG.values.get(myVar);

    if(res === undefined) { //se non è settato settalo
        pG.saveValue(myVar, 0, true, "");
        window.location.reload();
    }

    const maxPageIndex = facciates.length - 1; //indice della copertina
    if (res > facciates.length) { //se per qualche motivo eccede, riportalo al max accettabile
        res = maxPageIndex;
    }

    elBook.style.setProperty("--c", res); // Set current page
    
    managePrint(res,facciates,special, true);
    

    elBook.querySelectorAll(".facciata").forEach((facc,idx) => {
        facc.style.setProperty("--i", idx); //questa la eredito ma per ora non mi serve

        facc.addEventListener("click", (evt) => {
            let width = (window.innerWidth > 0) ? window.innerWidth : screen.width;
            let critVal = width/2;
            music.play();
            
            let newPage = res;

            if (evt.x < critVal) {
                if(newPage != 0){
                    newPage--;
                }

            } else {
                if(newPage != maxPageIndex){
                    newPage++;
                }
            
            }

            managePrint(newPage, facciates, special);

            res = newPage;
            setTimeout(() => {    
                pG.saveValue(myVar, res, true, "#userGoal");
                } , 250);
            
            });
    });

};

/////

const rel = new ReloaderPage(500);




function startView() {
    if (!rel.isLittle){
        document.querySelectorAll(".book").forEach(flipBook);
    } else {
        document.querySelectorAll(".book").forEach(changePage);
    }
    
}




/////////////////////////////////////////////////////////////////////////////////////////////////////////




// create();
this.startView();




const amount = document.querySelectorAll(".facciata").length;
document.querySelectorAll(".facciata").forEach((elem, index) => {
    if ((index == 0) || (index == (amount-1))){
        return;
    }
    
    const firstArt = elem.firstChild;
    const secArt = firstArt.nextSibling;
    if(secArt === undefined || secArt === null){
        return;
    }

    const title = firstArt.firstChild.nextSibling;
    const descript = title.nextSibling.nextSibling;
    const subtitle = secArt.firstChild;
    const listLibri = subtitle.nextSibling;

    let defaultTitleSize = rel.isLittle ? 22 : 36; //TODO ?OLD controlla 20 
    let defaultdescriptSize = rel.isLittle ? 16 : 18;
    let defaultSubtitleSize = rel.isLittle ? 16 : 25;  //TODO ?OLD controlla 16
    let defaultListaLibriHeight = rel.isLittle ? 150 : 200;

    const maxCharsTitle = 50;
    const maxCharsDescp = 800;
    const sogliaValueTitle = 25;
    const sogliaValueDescp = rel.isLittle ? 450 : 600;

    let flag = false;

    if (descript.innerHTML.length > sogliaValueDescp){
        let maxDimPerc = rel.isLittle ? 40 : rel.isBigSize ? 5 : 25;
        let offset = (maxCharsDescp - sogliaValueDescp);
        let coeff = (maxCharsDescp - descript.innerHTML.length) / offset;

        coeff = 1 - coeff;
        coeff = coeff * maxDimPerc;
        coeff = coeff / 100;
        coeff = 1 - coeff;

        defaultdescriptSize = defaultdescriptSize * coeff;
        
        flag = true;
    }

    descript.style.fontSize = Math.round(defaultdescriptSize) + "px";


    if (title.innerHTML.length > sogliaValueTitle){
        
        let maxDimPerc = 25;
        let offset = (maxCharsTitle - sogliaValueTitle);

        let coeff = (maxCharsTitle - title.innerHTML.length) / offset;
        
        coeff = 1 - coeff;
        coeff = coeff * maxDimPerc;
        coeff = coeff / 100;
        coeff = (1 - coeff);

        defaultTitleSize = defaultTitleSize * coeff;
        
        defaultSubtitleSize = defaultSubtitleSize * coeff;
        
        if(flag){
            listLibri.style.maxHeight = (defaultListaLibriHeight / (rel.isBigSize ? 1.5 : 2)) + "px";
            listLibri.style.minHeight = (defaultListaLibriHeight / (rel.isBigSize ? 1.5 : 2)) + "px";
        }
      
    }
    title.style.fontSize = Math.round(defaultTitleSize) + "px";
    subtitle.style.fontSize = Math.round(defaultSubtitleSize) + "px";

    if ((window.innerWidth > (600*2))){
        secArt.style.marginTop = "10%";
    }
});
