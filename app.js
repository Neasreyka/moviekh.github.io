document.addEventListener("contextmenu", function (e) {
 e.preventDefault();
});

document.onkeydown = function (e) {
if (event.keyCode == 123) {
}

if (e.ctrlkey && e.shiftkey && e.keyCode == "I".charCodeAt(0)) {
 return false;
}

if (e.ctrlkey && e.shiftkey && e.keyCode == "C".charCodeAt(0)) {
 return false;
}

if (e.ctrlkey && e.shiftkey && e.keyCode == "J".charCodeAt(0)) {
 return false;
}

if (e.ctrlkey && e.keyCode == "U".charCodeAt(0)) {
 return false;
}
};