document.addEventListener('DOMContentLoaded', function() {
    iniciarApp();
});

function iniciarApp() {
    dtable();
    borrar();
    
}
//agregar datatables 
function dtable() {
    $('#tabla_id').DataTable({
        "pageLength": 8,
        lengthMenu: [
            [8,15,25,50,100],
            [8,15,25,50,100]
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
