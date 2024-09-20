(function() {
    let unidades = []; // Variable global para almacenar los datos de las unidades

    // Mostrar modal para info
    const botonesModal = document.querySelectorAll('#mostrarModal');
    botonesModal.forEach(boton => {
        boton.addEventListener('click', mostrarModal);
    });

    async function obtenerDatos() {
        try {
            const url = 'http://localhost:3000/api/unidades/';
            const resultado = await fetch(url);

            if (!resultado.ok) {
                throw new Error(`Error ${resultado.status}: ${resultado.statusText}`);
            }

            unidades = await resultado.json(); // Guardar todos los datos en la variable global
        } catch (error) {
            console.error('Error al consultar la API:', error);
        }
    }

    async function mostrarModal(event) {
        // Asegurarse de que los datos se han cargado
        if (unidades.length === 0) {
            await obtenerDatos();
        }

        const unidadId = event.currentTarget.dataset.id;
        const unidad = unidades.find(u => u.id == unidadId); // Buscar la unidad específica

        if (!unidad) {
            console.error('Unidad no encontrada');
            return;
        }

        const modal = document.createElement('DIV');

        modal.classList.add('modal');
        modal.innerHTML = `
            <div class="modal-content">
                <h2 class="modal-content__titulo">Detalles de la Unidad</h2>
                <table class="tabla-unidad">
                    <thead>
                        <tr>
                            <th>Número de Unidad</th>
                            <th>Tipo</th>
                            <th>Marca</th>
                            <th>Placas</th>
                            <th>Serie</th>
                            <th>Modelo</th>
                            <th>Año</th>
                            <th>Motor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td data-label="Número de Unidad">${unidad.no_unidad}</td>
                            <td data-label="Tipo">${unidad.tipo_unidad}</td>
                            <td data-label="Marca">${unidad.u_marca}</td>
                            <td data-label="Placas">${unidad.u_placas}</td>
                            <td data-label="Serie">${unidad.u_serie}</td>
                            <td data-label="Modelo">${unidad.modelo}</td>
                            <td data-label="Año">${unidad.u_anio}</td>
                            <td data-label="Motor">${unidad.no_motor}</td>
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

    // Cargar los datos al iniciar la página
    obtenerDatos();
})();
