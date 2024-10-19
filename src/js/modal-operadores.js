(function() {
    let operadores = [];

    document.addEventListener('DOMContentLoaded', () => {
        const btnOperadores = document.querySelectorAll('#mostrarModal');
        btnOperadores.forEach( operador => {
            operador.addEventListener('click', mostrarModal);
        })

        async function obtenerDatos() {
            try {
                const url = `${location.origin}/api/operadores/`;
                const resultado = await fetch(url);

                if (!resultado.ok) {
                    throw new Error(`Error ${resultado.status}: ${resultado.statusText}`);
                }

                operadores = await resultado.json();
            } catch (error) {
                console.error('Error al consultar la API:', error)
            }
        }

        async function mostrarModal(e) {
            if(operadores.length === 0) {
                await obtenerDatos();
            }

            const operadorId = e.target.dataset.id;
            const operador = operadores.find(o => o.id == operadorId);

            if(!operador) {
                console.error('Operador no encontrado');
                return;
            }

            const modal = document.createElement('DIV');

            modal.classList.add('modal');
            modal.innerHTML = `
            <div class="modal-content">
                <h2 class="modal-content__titulo">Detalles del Operador</h2>
                <table class="tabla-unidad">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>NOMBRE</th>
                            <th>CURP</th>
                            <th>RFC</th>
                            <th>NSS</th>
                            <th>FECHA DE INGRESO</th>
                            <th>VIGENCIA LICENCIA</th>
                            <th>VIGENCIA APTO</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td data-label="ID">${operador.id}</td>
                            <td data-label="NOMBRE">${operador.nombre} ${operador.apellido_p} ${operador.apellido_m}</td>
                            <td data-label="CURP">${operador.curp}</td>
                            <td data-label="RFC">${operador.rfc}</td>
                            <td data-label="NSS">${operador.nss}</td>
                            <td data-label="FECHA DE INGRESO">${operador.fe_ingreso}</td>
                            <td data-label="VIGENCIA LICENCIA">${operador.vigencia_lic}</td>
                            <td data-label="VIGENCIA APTO">${operador.vigencia_apto}</td>
                        </tr>
                    </tbody>
                </table>
                <button type="button" class="cerrar-modal">Cerrar</button>
            </div>
        `;

        document.querySelector('body').appendChild(modal);

        setTimeout(() => {
            const modal_content = document.querySelector('.modal-content');
            modal_content.classList.add('animar');
        }, 0);

        modal.addEventListener('click', function(e) {
            e.preventDefault();
            if(e.target.classList.contains('cerrar-modal')) {
                const modal_content = document.querySelector('.modal-content');
                modal_content.classList.add('cerrar');
                setTimeout(() => {
                    modal.remove();
                }, 500);
            }
        });

    }
    obtenerDatos();
    });
})()