class ReloaderPage {

    critValue = 768;
    isLittle;

    constructor(freqReload) {
        
        this.byLittleToBig = () => console.log("byLittleToBig");
        this.byBigToLitle = () => console.log("byBigToLittle");

        this.myWidth = (window.innerWidth > 0) ? window.innerWidth : screen.width;
        this.isLittle = this.myWidth < this.critValue;

        this.freq = freqReload;
        
        setInterval(() => {this.checkReload(); console.log("CIAO");}, freqReload);
    }

    checkReload() {
        if (!isLittle && (width < criticalSize)) {
            this.byBigToLitle();
            window.location.reload();

        } else if (isLittle && width >= criticalSize){
            this.byLittleToBig();
            window.location.reload();

        } else {
            this.width = (window.innerWidth > 0) ? window.innerWidth : screen.width;
        }
    }

    isWindowLittle() {
        return this.isLittle;
    }

}
