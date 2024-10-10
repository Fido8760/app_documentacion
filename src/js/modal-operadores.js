(function() {
    document.addEventListener('DOMContentLoaded', () => {
        const btnOperadores = document.querySelectorAll('#mostrarModal');
        btnOperadores.forEach( operador => {
            operador.addEventListener('click', mostrarModal);
        })

        async function mostrarModal(e) {
            console.log(e.target);
        }
    });
})()