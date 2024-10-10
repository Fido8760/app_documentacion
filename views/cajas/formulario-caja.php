<fieldset class="formulario__fieldset">
    <legend>Datos del Remolque</legend>
    <div class="mb-3 formulario__body__campo">
        <label for="numero_caja" class="form-label formulario__body__campo--label">No. de Caja: </label>
        <input type="number" class="form-control formulario__body__campo--input" name="numero_caja" id="numero_caja" placeholder="Escriba el número de caja" value="<?php echo $caja->numero_caja; ?>">
    </div>
    <div class="mb-3 formulario__body__campo">
        <label for="capacidad" class="form-label formulario__body__campo--label">Capacidad: </label>
        <select type="text" class="form-select formulario__body__campo--input" name="capacidad" id="capacidad">
            <option disabled value="">Seleccione...</option>
            <option value="CAJA 48 PIES" <?php echo ($caja->capacidad == "CAJA 48 PIES") ? "selected" : ""; ?>>CAJA 48 PIES</option>
            <option value="CAJA 53 PIES" <?php echo ($caja->capacidad == "CAJA 53 PIES") ? "selected" : ""; ?>>CAJA 53 PIES</option>
        </select>
    </div>
    <div class="mb-3 formulario__body__campo">
        <label for="c_placas" class="form-label formulario__body__campo--label">Placas: </label>
        <input type="text" class="form-control formulario__body__campo--input" name="c_placas" id="c_placas" placeholder="Escriba las placas de la caja" value="<?php echo $caja->c_placas; ?>">
    </div>
    <div class="mb-3 formulario__body__campo">
        <label for="c_serie" class="form-label formulario__body__campo--label">Serie:</label>
        <input type="text" class="form-control formulario__body__campo--input" name="c_serie" id="c_serie" placeholder="Escriba el número de serie" value="<?php echo $caja->c_serie; ?>">
    </div>
    <div class="mb-3 formulario__body__campo">
        <label for="c_marca" class="form-label formulario__body__campo--label">Marca:</label>
        <select type="text" class="form-select formulario__body__campo--input" name="c_marca" id="c_marca">
            <option disabled value="">Seleccione la marca...</option>
            <option value="ALTAMIRANO" <?php echo ($caja->c_marca == "ALTAMIRANO") ? "selected" : ""; ?>>ALTAMIRANO</option>
            <option value="GREAT DANE" <?php echo ($caja->c_marca == "GREAT DANE") ? "selected" : ""; ?>>GREAT DANE</option>
            <option value="HYUNDAI" <?php echo ($caja->c_marca == "HYUNDAI") ? "selected" : ""; ?>>HYUNDAI</option>
            <option value="HYUNDAI HT COMPOSITE" <?php echo ($caja->c_marca == "HYUNDAI HT COMPOSITE") ? "selected" : ""; ?>>HYUNDAI HT COMPOSITE</option>
            <option value="MATLOCK" <?php echo ($caja->c_marca == "MATLOCK") ? "selected" : ""; ?>>MATLOCK</option>
            <option value="STOUGHTON" <?php echo ($caja->c_marca == "STOUGHTON") ? "selected" : ""; ?>>STOUGHTON</option>
            <option value="UTILITY" <?php echo ($caja->c_marca == "UTILITY") ? "selected" : ""; ?>>UTILITY</option>
            <option value="WABASH NAT" <?php echo ($caja->c_marca == "WABASH NAT") ? "selected" : ""; ?>>WABASH NAT</option>
            <option value="FRUEHAUF" <?php echo ($caja->c_marca == "FRUEHAUF") ? "selected" : ""; ?>>FRUEHAUF</option>
        </select>
    </div>
    <div class="mb-3 formulario__body__campo">
        <label for="c_anio" class="form-label formulario__body__campo--label">Año: </label>
        <input type="number" class="form-control formulario__body__campo--input" name="c_anio" id="c_anio" placeholder="Escriba el año de la caja" value="<?php echo $caja->c_anio; ?>">
    </div>
</fieldset>