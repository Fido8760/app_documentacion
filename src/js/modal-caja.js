(function () {
    document.addEventListener('DOMContentLoaded', () => {
        let cajas = [];

        const botonesModal = document.querySelectorAll('.mostrarModal');
        botonesModal.forEach(boton => {
            boton.addEventListener('click', mostrarModal);
        });

        async function obtenerDatos() {
            try {
                const url = 'http://localhost:3000/api/cajas/';
                const resultado = await fetch(url);

                if (!resultado.ok) {
                    throw new Error(`Error ${resultado.status}: ${resultado.statusText}`);
                }

                cajas = await resultado.json(); // Guardar todos los datos en la variable global
            } catch (error) {
                console.error('Error al consultar la API:', error);
            }
        }

        async function mostrarModal(event) {
            if (cajas.length === 0) {
                await obtenerDatos();
            }

            const cajaId = event.currentTarget.dataset.id;
            const caja = cajas.find(c => c.id == cajaId);

            if(!caja) {
                console.log('Caja no encontrada')
                return;
            }

            const modal = document.createElement('DIV');
            const {numero_caja, c_placas, c_serie, capacidad, c_marca, c_anio} = caja;

            modal.classList.add('modal');
            modal.innerHTML = `
            <div class="modal-content">
                <h2 class="modal-content__titulo">Detalles de la Unidad</h2>
                <table class="tabla-unidad">
                    <thead>
                        <tr>
                            <th>Número de Remolque</th>
                            <th>Capacidad</th>
                            <th>Placas</th>
                            <th>Marca</th>
                            <th>Serie</th>
                            <th>Año</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td data-label="Número de Unidad">${numero_caja}</td>
                            <td data-label="Tipo">${capacidad}</td>
                            <td data-label="Marca">${c_placas}</td>
                            <td data-label="Placas">${c_marca}</td>
                            <td data-label="Serie">${c_serie}</td>
                            <td data-label="Año">${c_anio}</td>
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
                e.preventDefault;
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

})();