class PHPGet {

    values = new Map();

    constructor() {
        let allGets = window.location.search.substring(1);
        let gets = allGets.split("&");
        
        gets.forEach(elem => {
            let row = elem.split("=");
            this.values.set(row[0], row[1]);
        });

        // gets.forEach(elem => {
        //     console.log(elem);
        // });
    }
    
    obtainNewQuery(){
        let q = "?";
        this.values.forEach (function(value, key) {
            q += key + '=' + value + "&"; 
        })
        return q.substring(0, q.length-1);
    }

    saveValue(keyName, newValue, mustSaveOnHistory = false, tagToPin = ""){
        this.values = this.values.set(keyName, newValue);
        //setValue(keyName,newValue);
        
        // this.values.forEach(function(value, key) {
        //     console.log(key + " = " + value);
        // });
    
        let tmp = window.location.href;
    
        let askPointIndex = tmp.indexOf("\?");
        let okURL = tmp.substring(0, askPointIndex);
        let newURL = okURL + this.obtainNewQuery() + tagToPin;
        // console.log(this.obtainNewQuery() + " § " + newURL);
        
        if (mustSaveOnHistory) {
            window.history.replaceState({}, "", newURL);
        }

    }

}