(function() {
    let polizas = []; // Variable global para almacenar los datos de las polizas

    // Mostrar modal para info
    const botonesModal = document.querySelectorAll('#mostrarModal');
    botonesModal.forEach(boton => {
        boton.addEventListener('click', mostrarModal);
    });

    async function obtenerDatos() {
        try {
            const url = 'http://localhost:3000/api/polizas/';
            const resultado = await fetch(url);

            if (!resultado.ok) {
                throw new Error(`Error ${resultado.status}: ${resultado.statusText}`);
            }

            polizas = await resultado.json(); // Guardar todos los datos en la variable global
        } catch (error) {
            console.error('Error al consultar la API:', error);
        }
    }

    async function mostrarModal(event) {
        // Asegurarse de que los datos se han cargado
        if (polizas.length === 0) {
            await obtenerDatos();
        }

        const polizaId = event.currentTarget.dataset.id;
        const poliza = polizas.find(u => u.id == polizaId); // Buscar la unidad específica

        if (!poliza) {
            console.error('Unidad no encontrada');
            return;
        }

        const modal = document.createElement('DIV');

        modal.classList.add('modal');
        modal.innerHTML = `
            <div class="modal-content">
                <h2 class="modal-content__titulo">Detalles de la Póliza</h2>
                <table class="tabla-unidad">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>TIPO DE PÓLIZA</th>
                            <th>BENEFICIARIO</th>
                            <th>FECHADE INICIO</th>
                            <th>FECHA FINAL</th>
                            <th>ENDOSO</th>
                            <th>ASEGURADORA</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td data-label="Número de Unidad">${poliza.id}</td>
                            <td data-label="Tipo">${poliza.t_poliza}</td>
                            <td data-label="Marca">${poliza.beneficiario}</td>
                            <td data-label="Placas">${poliza.fe_inicio}</td>
                            <td data-label="Serie">${poliza.fe_final}</td>
                            <td data-label="Modelo">${poliza.endoso_pref}</td>
                            <td data-label="Año">${poliza.aseguradora}</td>
                        </tr>
                    </tbody>
                    <thead>
                        <tr>
                            <th>GRUPO</th>
                            <th>SUBGRUPO</th>
                            <th>NÚMERO DE PÓLIZA</th>
                            <th>ROBO TOTAL</th>
                            <th>DANIOS MATERALES</th>
                            <th>RESP. CÍVIL</th>
                            <th>COSTO POLIZA</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td data-label="Número de Unidad">${poliza.grupo}</td>
                            <td data-label="Tipo">${poliza.subgrupo}</td>
                            <td data-label="Marca">${poliza.n_poliza}</td>
                            <td data-label="Placas">${poliza.robo_total}</td>
                            <td data-label="Serie">${poliza.danios_mat}</td>
                            <td data-label="Modelo">$${poliza.resp_civil}</td>
                            <td data-label="Año">$${poliza.costo_poliza}</td>
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