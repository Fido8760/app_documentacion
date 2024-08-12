document.addEventListener('DOMContentLoaded', function () {
    iniciarApp();
});

function iniciarApp() {

    paginador();
    borrar();

}
//obtener tareas

// async function obtenerUnidades() {
//     try {
//         const url = '/api/unidades'
//         const respuesta = await fetch(url);
//         const resultado = await respuesta.json();
//         console.log(resultado)
//     } catch (error) {
//         console.log(error);
//     }
// }

// async function agregarUnidad() {
//     //contruir petición
//     const datos = new FormData();
//     datos.append('nombre', 'fidel');
//     try {
//         const url ='http://localhost:3000/api/unidad';
//         const respuesta = await fetch(url, {
//             method: 'POST',
//             body: datos
//         });

//         console.log(respuesta)
//     } catch (error) {
//         console.log(error)
//     }
// }

function paginador() {
    const itemsPerPage = 12; // Cambia esto según la cantidad de items que quieras por página
    const items = document.querySelectorAll(".ag-courses_item");
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
        paginationContainer.innerHTML = "";
        const pageCount = Math.ceil(items.length / itemsPerPage);

        for (let i = 1; i <= pageCount; i++) {
            const pageLink = document.createElement("a");
            pageLink.textContent = i;
            pageLink.href = "#";
            pageLink.className = (i === currentPage) ? "active" : "";
            pageLink.addEventListener("click", function (e) {
                e.preventDefault();
                currentPage = i;
                showPage(currentPage);
                document.querySelector(".pagination a.active").classList.remove("active");
                pageLink.classList.add("active");
            });
            paginationContainer.appendChild(pageLink);
        }
    }

    showPage(currentPage);
    setupPagination();

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




