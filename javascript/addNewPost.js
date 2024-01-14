class PostAdder {

    constructor(thereIsText, thereIsPhoto){

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



        this.textAreaPen.addEventListener('change', () => this.textAreaPenChangeEvent()); //!! modifica solo se si esce dalla textarea
        // this.textAreaPen.addEventListener('oninput', () => this.textAreaPenChangeEvent());
        this.textAreaCit.addEventListener('change', () => this.textAreaCitChangeEvent());
        this.nomeLibro.addEventListener('change',() => this.enableButt());

        this.imgPrevInput.addEventListener('change', () => this.manageImgChange());

        this.imgRem.addEventListener("click", () => this.removeImg());

        // //document.getElementById("test").addEventListener("click", () => location.href = "profilePage.php");
        // // document.querySelectorAll("footer button").forEach(element => {
        // //     // console.log("selected " + element.getAttribute("type") + " / " + element.getAttribute("id"));
            
        // //     element.addEventListener("click", function() {
        // //         // document.getElementById("demo").innerHTML = "Hello World";
        // //         // console.log("pressed " + element.getAttribute("type"));
                
        // //         location.href = "profilePage.php";
        // //     });
        // // });

        this.isSetText = this.configTextPresence(thereIsText);
        this.isSetPhoto = this.configPhotoPresence(thereIsPhoto);

        if (this.isSetPhoto) {
            this.imgPrevMods.style.display = "flex";
            this.imgLabel.style.width = "80%";
        }

        this.enableButt();
        this.showAccessibilityMessage();

        console.log("go");
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
        // console.log(this.isSetPhoto + " " + this.isSetText);
        this.accMess.style.display = this.isSetPhoto && (!this.isSetText) ? "block" : "none";
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
            console.log("OK");
            this.newPostForm.submit();
        } catch (error) {
            console.log("ERR");
        }
        // this.showAccessibilityMessage();
        // this.enableButt();
    }

    removeImg(){
        try {
            this.imgPrevInput.value = "";
        } catch (error) {
        }
        this.manageImgChange();
    }


}

a = new PostAdder(false, false); //default values