(function () {
    "use strict";

    const formTurno = document.getElementById("formTurno");
    const btnVolverArriba = document.getElementById("btnVolverArriba");
    const anioFooter = document.getElementById("anioFooter");
    const navLinks = document.querySelectorAll(".zampedri-nav-link");
    const navbarCollapse = document.querySelector(".navbar-collapse");

    if (anioFooter) {
        anioFooter.textContent = new Date().getFullYear();
    }

    function toggleVolverArriba() {
        if (!btnVolverArriba) {
            return;
        }
        if (window.scrollY > 400) {
            btnVolverArriba.classList.add("visible");
        } else {
            btnVolverArriba.classList.remove("visible");
        }
    }

    window.addEventListener("scroll", toggleVolverArriba);
    toggleVolverArriba();

    if (btnVolverArriba) {
        btnVolverArriba.addEventListener("click", function (evento) {
            evento.preventDefault();
            window.scrollTo({
                top: 0,
                behavior: "smooth"
            });
        });
    }

    navLinks.forEach(function (link) {
        link.addEventListener("click", function () {
            if (navbarCollapse && navbarCollapse.classList.contains("show")) {
                const toggler = document.querySelector(".navbar-toggler");
                if (toggler) {
                    toggler.click();
                }
            }
        });
    });

    if (formTurno) {
        formTurno.addEventListener("submit", function (evento) {
            if (!formTurno.checkValidity()) {
                evento.preventDefault();
                evento.stopPropagation();
            }

            formTurno.classList.add("was-validated");
        });
    }
})();
