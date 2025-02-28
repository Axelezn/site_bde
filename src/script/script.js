function toggleMenu() {
    const links = document.getElementById("liens")
    const menu = document.getElementById("cercle")
    const haut = document.getElementById("haut")
    const milieu = document.getElementById("milieu")
    const bas = document.getElementById("bas")
    haut.classList.toggle("active")
    milieu.classList.toggle("active")
    bas.classList.toggle("active")
    links.classList.toggle("active")
    menu.classList.toggle("active")
    if (links.style.display == "flex") {
        links.style.display = "none"
    }
    else{
        links.style.display="flex"
        menu.style.color="#E10098"

    }
}