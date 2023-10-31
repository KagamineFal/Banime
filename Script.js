let Logo = document.getElementById("Logo");
Logo.addEventListener("click", function(){
    window.location.reload()
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