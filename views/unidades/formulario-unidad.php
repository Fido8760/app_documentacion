<div class="mb-3 formulario__body__campo">
    <label for="no_unidad" class="form-label formulario__body__campo--label">No. de Unidad: </label>
    <input type="number" class="form-control formulario__body__campo--input" name="no_unidad" id="no_unidad" placeholder="Escriba el número de unidad" value="<?php echo $unidad->no_unidad; ?>">
</div>
<div class="mb-3 formulario__body__campo">
    <label for="tipo_unidad" class="form-label formulario__body__campo--label">Tipo de Unidad: </label>
    <select type="text" class="form-select formulario__body__campo--input" name="tipo_unidad" id="tipo_unidad">
        <option disabled value="">Seleccione...</option>
        <option value="CAMIONETA" <?php echo ($unidad->tipo_unidad == "CAMIONETA") ? "selected" : ""; ?>>CAMIONETA</option>
        <option value="TRACTOCAMION" <?php echo ($unidad->tipo_unidad == "TRACTOCAMION") ? "selected" : ""; ?>>TRACTOCAMION</option>
        <option value="MUDANCERO" <?php echo ($unidad->tipo_unidad == "MUDANCERO") ? "selected" : ""; ?>>MUDANCERO</option>
        <option value="AUTO PARICULAR" <?php echo ($unidad->tipo_unidad == "AUTO PARICULAR") ? "selected" : ""; ?>>AUTO PARICULAR</option>
    </select>
</div>
<div class="mb-3 formulario__body__campo">
    <label for="u_placas" class="form-label formulario__body__campo--label">Placas: </label>
    <input type="text" class="form-control formulario__body__campo--input" name="u_placas" id="u_placas" placeholder="Escriba las placas de la unidad" value="<?php echo $unidad->u_placas; ?>">
</div>
<div class="mb-3 formulario__body__campo">
    <label for="u_serie" class="form-label formulario__body__campo--label">Serie:</label>
    <input type="text" class="form-control formulario__body__campo--input" name="u_serie" id="u_serie" placeholder="Escriba el número de u_serie" value="<?php echo $unidad->u_serie; ?>">
</div>
<div class="mb-3 formulario__body__campo">
    <label for="u_marca" class="form-label formulario__body__campo--label">Marca:</label>
    <select type="text" class="form-select formulario__body__campo--input" name="u_marca" id="u_marca">
        <option disabled value="">Seleccione...</option>
        <option value="INTERNATIONAL" <?php echo ($unidad->u_marca == "INTERNATIONAL") ? "selected" : ""; ?>>INTERNATIONAL</option>
        <option value="FREIGHTLINER" <?php echo ($unidad->u_marca == "FREIGHTLINER") ? "selected" : ""; ?>>FREIGHTLINER</option>
        <option value="VOLVO" <?php echo ($unidad->u_marca == "VOLVO") ? "selected" : ""; ?>>VOLVO</option>
        <option value="KENWORTH" <?php echo ($unidad->u_marca == "KENWORTH") ? "selected" : ""; ?>>KENWORTH</option>
        <option value="KIA" <?php echo ($unidad->u_marca == "KIA") ? "selected" : ""; ?>>KIA</option>
        <option value="CHEVROLET" <?php echo ($unidad->u_marca == "CHEVROLET") ? "selected" : ""; ?>>CHEVROLET</option>
        <option value="NISSAN" <?php echo ($unidad->u_marca == "NISSAN") ? "selected" : ""; ?>>NISSAN</option>
        <option value="HONDA" <?php echo ($unidad->u_marca == "HONDA") ? "selected" : ""; ?>>HONDA</option>
    </select>
</div>
<div class="mb-3 formulario__body__campo">
    <label for="modelo" class="form-label formulario__body__campo--label">Modelo: </label>
    <input type="text" class="form-control formulario__body__campo--input" name="modelo" id="modelo" placeholder="Escriba el modelo" value="<?php echo $unidad->modelo; ?>">
</div>
<div class="mb-3 formulario__body__campo">
    <label for="u_anio" class="form-label formulario__body__campo--label">Año: </label>
    <input type="number" class="form-control formulario__body__campo--input" name="u_anio" id="u_anio" placeholder="Escriba el año del modelo" value="<?php echo $unidad->u_anio; ?>">
</div>
<div class="mb-3 formulario__body__campo">
    <label for="no_motor" class="form-label formulario__body__campo--label">Motor: </label>
    <input type="text" class="form-control formulario__body__campo--input" name="no_motor" id="no_motor" placeholder="Escriba el numero de motor" value="<?php echo $unidad->no_motor; ?>">
</div>