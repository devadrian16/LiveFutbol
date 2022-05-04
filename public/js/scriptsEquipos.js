document.addEventListener("DOMContentLoaded", function () {

    let nofavorito = document.getElementById("nofavorito");
    let favorito = document.getElementById("favorito");

    nofavorito.addEventListener("click", function (e) {
        favorito.classList.remove("d-none");
        e.currentTarget.classList.add("d-none");
        agregar();
    });

    favorito.addEventListener("click", function (e) {
        nofavorito.classList.remove("d-none");
        e.currentTarget.classList.add("d-none");
        eliminar();
    });

    async function agregar() {
        const res = await fetch('http://127.0.0.1:8000/save/529', {
            method: 'GET',
            mode: 'cors',
            headers: {
                'Content-Type': 'application/json'
            },
            //body: JSON.stringify(obj)
        });

        const data = await res.json();
        console.log(data);
    }


    async function eliminar() {
        const res = await fetch('http://127.0.0.1:8000/delete/529', {
            method: 'GET',
            mode: 'cors',
            headers: {
                'Content-Type': 'application/json'
            },
            //body: JSON.stringify(obj)
        });

        const data = await res.json();
        console.log(data);
    }

});


