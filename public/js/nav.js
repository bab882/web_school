const menuMobile = document.querySelector('.menu-mb');
const navLinks = document.querySelector('.nav-links');

menuMobile.addEventListener('click', ()=>{
    navLinks.classList.toggle('mobile-menu')
})