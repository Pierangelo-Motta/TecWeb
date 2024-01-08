class PostAdder {

    constructor(thereIsText, thereIsPhoto){
        this.isSetText = thereIsText;
        this.isSetPhoto= thereIsPhoto;

        this.submitButton = document.getElementById("submitButton");
        this.accMess = document.getElementById("accessibilityMessage");

        this.textAreaCit = document.getElementById("citazioneText");
        this.textAreaPen = document.getElementById("pensieroText");
        this.nomeLibro = document.getElementById("nomeLibro");

        // this.imgPrev = document.getElementById("imgPrev");
        // this.startImgPrevName = this.imgPrev.getAttribute("src");
        // this.actImgPrevName = this.imgPrev.getAttribute("src");
        
        // this.imgPrevInput = document.getElementById("imgPrevInput");
        // this.startLabelImgPrev = this.getFileName(this.imgPrevInput);//this.imgPrev.getAttribute("value");
        // this.startLabelImgPrev = this.getFileName(this.imgPrevInput);//this.imgPrev.getAttribute("value");



        this.textAreaPen.addEventListener('change', () => this.textAreaPenChangeEvent()); //!! modifica solo se si esce dalla textarea
        // this.textAreaPen.addEventListener('oninput', () => this.textAreaPenChangeEvent());
        this.textAreaCit.addEventListener('change', () => this.textAreaCitChangeEvent());
        this.nomeLibro.addEventListener('change',() => this.enableButt());

        this.enableButt();
        this.showAccessibilityMessage();

        

        document.querySelectorAll("footer button").forEach(element => {
            element.onclick = function () {
                location.href = "profilePage.php";
            }
            // element.onclickaddEventListener('onclick', () => {
            //     location.href = "profilePage.php";
            // })
            
        });

        // document.querySelectorAll("footer button").forEach(element => {
        //     console.log(element.getAttribute("type"));

        //     // console.log(element.getAttributeNames());
        //     // element.onclickaddEventListener('onclick', () => {
        //     //     location.href = "profilePage.php";
        //     // })
            
        // });

        

        console.log("go");
    }


    isTextinputEmpty(which){
        return which.value.length === 0;
    }


    enableButt(){
        // this.submitButton.disabled = false;
        this.submitButton.disabled = ((!this.isSetText) && (!this.isSetPhoto)) || 
            this.isTextinputEmpty(this.textAreaPen) || 
            this.isTextinputEmpty(this.nomeLibro);
    }


    showAccessibilityMessage(){
        // this.accMess.style.display = "none";
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
        // console.log("AHAHAH");
    }







    // getFileName(inputFile){
    //     try {
    //         return inputFile.files.item(0).name;
    //     } catch (error) {
    //         return "";
    //     }
        
    //     // const files = event.target.files;
    //     // const fileName = files[0].name;
    //     // console.log("file name: ", fileName);
    // }
}

a = new PostAdder(false, false);