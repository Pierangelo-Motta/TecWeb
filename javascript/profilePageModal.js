// Get the current URL
let currentUrl = window.location.href;

//console.log("Current page URL: " + currentUrl);

// Parse the URL to extract parameters
let urlParams = new URLSearchParams(currentUrl);

// Get the value for the "id" parameter
// let uid = urlParams.get('id');
let uid = 0;
// console.log(uid);
let tipo = "";
let popUpClosed = true;

document.addEventListener("DOMContentLoaded", function () {
    // Find all elements with IDs starting with "mainInfosUserBannerN"
    let elements = document.querySelectorAll('[id^="mainInfosUserBannerN"]');   
    // Add a click event listener to each matching element
    elements.forEach(function (element) {
        // element.addEventListener("click", function () {
        element.addEventListener("mouseover", function () {    
            // Extract the number from the ID
            // impostato il flusso in maniera tale che l'uid rimanga costante fino alla chiusura del popup..
            if (uid === 0 || popUpClosed) {
                uid = this.id.match(/\d+/);
            }
            // console.log("mouseOver -> " + uid );
            
            let identificativoSeguiti = "counterSegueUserBannerN" + uid;
            let identificativoFollower = "counterFollowerUserBannerN" + uid;
            
            // Get the element by ID
            let seguiti = document.getElementById(identificativoSeguiti);
            let followers = document.getElementById(identificativoFollower);
            
            
            // popup followers open
            followers.addEventListener('click', function () {
                openPopup('myPopupFollowers' + uid);
                popUpClosed = false;
            });
            
            // popup seguiti open
            seguiti.addEventListener('click', function () {
                openPopup('myPopupSeguiti' + uid);
                popUpClosed = false;
            });
            
            // popup followers close
            // document.getElementById('myPopupFollowers' + uid).addEventListener('click', function () {
            //     closePopup('myPopupFollowers' + uid);
            // });
            document.querySelector('[data-closePopup="myPopupFollowers' + uid + '\"]').addEventListener('click', function () {
                closePopup('myPopupFollowers' + uid);
            });
            // document.getElementById('myPopupSeguiti' + uid).addEventListener('click', function () {
            //     closePopup('myPopupSeguiti' + uid);
            // });

            document.querySelector('[data-closePopup="myPopupSeguiti' + uid + '\"]').addEventListener('click', function () {
                closePopup('myPopupSeguiti' + uid);
            });

            function openPopup(tipo) {
                let popup = document.getElementById(tipo);
                console.log("open popup -> " + tipo);
                popup.style.display = 'block';
                
            }
            
            function closePopup(tipo) {
                let popup = document.getElementById(tipo);
                console.log("close popup -> " + tipo);
                popup.style.display = 'none';
                popUpClosed = true;
            }
            

            // gestione aspetto grafico mouseover..
            let mouseOverFunction = function () {
                this.style.color = '#0d6efd'; // your colour change
                this.style.textShadow = '2px 2px 4px rgba(0, 0, 0, 0.5)';
                // this.style.border = '1px solid #0d6efd';
                // this.style.width = "100px";
                // this.style.boxshadow = "-15px 15px 16px - 16px #0a65d56a";
                // this.style.fontSize = "1.1em";
                
            };
            let mouseOutFunction = function () {
                this.style.color = '#000'; // your colour change
                this.style.textShadow = '';
                // this.style.border = '1px solid #fff';
                // this.style.fontSize = "1em";
            };
            seguiti.onmouseover = mouseOverFunction;
            seguiti.onmouseleave = mouseOutFunction;
            followers.onmouseover = mouseOverFunction;
            followers.onmouseleave = mouseOutFunction;
        });
    });
});


// non più necessario,,... 
if (currentUrl.includes("searchingPage.php")) {
    document.querySelectorAll(".popup").forEach(function (el) {
        el.style.display = "none";
    });
}

// template...
document.addEventListener("DOMContentLoaded", (event) => {
    // document.getElementsByClassName('popup').forEach(element => {
        //     element.style.display = "none";
    // });
});


// // Add event listener to the document body to close the popup on click outside
// document.body.addEventListener("click", function (event) {
//     if (!event.target.closest('.popup')) {
//         // Close all popups when clicking outside of a popup
//         document.querySelectorAll('.popup').forEach(function (popup) {
//             popup.style.display = 'none';
//         });
//     }
// });