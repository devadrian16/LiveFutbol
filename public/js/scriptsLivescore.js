document.addEventListener("DOMContentLoaded", function () {

    async function actualizar() {
        let protocol = window.location.protocol;
        let path = window.location.hostname;
        let port = window.location.port;
        let url = protocol+'//'+path+':'+port+'/actualizar';ç
        let tiempo = document.getElementById('tiempo');

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

    //setInterval(actualizar, 10000);

});