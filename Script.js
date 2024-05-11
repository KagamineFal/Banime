let Logo = document.getElementById("Logo");
let listMenu = document.getElementById("listMenu")
let navList = document.getElementById("navList")
Logo.addEventListener("click", function(){
    window.location.href=("/")
})
// window.location.href=("https://blog.alltheanime.com/")
let search = document.getElementById("search");
let input = document.getElementById("input")
let count = 0;
let a = 0;
search.addEventListener("click", () => {
    input.classList.toggle("hidden")
    count++;
    if ((count%2) === 0) {
        input.disabled = true
    }else {
        input.disabled = false
    };
})

listMenu.addEventListener("click", () => {
    navList.classList.toggle("navHidden")
})

let subMenu = document.getElementById("subMenu");

function toggleMenu(){
    subMenu.classList.toggle("open-menu");
}