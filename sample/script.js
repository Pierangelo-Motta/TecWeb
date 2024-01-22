function allowDrop(event) {
    event.preventDefault();
}

function drag(event) {
    event.dataTransfer.setData("text", event.target.innerText);
}

function drop(event) {
    event.preventDefault();
    let data = event.dataTransfer.getData("text");

    // Remove the dragged item from its original container
    // let originalContainer = document.getElementById(data);
    let originalContainer = document.getElementById("list1");
    if (originalContainer) {
        originalContainer.removeChild(originalContainer.childNodes[0]);
    }

    // Create a new item in the target container
    let newItem = document.createElement("div");
    newItem.className = "list-item";
    newItem.innerText = data;
    newItem.draggable = true;
    newItem.ondragstart = function (e) {
        drag(e);
    };

    event.target.appendChild(newItem);
}
