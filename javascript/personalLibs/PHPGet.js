//class PHPGet{


const values = new Map();

function create() {
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

function getValue(keyName) {
    let tmp =  values.get(keyName);
    return tmp;
}

function setValue(keyName, newValue){
    values = values.set(keyName, newValue);
}

 



//}