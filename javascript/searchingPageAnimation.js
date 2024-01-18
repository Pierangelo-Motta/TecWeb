document.querySelectorAll("button.linkToUserProfile").forEach(e => e.addEventListener("click", () => {
    let userId = e.getAttribute("value");
    window.location.href = "profilePage.php?mode=post&id=" + userId;
}));