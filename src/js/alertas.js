document.addEventListener('DOMContentLoaded', function() {
    iniciarApp();
});

function iniciarApp() {
    mostrarAlerta();
    confirmarEliminacion();
}

function mostrarAlerta() {
    // Verifica si la URL tiene algún tipo de alerta
    const urlParams = new URLSearchParams(window.location.search);
    const alertType = urlParams.get('alert');
    const action = urlParams.get('action'); // Esto indica si es crear, actualizar o eliminar

    // Si hay un tipo de alerta, se muestra según el tipo de acción realizada
    if (alertType === 'success') {
        if (action === 'create') {
            Swal.fire('¡Documento creado!', 'El documento se ha creado correctamente.', 'success');
        } else if (action === 'update') {
            Swal.fire('¡Documento actualizado!', 'El documento se ha actualizado correctamente.', 'success');
        } else if (action === 'delete') {
            Swal.fire('¡Documento eliminado!', 'El documento se ha eliminado correctamente.', 'success');
        }
    } else if (alertType === 'error') {
        Swal.fire('Error', 'Hubo un problema al realizar la operación.', 'error');
    }
}

function confirmarEliminacion() {
    // Selecciona todos los formularios con el botón de eliminar
    const deleteForms = document.querySelectorAll('.btn-eliminar');

    deleteForms.forEach(boton => {
        boton.addEventListener('click', function(event) {
            event.preventDefault(); // Prevenir el envío inmediato del formulario

            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Si el usuario confirma, se envía el formulario
                    boton.closest('form').submit();
                }
            });
        });
    });
}

