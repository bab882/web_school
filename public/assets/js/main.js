// Curseur de la souris
const bulle = document.createElement("div");
bulle.classList.add('bulle');
document.body.appendChild(bulle);

// Rendre la bulle visible et donner des coordonnées au curseur
const circleBehaviour = (e) => {
    bulle.style.display = "block" 
    bulle.style.opacity = 1
    bulle.style.transform = `translateX(${e.pageX}px) translateY(${e.pageY}px)`
    bulle.style.transition = "0.15s"
}
// J'ajoute un ecouteur d'événement dans le DOM
// Pour Déclencher la fonction circleBehaviour ( maj des styles de la bulle en fonction de la position de la souris)
document.addEventListener("mousemove", (e) => {
    circleBehaviour(e)
});
// J'ajoute un evenement pour rendre la souris invisble
document.addEventListener("mouseout", (e) => {
    bulle.style.opacity = 0
});
// Pour que la bulle remonte au scroll
document.addEventListener("wheel", (e) => {
    bulle.style.display = "block"
    bulle.style.opacity = 1
    bulle.style.transform = `translateX(${e.pageX}px) translateY(${e.pageY}px)`
    bulle.style.transition = "0.15s"
});
function activateIcon(id) {
    var icon = document.getElementById("icon" + id.substring(4));
    icon.classList.add("active");
}
//  End Curseur de la souris




document.addEventListener('click',function(e){
    // Hamburger menu
    if(e.target.classList.contains('hamburger-toggle')){
    e.target.children[0].classList.toggle('active');
    }
  })
