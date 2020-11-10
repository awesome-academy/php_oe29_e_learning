window.onscroll = function() {
    scrollFixed()
};

var header = document.getElementById("my-header");
var sticky = header.offsetHeight;

function scrollFixed() {
    if (window.pageYOffset > sticky) {
        header.classList.add("background-dark");
    } else {
        header.classList.remove("background-dark");
    }
}

let title = document.getElementsByClassName('overlay-course');
for (let item of title) {
    item.style.background = `url(/${item.dataset.img}) no-repeat center`;
    item.style.backgroundSize = 'cover';
}

let dropdown = document.getElementById('btn-dropdown');
if (dropdown) {
    dropdown.onclick = function() {
        document.getElementById("dropdown-content").classList.toggle("show");
    }
};

window.onclick = function(event) {
    if (!event.target.matches('#btn-dropdown')) {
        let dropdown = document.getElementsByClassName('dropdown');
        for(let i = 0; i < dropdown.length; i++) {
            let openDropdown = dropdown[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
}
