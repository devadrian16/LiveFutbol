document.addEventListener("DOMContentLoaded", function () {

    let nofavorito = document.getElementById("nofavorito");
    let favorito = document.getElementById("favorito");

    nofavorito.addEventListener("click", function (e) {
        favorito.classList.remove("d-none");
        e.currentTarget.classList.add("d-none");
    });

    favorito.addEventListener("click", function (e) {
        nofavorito.classList.remove("d-none");
        e.currentTarget.classList.add("d-none");
    });

});


