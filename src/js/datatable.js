document.addEventListener('DOMContentLoaded', () => {
    $('#tabla_id').DataTable({
        responsive: true,
        "pageLength": 8,
        lengthMenu: [
            [8,20,50,100],
            [8,20,50,100]
        ],
        "language": {
            "url": 'https://cdn.datatables.net/plug-ins/1.13.1/i18n/es-ES.json'
        }
    });
})