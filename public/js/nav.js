// Curseur de la souris
const bulle = document.createElement("div");
bulle.classList.add('bulle');
document.body.appendChild(bulle);

const circleBehaviour = (e) => {
    bulle.style.display = "block"
    bulle.style.opacity = 1
    bulle.style.transform = `translateX(${e.pageX}px) translateY(${e.pageY}px)`
    bulle.style.transition = "0.15s"
}
 
document.addEventListener("mousemove", (e) => {
    circleBehaviour(e)
});

// 
document.addEventListener("mouseout", (e) => {

    // Pour afficher la souris
    bulle.style.opacity = 0
});

// Pour que la bulle remonte au scroll
document.addEventListener("wheel", (e) => {
    
    // Pour afficher la souris
    bulle.style.display = "block"
    bulle.style.opacity = 1
    bulle.style.transform = `translateX(${e.pageX}px) translateY(${e.pageY}px)`
    bulle.style.transition = "0.15s"
});

// La fermeture de mon menu mobile version responsive
const menuMobile = document.querySelector('.menu-mb');
const navLinks = document.querySelector('.nav-links');

menuMobile.addEventListener('click', ()=>{
    navLinks.classList.toggle('mobile-menu')
})

let typed = new Typed('.auto-typing', {
    strings: ['LYCÉE VIVIANI'],
    typeSpeed: 100,
    backSpeed: 100,
    loop: true,
    fadeOut: true,
    fadeOutClass: 'typed-fade-out',
    fadeOutDelay: 500,
    shuffle: true,
});
