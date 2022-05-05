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
        let protocol = window.location.protocol;
        let path = window.location.hostname;
        let port = window.location.port;
        let url = protocol+'//'+path+':'+port+'/save/'+id[2];

        const response = await fetch(url, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            },
        });
        if(!response.ok) {
            const message = `Un error ha ocurrido: ${response.status}`;
            throw new Error(message);
        }
        const data = await response.json();
        console.log(data);
    }


    async function eliminar() {
        let id = window.location.pathname.split('/');
        let protocol = window.location.protocol;
        let path = window.location.hostname;
        let port = window.location.port;
        let url = protocol+'//'+path+':'+port+'/delete/'+id[2];

        const response = await fetch(url, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            },
        });
        if(!response.ok) {
            const message = `Un error ha ocurrido: ${response.status}`;
            throw new Error(message);
        }
        const data = await response.json();
        console.log(data);
    }

});


