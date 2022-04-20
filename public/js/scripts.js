let goles = document.getElementById("goles");
goles.addEventListener("click", function (e) {
    e.preventDefault();

    let table = document.getElementById("tgoles");
    ocultar(table);
});

let asistencias = document.getElementById("asistencias");
asistencias.addEventListener("click", function (e) {
    e.preventDefault();

    let table = document.getElementById("tasistencias");
    ocultar(table);
});

let rojas = document.getElementById("rojas");
rojas.addEventListener("click", function (e) {
    e.preventDefault();

    let table = document.getElementById("tamarillas");
    ocultar(table);
});

let amarillas = document.getElementById("amarillas");
amarillas.addEventListener("click", function (e) {
    e.preventDefault();

    let table = document.getElementById("trojas");
    ocultar(table);
});

function ocultar(table) {
    document.getElementById("tgoles").classList.add("d-none");
    document.getElementById("tasistencias").classList.add("d-none");
    document.getElementById("tamarillas").classList.add("d-none");
    document.getElementById("trojas").classList.add("d-none");

    table.classList.remove("d-none");
}