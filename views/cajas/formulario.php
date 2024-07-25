<div class="card-body">
    <div class="card-body">
        <div class="mb-3">
            <label for="numero_caja" class="form-label">No. de Caja: </label>
            <input type="number" class="form-control" name="numero_caja" id="numero_caja" placeholder="Escriba el número de caja" value="<?php echo $caja->numero_caja; ?>">
        </div>
        <div class="mb-3">
            <label for="capacidad" class="form-label">Capacidad: </label>
            <select type="text" class="form-select" name="capacidad" id="capacidad">
                <option disabled value="">Seleccione...</option>
                <option value="CAJA 48 PIES" <?php echo ($caja->capacidad == "CAJA 48 PIES") ? "selected" : ""; ?>>CAJA 48 PIES</option>
                <option value="CAJA 53 PIES" <?php echo ($caja->capacidad == "CAJA 53 PIES") ? "selected" : ""; ?>>CAJA 53 PIES</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="c_placas" class="form-label">Placas: </label>
            <input type="text" class="form-control" name="c_placas" id="c_placas" placeholder="Escriba las placas de la caja" value="<?php echo $caja->c_placas; ?>">
        </div>
        <div class="mb-3">
            <label for="c_serie" class="form-label">Serie:</label>
            <input type="text" class="form-control" name="c_serie" id="c_serie" placeholder="Escriba el número de serie" value="<?php echo $caja->c_serie; ?>">
        </div>
        <div class="mb-3">
            <label for="c_marca" class="form-label">Marca:</label>
            <select type="text" class="form-select" name="c_marca" id="c_marca">
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
        <div class="mb-3">
            <label for="c_anio" class="form-label">Año: </label>
            <input type="number" class="form-control" name="c_anio" id="c_anio" placeholder="Escriba el año de la caja" value="<?php echo $caja->c_anio; ?>">
        </div>
    </div>
</div>