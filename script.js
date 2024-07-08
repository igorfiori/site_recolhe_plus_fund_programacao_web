document.addEventListener("DOMContentLoaded", function () {
    const emailElement = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const phoneElement = /^[0-9]{10,}$/;

    // Scroll suave
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener("click", function (e) {
            e.preventDefault();
            document.querySelector(this.getAttribute("href")).scrollIntoView({
                behavior: "smooth"
            });
        });
    });

    // Alteração de cor do header ao rolar a página
    const header = document.querySelector("header");
    window.addEventListener("scroll", function () {
        if (window.scrollY > 50) {
            header.classList.add("scrolled");
        } else {
            header.classList.remove("scrolled");
        }
    });

    // Exibição de modal
    const modal = document.getElementById("modal");
    const openModalButton = document.getElementById("open-modal");
    const closeButton = document.querySelector(".close-button");

    openModalButton.addEventListener("click", function (e) {
        e.preventDefault();
        modal.style.display = "block";
    });

    closeButton.addEventListener("click", function () {
        modal.style.display = "none";
    });

    window.addEventListener("click", function (e) {
        if (e.target === modal) {
            modal.style.display = "none";
        }
    });

    // Envio do formulário
    const form = document.querySelector(".modal-content form");
    form.addEventListener("submit", function (e) {
        e.preventDefault();
        // Aqui você pode adicionar a lógica para enviar os dados do formulário via AJAX ou qualquer outra forma de processamento
        alert("Formulário enviado com sucesso!");
        modal.style.display = "none";
    });
});

// Ação Login

// Get the modal
var modal = document.getElementById("loginModal");

// Get the button that opens the modal
var btn = document.getElementById("loginBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function () {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function () {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}



