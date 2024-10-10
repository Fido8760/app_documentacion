
(function () {

    document.addEventListener('DOMContentLoaded', () => {
        const btnTarjeta = document.querySelector('.seleccionTarjeta')
        btnTarjeta.addEventListener('click', modalSeleccion);

        function modalSeleccion() {

            const modalTarjetas = document.createElement('DIV');
            modalTarjetas.classList.add('seleccionPolizas');

            modalTarjetas.innerHTML = `
            <div class="contenido-modal">
                <h2 class="contenido-modal__titulo">Seleccione el Tipo de Tarjeta de Circulación</h2>
                <div class="contenido-modal__campo">
                    <label for="tipo-poliza">Opciones: </label>
                    <select id="tipo-poliza">
                        <option value="">--Seleccione--</option>
                        <option value="unidad">Tarjeta de Unidad</option>
                        <option value="remolque">Tarjeta de Remolque</option>
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
            modalTarjetas.addEventListener('click', e => {
                e.preventDefault();
                if (e.target.classList.contains('quitar-modal')) {
                    const modalContent = document.querySelector('.contenido-modal');
                    modalContent.classList.add('cerrar');

                    setTimeout(() => {
                        modalTarjetas.remove();

                    }, 500);
                }
            })

            // Agregar evento al botón "Aceptar"
            const botonAceptar = modalTarjetas.querySelector('.boton-aceptar');
            botonAceptar.addEventListener('click', () => {
                const select = document.getElementById('tipo-poliza');
                const valorSeleccionado = select.value;

                let url = '';
                if (valorSeleccionado === 'unidad') {
                    url = '/tarjetas-circulacion/crearUnidad';
                } else if (valorSeleccionado === 'remolque') {
                    url = '/tarjetas-circulacion/crearCaja';
                }

                if (url) {
                    window.location.href = url;
                }
            });

            //mostrar el modal en el html
            document.querySelector('body').appendChild(modalTarjetas)
        }
    });

})();