<fieldset class="formulario__fieldset">
    <legend>Datos de Tarjeta Circulación Unidad</legend>
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
        <label for="folio_tarjeta" class="form-label formulario__body__campo--label">Folio de Tarejta de Circulación</label>
        <input type="text" class="form-control formulario__body__campo--input" name="folio_tarjeta" id="folio_tarjeta" value="<?php echo $tarjeta->folio_tarjeta; ?>">
    </div>
    <div class="mb-3 formulario__body__campo">
        <label for="permiso_sct" class="form-label formulario__body__campo--label">Permiso SCT</label>
        <input type="text" class="form-control formulario__body__campo--input" name="permiso_sct" id="permiso_sct" value="<?php echo $tarjeta->permiso_sct; ?>">
    </div>
    <div class="mb-3 formulario__body__campo">
        <label for="fecha_exped" class="form-label formulario__body__campo--label">Fecha Expedición</label>
        <input type="date" class="form-control formulario__body__campo--input" name="fecha_exped" id="fecha_exped" value="<?php echo $tarjeta->fecha_exped; ?>">
    </div>
    <div class="mb-3 formulario__body__campo">
        <label for="subir_archivo_circulacion" class="form-label formulario__body__campo--label">Adjuntar Tarjeta en PDF</label>
        <input type="file" class="form-control formulario__body__campo--input" name="subir_archivo_circulacion" id="subir_archivo_circulacion" accept="application/pdf">
    </div>
</fieldset>