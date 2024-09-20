document.addEventListener('DOMContentLoaded', function () {
    const estatus = document.querySelectorAll('.estatus');

    estatus.forEach( estado => {
        const contenido = estado.textContent.trim();

        if(contenido === 'Vigente'){
            estado.classList.add('vigente');

        } else if (contenido === 'Por Vencer'){

            estado.classList.add('por-vencer');

        } else if (contenido === 'Vencido') {

            estado.classList.add('vencido')
        }

    } );
})