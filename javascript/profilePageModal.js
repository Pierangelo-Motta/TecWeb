// Get the current URL
let currentUrl = window.location.href;

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


// Add click event listener
followers.addEventListener('click', function () {
    // Display an alert when the element is clicked
    // alert('Follower clicked!');
    // creare popup? o modal 
    // openPopup();
});

// Add click event listener
seguiti.addEventListener('click', function () {
    // Display an alert when the element is clicked
    // alert('Seguiti clicked!');
    // creare modal
    openPopup();
});

document.getElementById('myPopup').addEventListener('click', function () {
    // Display an alert when the element is clicked
    // alert('Seguiti clicked!');
    // creare modal
    closePopup();
});

function openPopup() {
    var popup = document.getElementById('myPopup');
    popup.style.display = 'block';
}

function closePopup() {
    var popup = document.getElementById('myPopup');
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
    this.style.fontSize = "1.1em";
    
};
let mouseOutFunction = function () {
    this.style.color = '#000'; // your colour change
    // this.style.border = '1px solid #fff';
    this.style.fontSize = "1em";
};
seguiti.onmouseover = mouseOverFunction;
seguiti.onmouseleave = mouseOutFunction;
followers.onmouseover = mouseOverFunction;
followers.onmouseleave = mouseOutFunction;