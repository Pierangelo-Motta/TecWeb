
function prepareURLwithOkGet(arrKV){
    let res = "";
    // arrKV.forEach((element) => {
    //     console.log(element);
    //     res += element + "=" + element + "&";
    // });
    // arrKV.forEach((key, value) => {
    //     res += key + "=" + value + "&";
    // });
    for (let key in arrKV) {
        var value = arrKV[key];
        res += key + "=" + value + "&";
    }
    return res.substring(0,res.length-1);
}


class AJAXManager{

    constructor() {
        this.searchingSection = document.querySelector("#cercaMed");
        this.mainContainer = document.querySelector("#newMedaglieri");
        this.footerMore = document.querySelector("#moreRes");
        console.log(this.searchingSection + " / " +  this.mainContainer + " / " + this.footerMore);

        this.userId = this.obtainActUser();

        const arrayMissMeds = []; 
        // this.obtainMissMeds();
    }

    obtainActUser(){
        let xhr = new XMLHttpRequest();
        
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
    
                console.log("--> " + xhr.responseText);
    
                // let bookList = JSON.parse(xhr.responseText);
                // filteredBooks = bookList.filter(function (book) {
                //     return book.titolo;//.toLowerCase().includes(inputValue.toLowerCase());
                // });
    
                // // console.log(filteredUsers);
                // fb = filteredBooks;
    
                // let autocompleteResults = document.getElementById(cl);
                // autocompleteResults.innerHTML = '';
    
                // filteredBooks.forEach(function (book) {
                //     // console.log(book);
                //     let option = document.createElement('div');
                //     option.textContent = book.titolo;
                //     option.addEventListener('click', function () {
                //         document.getElementById(tipo).value = book.titolo;
                //         autocompleteResults.innerHTML = '';
                //     });
                //     autocompleteResults.appendChild(option);
                //     // console.log(option);
                // });
    
                // // Show/hide the autocomplete results container based on the number of results
                // autocompleteResults.style.display = filteredBooks.length > 0 ? 'block' : 'none';
                // autocompleteResults.style.color = "#0b5ed7";
                // // console.log(autocompleteResults);
    
            }
        };

        
        let prev = "include/controller/newMedagliereController.php";
        // let askFor = ("?codeQ=" + 0);
        // let args = ["codeQ"];
        let args = {
            "codeQ" : 0
        }
        let ok = prev + "?" + prepareURLwithOkGet(args);
        console.log(ok);

        xhr.open('GET', ok, true);
    
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest'); // linea aggiunta per settare l' "X-Requested-With header" che indica che questa è una richiesta AJAX.
        xhr.send();
    
        // console.log("xhr done: inside");
    }

    obtainMissMeds(){
        let xhr = new XMLHttpRequest();
        
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
    
                console.log(xhr.responseText);
    
                // let bookList = JSON.parse(xhr.responseText);
                // filteredBooks = bookList.filter(function (book) {
                //     return book.titolo;//.toLowerCase().includes(inputValue.toLowerCase());
                // });
    
                // // console.log(filteredUsers);
                // fb = filteredBooks;
    
                // let autocompleteResults = document.getElementById(cl);
                // autocompleteResults.innerHTML = '';
    
                // filteredBooks.forEach(function (book) {
                //     // console.log(book);
                //     let option = document.createElement('div');
                //     option.textContent = book.titolo;
                //     option.addEventListener('click', function () {
                //         document.getElementById(tipo).value = book.titolo;
                //         autocompleteResults.innerHTML = '';
                //     });
                //     autocompleteResults.appendChild(option);
                //     // console.log(option);
                // });
    
                // // Show/hide the autocomplete results container based on the number of results
                // autocompleteResults.style.display = filteredBooks.length > 0 ? 'block' : 'none';
                // autocompleteResults.style.color = "#0b5ed7";
                // // console.log(autocompleteResults);
    
    
            }
        };

        
        let prev = "include/controller/newMedagliereController.php";
        // let askFor = ("?codeQ=" + 0);
        let args = {
            "codeQ" : 10,
            "userId" : this.userId,
        }
        let ok = prev + prepareURLwithOkGet(args);
        console.log(ok);

        // xhr.open('GET', ok, true);
    
        // xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest'); // linea aggiunta per settare l' "X-Requested-With header" che indica che questa è una richiesta AJAX.
        // xhr.send();
    
        // console.log("xhr done: inside");
    
    }

}

a = new AJAXManager();




function showAutocompleteBooks(inputValue, tipologia, classe) {

    let tipo = tipologia;
    let cl = classe;
    
    let xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {

            //console.log(xhr.responseText);

            let bookList = JSON.parse(xhr.responseText);
            filteredBooks = bookList.filter(function (book) {
                return book.titolo;//.toLowerCase().includes(inputValue.toLowerCase());
            });

            // console.log(filteredUsers);
            fb = filteredBooks;

            let autocompleteResults = document.getElementById(cl);
            autocompleteResults.innerHTML = '';

            filteredBooks.forEach(function (book) {
                // console.log(book);
                let option = document.createElement('div');
                option.textContent = book.titolo;
                option.addEventListener('click', function () {
                    document.getElementById(tipo).value = book.titolo;
                    autocompleteResults.innerHTML = '';
                });
                autocompleteResults.appendChild(option);
                // console.log(option);
            });

            // Show/hide the autocomplete results container based on the number of results
            autocompleteResults.style.display = filteredBooks.length > 0 ? 'block' : 'none';
            autocompleteResults.style.color = "#0b5ed7";
            // console.log(autocompleteResults);


        }
    };

    let askFor = ("?pTit=" + inputValue);
    let prev = "include/called/obtainSimilarBook.php";
    let ok = prev + askFor;
    xhr.open('GET', ok, true);

    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest'); // linea aggiunta per settare l' "X-Requested-With header" che indica che questa è una richiesta AJAX.
    xhr.send();

    // console.log("xhr done: inside");

}


document.addEventListener('click', function (event) {
    
    // manage user
    document.getElementById('nomeLibroId').addEventListener('input', function () {
        showAutocompleteBooks(this.value, 'nomeLibroId', 'autocompleteBoooksResults');
        // console.log("xhr done: outside");
    });

});