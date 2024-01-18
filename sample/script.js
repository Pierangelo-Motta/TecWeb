function allowDrop(event) {
    event.preventDefault();
}

function drag(event) {
    event.dataTransfer.setData("text", event.target.innerText);
}

function drop(event) {
    event.preventDefault();
    var data = event.dataTransfer.getData("text");

    // Remove the dragged item from its original container
    // var originalContainer = document.getElementById(data);
    var originalContainer = document.getElementById("list1");
    if (originalContainer) {
        originalContainer.removeChild(originalContainer.childNodes[0]);
    }

    // Create a new item in the target container
    var newItem = document.createElement("div");
    newItem.className = "list-item";
    newItem.innerText = data;
    newItem.draggable = true;
    newItem.ondragstart = function (e) {
        drag(e);
    };

    event.target.appendChild(newItem);
}
