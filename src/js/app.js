document.addEventListener('DOMContentLoaded', function () {
    iniciarApp();
});

function iniciarApp() {

    paginador();
    borrar();

}


function paginador() {
    const itemsPerPage = 12; // Cambia esto según la cantidad de items que quieras por página
    const items = document.querySelectorAll(".inventario__courses-item");
    const paginationContainer = document.getElementById("pagination");
    let currentPage = 1;

    function showPage(page) {
        const start = (page - 1) * itemsPerPage;
        const end = start + itemsPerPage;

        items.forEach((item, index) => {
            item.style.display = (index >= start && index < end) ? "block" : "none";
        });
    }

    function setupPagination() {
        paginationContainer.innerHTML = ""; // Limpiar el contenedor de paginación
        const pageCount = Math.ceil(items.length / itemsPerPage);

        for (let i = 1; i <= pageCount; i++) {
            const pageLink = document.createElement("a");
            pageLink.textContent = i;
            pageLink.href = "#";
            pageLink.className = (i === currentPage) ? "active" : ""; // Clase "active" para la página actual
            pageLink.addEventListener("click", function (e) {
                e.preventDefault();
                currentPage = i;
                showPage(currentPage);

                // Verifica si hay un elemento con la clase "active" antes de eliminarla
                const activeLink = paginationContainer.querySelector(".active");
                if (activeLink) {
                    activeLink.classList.remove("active");
                }

                // Añade la clase "active" al link de la página actual
                pageLink.classList.add("active");
            });
            paginationContainer.appendChild(pageLink);
        }
    }

    showPage(currentPage); // Mostrar la primera página al cargar
    setupPagination(); // Configurar la paginación
}


function borrar() {
    const btnEliminar = document.querySelectorAll('.btn-eliminar');
    btnEliminar.forEach(boton => {
        boton.addEventListener('click', function (e) {
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
                if (result.isConfirmed) {
                    form.submit();
                }
            })
        });
    });

}




