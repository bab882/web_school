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

function activateIcon(id) {
    var icon = document.getElementById("icon" + id.substring(4));
    icon.classList.add("active");
  }




