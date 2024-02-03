class PostAdder {

    constructor(thereIsText, thereIsPhoto) {

        this.newPostForm = document.getElementById("newPostForm");

        this.shareButton = document.getElementById("shareButton");
        this.accMess = document.getElementById("accessibilityMessage");

        this.textAreaCit = document.getElementById("citazioneTextId");
        this.textAreaPen = document.getElementById("pensieroTextId");
        this.nomeLibro = document.getElementById("nomeLibroId");

        this.imgLabel = document.getElementById("imgLabel");
        this.imgPrev = document.getElementById("imgPrev");
        this.imgPrevInput = document.getElementById("imgPrevInput");
        
        this.imgPrevMods = document.getElementById("imgPrevMods");
        this.imgPrevMods.style.display = "none";
        this.imgRem = document.getElementById("imgRem");
        this.actUserID = this.imgRem.getAttribute("data-actusername");

        this.textAreaPen.addEventListener('input', () => this.textAreaPenChangeEvent());
        this.textAreaCit.addEventListener('input', () => this.textAreaCitChangeEvent());
        this.nomeLibro.addEventListener('input',() => this.enableButt());

        this.imgPrevInput.addEventListener('input', () => this.manageImgChange());

        this.imgRem.addEventListener("click", () => this.removeImg());

        this.isSetText = this.configTextPresence(thereIsText);
        this.isSetPhoto = this.configPhotoPresence(thereIsPhoto);

        if (this.isSetPhoto) {
            this.imgPrevMods.style.display = "block";
            this.imgLabel.style.width = "80%";
        }

        this.enableButt();
        this.showAccessibilityMessage();

        //console.log("go");//debug print
    }

    configTextPresence(thereIsText){
        return this.isTextinputEmpty(this.textAreaCit) ? thereIsText : true;
    }

    configPhotoPresence(thereIsPhoto){
        let actImgName = this.imgPrev.getAttribute("src");
        let tmp = actImgName.split("/");
        actImgName = tmp[tmp.length-1];
        return (actImgName === "caricaFoto.png") ? thereIsPhoto : true;
    }

    isTextinputEmpty(which){
        return which.value.length === 0;
    }


    enableButt(){
        this.shareButton.disabled = ((!this.isSetText) && (!this.isSetPhoto)) || 
            this.isTextinputEmpty(this.textAreaPen) || 
            this.isTextinputEmpty(this.nomeLibro);
    }

    showAccessibilityMessage(){
        this.accMess.style.display = (this.isSetPhoto && (!this.isSetText)) ? "block" : "none";
    }

    textAreaChangeEventCommon(){
        this.enableButt();
    }

    textAreaCitChangeEvent(){
        this.isSetText = this.isTextinputEmpty(this.textAreaCit) ? false : true;
        this.showAccessibilityMessage();
        this.textAreaChangeEventCommon();
    }

    textAreaPenChangeEvent(){
        this.textAreaChangeEventCommon();
    }


    manageImgChange(){
        try {
            this.newPostForm.submit(); //prove di inizio progetto
        } catch (error) {
        }
    }

    removeImg(){
        try {
            let aUID = this.actUserID;
            $.ajax({ //capito a fine progetto
                type: 'POST',
                url: 'include/controller/newPostAJAX.php',
                data: { "uName" : aUID},
                dataType: 'json'
            });
            this.imgPrevInput.value = "";
        } catch (error) {
        }
        this.manageImgChange();
    }


}

a = new PostAdder(false, false); //default values


let fb = new Array();


function showAutocompleteBooks(inputValue, tipologia, classe) {

    let tipo = tipologia;
    let cl = classe;
    
    let xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {

            let bookList = JSON.parse(xhr.responseText);
            filteredBooks = bookList.filter(function (book) {
                return book.titolo;
            });

            fb = filteredBooks;

            let autocompleteResults = document.getElementById(cl);
            autocompleteResults.innerHTML = '';

            filteredBooks.forEach(function (book) {
                let option = document.createElement('div');
                option.textContent = book.titolo;

                option.addEventListener('click', function () {
                    document.getElementById(tipo).value = book.titolo;
                    autocompleteResults.innerHTML = '';
                });
                
                autocompleteResults.appendChild(option);
            });

            // Show/hide the autocomplete results container based on the number of results
            autocompleteResults.style.display = filteredBooks.length > 0 ? 'block' : 'none';
            autocompleteResults.style.color = "#0b5ed7";
        }
    };

    let askFor = ("?pTit=" + inputValue);
    let prev = "include/called/obtainSimilarBook.php";
    let ok = prev + askFor;
    xhr.open('GET', ok, true);

    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest'); // linea aggiunta per settare l' "X-Requested-With header" che indica che questa è una richiesta AJAX.
    xhr.send();

}


document.addEventListener('click', function (event) {
    
    // manage user
    document.getElementById('nomeLibroId').addEventListener('input', function () {
        showAutocompleteBooks(this.value, 'nomeLibroId', 'autocompleteBoooksResults');
    });

});