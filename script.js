// 🔥 ABRIR / CERRAR PERFIL
function toggleMenu() {
    const menu = document.getElementById("dropdown");
    menu.classList.toggle("active");
}

// 🔥 CERRAR AL HACER CLICK FUERA
document.addEventListener("click", function(e) {
    const menu = document.getElementById("dropdown");
    const profile = document.querySelector(".profile");

    if (!profile.contains(e.target) && !menu.contains(e.target)) {
        menu.classList.remove("active");
    }
});

// 🌙 MODO OSCURO / CLARO
function toggleTheme(){
    document.body.classList.toggle("light-mode");
}
