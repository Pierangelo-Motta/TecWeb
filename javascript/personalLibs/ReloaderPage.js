class ReloaderPage {

    critValue = 768;
    myWidth;
    isLittle;
    isBigSize;

    constructor(freqReload, bigSize = 99999) {
        
        this.byLittleToBig = () => console.log("byLittleToBig");
        this.byBigToLitle = () => console.log("byBigToLittle");

        this.myWidth = (window.innerWidth > 0) ? window.innerWidth : screen.width;
        this.isLittle = this.myWidth < this.critValue;

        this.freq = freqReload;
        this.isBigSize = this.myWidth > bigSize;
        
        setInterval(() => this.checkReload(), freqReload);
    }

    checkReload() {
        if (!this.isLittle && (this.myWidth < this.critValue)) {
            this.byBigToLitle();
            window.location.reload();

        } else if (this.isLittle && (this.myWidth >= this.critValue)){
            this.byLittleToBig();
            window.location.reload();

        } else {
            this.myWidth = (window.innerWidth > 0) ? window.innerWidth : screen.width;
        }
    }

    isWindowLittle() {
        return this.isLittle;
    }

    isNowInBigSize(){
        return this.isBigSize;
    }

}
