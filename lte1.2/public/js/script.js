

const login= document.querySelector('.loginbtn');

let nevbar = document.querySelector('.navbar');
document.querySelector('#menu-btn').onclick=() =>{
    nevbar.classList.toggle('active');
    searchForm.classList.remove('active');
}

let searchForm = document.querySelector('.search-form');
document.querySelector('#search-btn').onclick=() =>{
    searchForm.classList.toggle('active');
    nevbar.classList.remove('active');
    
}

let iconClose=document.querySelector('.icon-close');
document.querySelector('#home').onclick=()=>{
    iconClose.classList.remove('active')
}

/*
iconClose.addEventListener('click',()=>{
    home.classList.remove('.active-login');
})*/




window.onscroll = () =>{
    nevbar.classList.remove('active');
    searchForm.classList.remove('active');
}