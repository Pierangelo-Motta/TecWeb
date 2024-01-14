const music = new Audio('audio/sfoglia.mp3');
music.playbackRate=4;
// const music2 = new Audio();
// //music.loop = true;
// //music.playbackRate = 2;
// //music.pause();

const flipBook = (elBook) => {
    elBook.style.setProperty("--c", 0); // Set current page

    elBook.querySelectorAll(".page").forEach((page, idx) => {
        page.style.setProperty("--i", idx);
        page.addEventListener("click", (evt) => {
            const curr = evt.target.closest(".back") ? idx : idx + 1;
            elBook.style.setProperty("--c", curr);
            music.play();
        });
    });
};

document.querySelectorAll(".book").forEach(flipBook);
