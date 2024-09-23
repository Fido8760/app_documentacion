<?php if (!$actualizando): ?>
    <div class="mb-3 formulario__body__campo">
        <label for="" class="form-label formulario__body__campo--label">No. Unidad</label>
        <select class="form-select form-select-sm formulario__body__campo--input" name="id_unidad_ver" id="id_unidad_ver">
            <?php foreach($unidades as $unidad) { ?>
            <?php if($unidad->id) { ?>
                <option value="<?php echo $unidad->id; ?>"><?php echo $unidad->no_unidad; ?></option>
            <?php }}; ?>
        </select>
    </div>
<?php endif; ?>
<div class="mb-3 formulario__body__campo">
    <label for="folio_amb" class="form-label formulario__body__campo--label">Folio de Verificación Ambiental</label>
    <input type="text" class="form-control formulario__body__campo--input" name="folio_amb" id="folio_amb" value="<?php echo $verificacion_amb->folio_amb; ?>">
</div>
<div class="mb-3 formulario__body__campo">
    <label for="fecha_semestre_actual" class="form-label formulario__body__campo--label">Fecha Verificación</label>
    <input type="date" class="form-control formulario__body__campo--input" name="fecha_semestre_actual" id="fecha_semestre_actual" value="<?php echo $verificacion_amb->fecha_semestre_actual; ?>">
</div>
<div class="mb-3 formulario__body__campo">
    <label for="subir_archivo_amb" class="form-label formulario__body__campo--label">Adjuntar Verificación en PDF</label>
    <input type="file" class="form-control formulario__body__campo--input" name="subir_archivo_amb" id="subir_archivo_amb" accept="application/pdf">
</div>