document.addEventListener('DOMContentLoaded', function(){
    const btnExportarUnidad = document.querySelector('#bontonExportarUnidades');
    btnExportarUnidad.addEventListener('click', exportarExcel);

    async function exportarExcel() {
        try {
            const url = `${location.origin}/api/unidades/`;
            const respuesta = await fetch(url);
            const resultado = await respuesta.json();

            const wb = XLSX.utils.book_new();
            const ws = XLSX.utils.json_to_sheet(resultado);

            XLSX.utils.book_append_sheet(wb,  ws, "Unidades");

            XLSX.writeFile(wb, 'unidades.xlsx');
        } catch (error) {
            console.log(error);
        }
    }
});