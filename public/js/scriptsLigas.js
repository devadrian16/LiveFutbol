document.addEventListener("DOMContentLoaded", function () {

    let goles = document.getElementById("goles");
    goles.addEventListener("click", function (e) {
        e.preventDefault();

        let table = document.getElementById("tgoles");
        ocultarTablas(table);
        activarEnlace(goles);
    });

    let asistencias = document.getElementById("asistencias");
    asistencias.addEventListener("click", function (e) {
        e.preventDefault();

        let table = document.getElementById("tasistencias");
        ocultarTablas(table);
        activarEnlace(asistencias);
    });

    let amarillas = document.getElementById("amarillas");
    amarillas.addEventListener("click", function (e) {
        e.preventDefault();

        let table = document.getElementById("tamarillas");
        ocultarTablas(table);
        activarEnlace(amarillas);
    });

    let rojas = document.getElementById("rojas");
    rojas.addEventListener("click", function (e) {
        e.preventDefault();

        let table = document.getElementById("trojas");
        ocultarTablas(table);
        activarEnlace(rojas);
    });

    function ocultarTablas(table) {
        document.getElementById("tgoles").classList.add("d-none");
        document.getElementById("tasistencias").classList.add("d-none");
        document.getElementById("tamarillas").classList.add("d-none");
        document.getElementById("trojas").classList.add("d-none");

        table.classList.remove("d-none");
    }

    function activarEnlace(enlace) {
        document.getElementById("goles").classList.remove("activo");
        document.getElementById("asistencias").classList.remove("activo");
        document.getElementById("amarillas").classList.remove("activo");
        document.getElementById("rojas").classList.remove("activo");

        enlace.classList.add("activo");
    }
    
});



