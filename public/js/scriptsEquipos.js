document.addEventListener("DOMContentLoaded", function () {

    let nofavorito = document.getElementById("nofavorito");
    let favorito = document.getElementById("favorito");

    nofavorito.addEventListener("click", function (e) {
        agregar();
        favorito.classList.remove("d-none");
        e.currentTarget.classList.add("d-none");
        
    });

    favorito.addEventListener("click", function (e) {
        eliminar();
        nofavorito.classList.remove("d-none");
        e.currentTarget.classList.add("d-none");
    });

    async function agregar() {
        let id = window.location.pathname.split('/');
        let url = 'http://127.0.0.1:8000/save/'+id[2];

        const res = await fetch(url, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            },
        });
        const data = await res.json();
        console.log(data);
    }


    async function eliminar() {
        let id = window.location.pathname.split('/');
        let url = 'http://127.0.0.1:8000/delete/'+id[2];

        const res = await fetch(url, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            },
        });
        const data = await res.json();
        console.log(data);
    }

});


