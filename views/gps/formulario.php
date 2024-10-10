<fieldset class="formulario__fieldset">
    <legend>Datos GPS</legend>
    <?php if (!$actualizando): ?>
        <div class="mb-3 formulario__body__campo">
            <label for="id_unidades" class="form-label formulario__body__campo--label">No. Unidad</label>
            <select class="form-select form-select-sm formulario__body__campo--input" name="id_unidades" id="id_unidades">
                <?php foreach($unidades as $unidad) { ?>
                <?php if($unidad->id) { ?>
                    <option value="<?php echo $unidad->id; ?>"><?php echo $unidad->no_unidad; ?></option>
                <?php }}; ?>
            </select>
        </div>
    <?php endif; ?>
    <div class="mb-3 formulario__body__campo">
        <label for="marca_gps" class="form-label formulario__body__campo--label">Marca: </label>
        <select type="text" class="form-select formulario__body__campo--input" name="marca_gps" id="marca_gps">
            <option disabled value="">Seleccione...</option>
            <option value="QUECLINK" <?php echo ($gps->marca_gps == "QUECLINK") ? "selected" : ""; ?>>QUECLINK</option>
            <option value="SUNTECH" <?php echo ($gps->marca_gps == "SUNTECH") ? "selected" : ""; ?>>SUNTECH</option>
        </select>
    </div>
    <div class="mb-3 formulario__body__campo">
        <label for="modelo" class="form-label formulario__body__campo--label">Modelo GPS</label>
        <input type="text" class="form-control formulario__body__campo--input" name="modelo" id="modelo" value="<?php echo $gps->modelo; ?>" placeholder="Coloque el modelo del GPS utilizado">
    </div>
    <div class="mb-3 formulario__body__campo">
        <label for="imei_gps" class="form-label formulario__body__campo--label">IMEI</label>
        <input type="text" class="form-control formulario__body__campo--input" name="imei_gps" id="imei_gps" value="<?php echo $gps->imei_gps; ?>" placeholder="Coloque el IMEI del equipo">
    </div>
    <div class="mb-3 formulario__body__campo">
        <label for="linea" class="form-label formulario__body__campo--label">Número Teléfonico</label>
        <input type="text" class="form-control formulario__body__campo--input" name="linea" id="linea" value="<?php echo $gps->linea; ?>" placeholder="Escriba el número de teléfono">
    </div>
    <div class="mb-3 formulario__body__campo">
        <label for="apn" class="form-label formulario__body__campo--label">APN</label>
        <input type="text" class="form-control formulario__body__campo--input" name="apn" id="apn" value="<?php echo $gps->apn; ?>" placeholder="Escriba el APN">
    </div>
</fieldset>
