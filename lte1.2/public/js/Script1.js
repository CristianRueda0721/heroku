const sideMenu =document.querySelector("aside");
const MenuBtn =document.querySelector("#menu-btn");
const closeBtn =document.querySelector("#close-btn");
const themeToggler =document.querySelector(".theme-toggler");

// Sale la interfaz

MenuBtn.addEventListener("click",()=>{
    sideMenu.style.display="block";
})

// Cierre de la interfaz

closeBtn.addEventListener("click",()=>{
    sideMenu.style.display="none";
})


// Cambio de fondo 

themeToggler.addEventListener("click",()=>{
    document.body.classList.toggle("dark-theme-variables");

themeToggler.querySelector("span:nth-child(1)").classList.toggle("active")
themeToggler.querySelector("span:nth-child(2)").classList.toggle("active")

})

