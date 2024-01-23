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
