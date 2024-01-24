// Get the current URL
let currentUrl = window.location.href;

console.log("Current page URL: " + currentUrl);


// Parse the URL to extract parameters
let urlParams = new URLSearchParams(currentUrl);

// Get the value for the "id" parameter
let uid = urlParams.get('id');
// console.log(uid);
let identificativoSeguiti = "counterSegueUserBannerN" + uid;
let identificativoFollower = "counterFollowerUserBannerN" + uid;

// Get the element by ID
let seguiti = document.getElementById(identificativoSeguiti);
let followers = document.getElementById(identificativoFollower);

let tipo = "";

if (currentUrl.includes("searchingPage.php")) {
    document.querySelectorAll(".popup").forEach(function (el) {
        el.style.display = "none";
    });
}

// popup followers open
followers.addEventListener('click', function () {
    // Display an alert when the element is clicked
    // alert('Follower clicked!');
    // creare popup? o modal 
    openPopup('myPopupFollowers');
});

// Add click event listener
seguiti.addEventListener('click', function () {
    // Display an alert when the element is clicked
    // alert('Seguiti clicked!');
    // creare modal
    openPopup('myPopupSeguiti');
});

// popup followers close
document.getElementById('myPopupFollowers').addEventListener('click', function () {
    // Display an alert when the element is clicked
    // alert('Seguiti clicked!');
    // creare modal
    closePopup('myPopupFollowers');
});

document.getElementById('myPopupSeguiti').addEventListener('click', function () {
    // Display an alert when the element is clicked
    // alert('Seguiti clicked!');
    // creare modal
    closePopup('myPopupSeguiti');
});

function openPopup(tipo) {
    var popup = document.getElementById(tipo);
    popup.style.display = 'block';
}

function closePopup(tipo) {
    var popup = document.getElementById(tipo);
    popup.style.display = 'none';
}

document.addEventListener("DOMContentLoaded", (event) => {
    // document.getElementsByClassName('popup').forEach(element => {
    //     element.style.display = "none";
    // });
 });


let mouseOverFunction = function () {
    this.style.color = '#0d6efd'; // your colour change
    // this.style.border = '1px solid #0d6efd';
    // this.style.width = "100px";
    // this.style.boxshadow = "-15px 15px 16px - 16px #0a65d56a";
    // this.style.fontSize = "1.1em";
    
};
let mouseOutFunction = function () {
    this.style.color = '#000'; // your colour change
    // this.style.border = '1px solid #fff';
    // this.style.fontSize = "1em";
};
seguiti.onmouseover = mouseOverFunction;
seguiti.onmouseleave = mouseOutFunction;
followers.onmouseover = mouseOverFunction;
followers.onmouseleave = mouseOutFunction;