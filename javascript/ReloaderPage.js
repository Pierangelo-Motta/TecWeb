// export default class ReloaderPage {}

class ReloaderPage{

    constructor(freqReload) {
        this.byLittleToBig = () => console.log("byLittleToBig");
        this.byBigToLitle = () => console.log("byBigToLittle");
        
        const critValue = 768;
        this.myWidth = (window.innerWidth > 0) ? window.innerWidth : screen.width;
        this.isLittle = this.myWidth < critValue;
        
        this.freq = freqReload;

        window.addEventListener("resize", () => this.checkReload());
    }

    checkReload(){
        if (!isLittle && (width <= criticalSize)) {
            this.byBigToLitle();
            window.location.reload();

        } else if (isLittle && width >= criticalSize){
            this.byLittleToBig();
            window.location.reload();

        } else {
            this.width = (window.innerWidth > 0) ? window.innerWidth : screen.width;
        }
    }

    recCheck() {
        setTimeout(() => {
            this.checkReload();
            this.recCheck();
        }, this.freq);
    }

    isWindowLittle(){
        return this.isLittle;
    }

}


//module.exports = ReloaderPage // 👈 Export class