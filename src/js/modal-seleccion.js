
(function () {

    document.addEventListener('DOMContentLoaded', () => {
        const btnSleccion = document.querySelector('.modalSeleccion')
        btnSleccion.addEventListener('click', modalSeleccion);

        function modalSeleccion() {

            const modalPolizas = document.createElement('DIV');
            modalPolizas.classList.add('seleccionPolizas');

            modalPolizas.innerHTML = `
            <div class="contenido-modal">
                <h2 class="contenido-modal__titulo">Seleccione el tipo de poliza a agregar</h2>
                <div class="contenido-modal__campo">
                    <label for="tipo-poliza">Opciones: </label>
                    <select id="tipo-poliza">
                        <option value="">--Seleccione--</option>
                        <option value="unidad">Póliza de Unidad</option>
                        <option value="remolque">Póliza de Remolque</option>
                    </select>
                </div>
                
                <div class="opciones">
                    <button type="button" class="quitar-modal">Cerrar</button>
                    <button type="button" class="boton-aceptar">Acpetar</button>
                </div>
            </div>
        `;


            setTimeout(() => {
                const modalContent = document.querySelector('.contenido-modal');
                modalContent.classList.add('animacion');
            }, 0);

            //boton cerrar modal
            modalPolizas.addEventListener('click', e => {
                e.preventDefault();
                if (e.target.classList.contains('quitar-modal')) {
                    const modalContent = document.querySelector('.contenido-modal');
                    modalContent.classList.add('cerrar');

                    setTimeout(() => {
                        modalPolizas.remove();

                    }, 500);
                }
            })

            // Agregar evento al botón "Aceptar"
            const botonAceptar = modalPolizas.querySelector('.boton-aceptar');
            botonAceptar.addEventListener('click', () => {
                const select = document.getElementById('tipo-poliza');
                const valorSeleccionado = select.value;

                let url = '';
                if (valorSeleccionado === 'unidad') {
                    url = '/polizas/crear-poliza-unidad';
                } else if (valorSeleccionado === 'remolque') {
                    url = '/polizas/crear-poliza-remolque';
                }

                if (url) {
                    window.location.href = url;
                }
            });

            //mostrar el modal en el html
            document.querySelector('body').appendChild(modalPolizas)
        }
    });

})();

