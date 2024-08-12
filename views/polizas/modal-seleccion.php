

<div class="modal fade" id="modal_Seleccion_Poliza" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Seleccionar Tipo de Póliza</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="/polizas/seleccionar-tipo-poliza">
                <div class="modal-body">
                
                    <select name="tipo_poliza">
                        <option value="vehicular">Póliza de Unidad Vehicular</option>
                        <option value="remolque">Póliza de Remolque</option>
                    </select>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Continuar</button>
                </div>
            </form>    
        </div>
    </div>
</div>
</div>
