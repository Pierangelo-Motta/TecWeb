// cookie_script.js
document.addEventListener("DOMContentLoaded", function () {
    let cookieConsentPopup = document.getElementById("cookieConsent");

    // Check if the cookie_consent cookie is not set
    if (!document.cookie.includes("cookie_consent")) {
        cookieConsentPopup.style.display = "block";
    } else {
        cookieConsentPopup.style.display = "none";
    }

    // Optional: Close the pop-up when the form is submitted
    document.getElementById("cookieConsentForm").addEventListener("submit", function () {
        cookieConsentPopup.style.display = "none";
    });
});
