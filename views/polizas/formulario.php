<div class="mb-3">
    <label for="t_poliza" class="form-label">Tipo de Póliza</label>
    <select class="form-select form-select-sm" name="t_poliza" id="t_poliza">
        <option disabled selected>Seleccione...</option>
        <option value="TRIMESTRAL" <?php echo ($poliza->t_poliza == "TRIMESTRAL") ? "selected" : ""; ?>>TRIMESTRAL</option>
        <option value="SEMESTRAL" <?php echo ($poliza->t_poliza == "SEMESTRAL") ? "selected" : ""; ?>>SEMESTRAL</option>
        <option value="ANUAL" <?php echo ($poliza->t_poliza == "ANUAL") ? "selected" : ""; ?>>ANUAL</option>
    </select>
</div>
<div class="mb-3">
    <label for="" class="form-label">No. Unidad</label>
    <select class="form-select form-select-sm" readonly name="id_unidad" id="id_unidad">
        <option value="1" >202</option>
    </select>
    
</div>
<div class="mb-3">
    <label for="" class="form-label">Beneficiario</label>
    <input type="text" class="form-control" name="beneficiario" id="beneficiario" value="<?php echo $poliza->beneficiario; ?>">
</div>
<div class="mb-3">
    <label for="" class="form-label">Fecha inicio</label>
    <input type="date" class="form-control" name="fe_inicio" id="fe_inicio" value="<?php echo $poliza->fe_inicio; ?>">
</div>
<div class="mb-3">
    <label for="" class="form-label">Fecha final</label>
    <input type="date" class="form-control" name="fe_final" id="fe_final" value="<?php echo $poliza->fe_final; ?>">
</div>
<div class="mb-3">
    <label for="" class="form-label">Enodoso Preferencial</label>
    <input type="text" class="form-control" name="endoso_pref" id="endoso_pref" value="<?php echo $poliza->endoso_pref; ?>">
</div>
<div class="mb-3">
    <label for="" class="form-label">Compañía</label>
    <input type="text" class="form-control" name="aseguradora" id="aseguradora" value="<?php echo $poliza->aseguradora; ?>">
</div>
<div class="mb-3">
    <label for="" class="form-label">Grupo</label>
    <select class="form-select form-select-sm" name="grupo" id="grupo">
        <option selected disabled>Seleccione...</option>
        <option value="2134" <?php echo ($poliza->grupo == "2134") ? "selected" : ""; ?>> 2134 </option>
        <option value="5025" <?php echo ($poliza->grupo == "5025") ? "selected" : ""; ?>> 5025 </option>
    </select>
</div>
<div class="mb-3"">
    <label for="" class="form-label">Subgrupo</label>
    <select class="form-select form-select-sm" name="subgrupo" id="subgrupo">
        <option selected disabled>Seleccione...</option>
        <option value="1" <?php echo ($poliza->subgrupo == "1") ? "selected" : ""; ?>> 1 </option>
    </select>
</div>
<div class="mb-3">
    <label for="" class="form-label">Numero de Póliza</label>
    <input type="text" class="form-control" name="n_poliza" id="n_poliza" value="<?php echo $poliza->n_poliza; ?>">
</div>
<div class="mb-3">
    <label for="" class="form-label">Robo total</label>
    <select class="form-select form-select-sm" name="robo_total" id="robo_total">
        <option selected disabled>Seleccione...</option>
        <option value="VALOR COMERCIAL" <?php echo ($poliza->robo_total == "VALOR COMERCIAL") ? "selected" : ""; ?>>VALOR COMERCIAL</option>
        <option value="VALOR FACTURA" <?php echo ($poliza->robo_total == "VALOR FACTURA") ? "selected" : ""; ?>>VALOR FACTURA</option>
        <option value="VALOR CONVENIDO" <?php echo ($poliza->robo_total == "VALOR CONVENIDO") ? "selected" : ""; ?>>VALOR CONVENIDO</option>
    </select>
</div>
<div class="mb-3">
    <label for="" class="form-label">Daños materiales</label>
    <select class="form-select form-select-sm" name="danios_mat" id="danios_mat">
    <option selected disabled>Seleccione...</option>
        <option value="VALOR COMERCIAL" <?php echo ($poliza->danios_mat == "VALOR COMERCIAL") ? "selected" : ""; ?>>VALOR COMERCIAL</option>
        <option value="VALOR FACTURA" <?php echo ($poliza->danios_mat == "VALOR FACTURA") ? "selected" : ""; ?>>VALOR FACTURA</option>
        <option value="VALOR CONVENIDO" <?php echo ($poliza->danios_mat == "VALOR CONVENIDO") ? "selected" : ""; ?>>VALOR CONVENIDO</option>
    </select>
</div>
<div class="mb-3">
    <label for="" class="form-label">Responsabilidad Cívil</label>
    <input type="text" class="form-control" name="resp_civil" id="resp_civil" value="<?php echo $poliza->resp_civil; ?>">
</div>
<div class="mb-3">
    <label for="" class="form-label">Costo total Póliza</label>
    <input type="text" class="form-control" name="costo_poliza" id="costo_poliza" value="<?php echo $poliza->costo_poliza; ?>">
</div>
<div class="mb-3">
    <label for="subir_archivo" class="form-label">Adjuntar Póliza en PDF</label>
    <input type="file" class="form-control" name="subir_archivo" id="subir_archivo" accept="application/pdf">
</div>
