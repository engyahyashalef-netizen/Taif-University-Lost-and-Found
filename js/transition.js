// Draggable Image Functionality
const draggableImage = document.getElementById("draggableImage");

draggableImage.addEventListener("mousedown", function(e) {
    let offsetX = e.clientX - draggableImage.getBoundingClientRect().left;
    let offsetY = e.clientY - draggableImage.getBoundingClientRect().top;

    function moveAt(e) {
        draggableImage.style.position = "absolute";
        draggableImage.style.left = e.pageX - offsetX + "px";
        draggableImage.style.top = e.pageY - offsetY + "px";
    }

    function onMouseMove(e) {
        moveAt(e);
    }

    document.addEventListener("mousemove", onMouseMove);

    draggableImage.onmouseup = function() {
        document.removeEventListener("mousemove", onMouseMove);
        draggableImage.onmouseup = null;
    };
});

draggableImage.ondragstart = function() {
    return false;
};
