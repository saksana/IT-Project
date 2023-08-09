
function onoffnav() {
    document.getElementById("onof").classList.toggle('off');
    if (document.getElementById("onof").classList.toggle('on')) {
        document.getElementById("mySidenav").style.width = "250px";
        document.getElementById("main").style.marginLeft = "250px";
    } else {
        document.getElementById("mySidenav").style.width = "0";
        document.getElementById("main").style.marginLeft = "0";
    }
}
function mbNav() {
    document.getElementById("mb").classList.toggle('off');
    if (document.getElementById("mb").classList.toggle('on')) {
        document.getElementById("mySidenav").style.width = "250px";

    } else {
        document.getElementById("mySidenav").style.width = "0";
    }
}

var dropdown = document.getElementsByClassName("dropdown-btn");
var i;
for (i = 0; i < dropdown.length; i++) {
    dropdown[i].addEventListener("click", function () {
        //  this.classList.toggle("active");
        var dropdownContent = this.nextElementSibling;
        if (dropdownContent.style.display === "block") {
            dropdownContent.style.display = "none";
        } else {
            dropdownContent.style.display = "block";
        }
    });
}