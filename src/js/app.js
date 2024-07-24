document.addEventListener('DOMContentLoaded', function() {
    inciarApp();
});

function inciarApp() {
    dtable();
    borrar();
    mostrarMensaje();
}
//agregar datatables 
function dtable() {
    $('#tabla_id').DataTable({
        "pageLenth": 3,
        lengthMenu: [
            [8,15.25,50],
            [8,15.25,50]
        ],
        "language": {
            "url":"https://cdn.datatables.net/plug-ins/1.13.1/i18n/es-ES.json"
        }
    });
}

function borrar() {
    const btnEliminar = document.querySelectorAll('.btn-eliminar');
    btnEliminar.forEach( boton =>{
        boton.addEventListener('click', function(e) {
            e.preventDefault();
            const form = this.closest('.form-eliminar');
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminarlo!'
            }).then((result) => {
                if(result.isConfirmed) {
                    form.submit();
                }
            })
        });
    } );
    
}

function mostrarMensaje() {
    const mensaje = '<?php echo $_SESSION['mensaje'] ?? ''; ?>';
    if (mensaje) {
        Swal.fire({
            title: 'Eliminación exitosa',
            text: mensaje,
            icon: 'success',
            confirmButtonText: 'OK'
        });
        <?php unset($_SESSION['mensaje']); // Elimina el mensaje de la sesión ?>
    }
}