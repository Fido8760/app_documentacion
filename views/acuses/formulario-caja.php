<fieldset class="formulario__fieldset">
    <legend>Archivos Acuse Remolque</legend>
    <?php if (!$actualizando): ?>
        <div class="mb-3 formulario__body__campo">
            <label for="" class="form-label formulario__body__campo--label">Número de Caja</label>
            <select class="form-select form-select-sm formulario__body__campo--input" name="id_caja" id="id_caja">
                <?php foreach($cajas as $caja) { ?>
                <?php if($caja->id) { ?>
                    <option value="<?php echo $caja->id; ?>"><?php echo $caja->numero_caja; ?></option>
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
