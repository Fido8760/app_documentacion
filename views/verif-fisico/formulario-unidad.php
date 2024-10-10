<fieldset class="formulario__fieldset">
    <legend>Datos de Verificación Físico-Mecánica Unidad</legend>
    <?php if (!$actualizando): ?>
        <div class="mb-3 formulario__body__campo">
            <label for="" class="form-label formulario__body__campo--label">No. Unidad</label>
            <select class="form-select form-select-sm formulario__body__campo--input" name="id_unidad" id="id_unidad">
                <?php foreach($unidades as $unidad) { ?>
                <?php if($unidad->id) { ?>
                    <option value="<?php echo $unidad->id; ?>"><?php echo $unidad->no_unidad; ?></option>
                <?php }}; ?>
            </select>
        </div>
    <?php endif; ?>
    <div class="mb-3 formulario__body__campo">
        <label for="folio_fis" class="form-label formulario__body__campo--label">Folio de Verificación Físico-Mecánica</label>
        <input type="text" class="form-control formulario__body__campo--input" name="folio_fis" id="folio_fis" value="<?php echo $verificacion_fisico->folio_fis; ?>">
    </div>
    <div class="mb-3 formulario__body__campo">
        <label for="fecha_verif_fis" class="form-label formulario__body__campo--label">Fecha Verificación Anual</label>
        <input type="date" class="form-control formulario__body__campo--input" name="fecha_verif_fis" id="fecha_verif_fis" value="<?php echo $verificacion_fisico->fecha_verif_fis; ?>">
    </div>
    <div class="mb-3 formulario__body__campo">
        <label for="subir_archivo_fisico" class="form-label formulario__body__campo--label">Adjuntar PDF</label>
        <input type="file" class="form-control formulario__body__campo--input" name="subir_archivo_fisico" id="subir_archivo_fisico" accept="application/pdf">
    </div>
</fieldset>