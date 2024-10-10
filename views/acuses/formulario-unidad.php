<fieldset class="formulario__fieldset">
    <legend>Archivos Acuse de Unidad</legend>
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
        <label for="archivo_poliza_acuse" class="form-label formulario__body__campo--label">Póliza en PDF</label>
        <input type="file" class="form-control formulario__body__campo--input" name="archivo_poliza_acuse" id="archivo_poliza_acuse" accept="application/pdf">
    </div>
    <div class="mb-3 formulario__body__campo">
        <label for="archivo_tarcirc_acuse" class="form-label formulario__body__campo--label">Tarjeta Circulación en PDF</label>
        <input type="file" class="form-control formulario__body__campo--input" name="archivo_tarcirc_acuse" id="archivo_tarcirc_acuse" accept="application/pdf">
    </div>
    <div class="mb-3 formulario__body__campo">
        <label for="archivo_veriambiental_acuse" class="form-label formulario__body__campo--label">Verficicación Ambiental en PDF</label>
        <input type="file" class="form-control formulario__body__campo--input" name="archivo_veriambiental_acuse" id="archivo_veriambiental_acuse" accept="application/pdf">
    </div>
    <div class="mb-3 formulario__body__campo">
        <label for="archivo_verifisico_acuse" class="form-label formulario__body__campo--label">Verificación Físico en PDF</label>
        <input type="file" class="form-control formulario__body__campo--input" name="archivo_verifisico_acuse" id="archivo_verifisico_acuse" accept="application/pdf">
    </div>
</fieldset>