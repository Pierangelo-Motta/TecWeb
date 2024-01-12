//class PHPGet{


const values = new Map();

export function create() {
    let allGets = window.location.search.substring(1);
    let gets = allGets.split("&");
    // fore
    //this. 
    
    gets.forEach(elem => {
        let row = elem.split("=");
        values.set(row[0], row[1]);
    });
    gets.forEach(elem => {
        console.log(elem);
    });
    //return this;
}

export function getValue(keyName) {
    let tmp =  values.get(keyName);
    return tmp;
}

export function setValue(keyName, newValue){
    values = values.set(keyName, newValue);
}

 



//}