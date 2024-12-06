var i = 0;
var imagesArray = [
    "img/foto1.png",
    "img/foto2.png",
    "img/foto3.png"
]
function changeImg(){
    document.getElementById('images').src = imagesArray[i];
    if(i<imagesArray.length - 1){
        i++;


