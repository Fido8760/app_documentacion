
(function () {

    document.addEventListener('DOMContentLoaded', () => {
        const btnAcuses = document.querySelector('.seleccionAcuse')
        btnAcuses.addEventListener('click', modalSeleccion);

        function modalSeleccion() {

            const modalAcuses = document.createElement('DIV');
            modalAcuses.classList.add('seleccionPolizas');

            modalAcuses.innerHTML = `
            <div class="contenido-modal">
                <h2 class="contenido-modal__titulo">Seleccione el Tipo de Acuse</h2>
                <div class="contenido-modal__campo">
                    <label for="tipo-poliza">Opciones: </label>
                    <select id="tipo-poliza">
                        <option value="">--Seleccione--</option>
                        <option value="unidad">Acuse de Unidad</option>
                        <option value="remolque">Acuse de Remolque</option>
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
            modalAcuses.addEventListener('click', e => {
                e.preventDefault();
                if (e.target.classList.contains('quitar-modal')) {
                    const modalContent = document.querySelector('.contenido-modal');
                    modalContent.classList.add('cerrar');

                    setTimeout(() => {
                        modalAcuses.remove();

                    }, 500);
                }
            })

            // Agregar evento al botón "Aceptar"
            const botonAceptar = modalAcuses.querySelector('.boton-aceptar');
            botonAceptar.addEventListener('click', () => {
                const select = document.getElementById('tipo-poliza');
                const valorSeleccionado = select.value;

                let url = '';
                if (valorSeleccionado === 'unidad') {
                    url = '/acuses/crearUnidad';
                } else if (valorSeleccionado === 'remolque') {
                    url = '/acuses/crearCaja';
                }

                if (url) {
                    window.location.href = url;
                }
            });

            //mostrar el modal en el html
            document.querySelector('body').appendChild(modalAcuses)
        }
    });

})();