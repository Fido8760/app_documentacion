document.addEventListener('DOMContentLoaded', function() {
    const exportarBtn = document.querySelector('#bontonExportarCajas')

    exportarBtn.addEventListener('click', exportarExcel)

    async function exportarExcel() {
        try {
            const url = `${location.origin}/api/cajas/`;
            const respuesta = await fetch(url);
            const resultado = await respuesta.json();

            const wb = XLSX.utils.book_new();
            const ws = XLSX.utils.json_to_sheet(resultado);

            XLSX.utils.book_append_sheet(wb,  ws, "Cajas");

            XLSX.writeFile(wb, 'cajas.xlsx');

        } catch (error) {
            console.log(error)
        }
       
    }
});