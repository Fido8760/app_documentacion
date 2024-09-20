<div class="mb-3 formulario__body__campo">
    <label for="t_poliza" class="form-label formulario__body__campo--label">Tipo de Póliza</label>
    <select class="form-select form-select-sm formulario__body__campo--input" name="t_poliza" id="t_poliza">
        <option disabled selected>Seleccione...</option>
        <option value="TRIMESTRAL" <?php echo ($poliza_caja->t_poliza == "TRIMESTRAL") ? "selected" : ""; ?>>TRIMESTRAL</option>
        <option value="SEMESTRAL" <?php echo ($poliza_caja->t_poliza == "SEMESTRAL") ? "selected" : ""; ?>>SEMESTRAL</option>
        <option value="ANUAL" <?php echo ($poliza_caja->t_poliza == "ANUAL") ? "selected" : ""; ?>>ANUAL</option>
    </select>
</div>
<?php if (!$actualizando): ?>
    <div class="mb-3 formulario__body__campo">
        <label for="" class="form-label formulario__body__campo--label">No. Unidad</label>
        <select class="form-select form-select-sm formulario__body__campo--input" name="id_caja" id="id_caja">
            <?php foreach($cajas as $caja) { ?>
            <?php if($caja->id) { ?>
                <option value="<?php echo $caja->id; ?>"><?php echo $caja->numero_caja; ?></option>
            <?php }}; ?>
        </select>
    </div>
<?php endif; ?>

<div class="mb-3 formulario__body__campo">
    <label for="" class="form-label formulario__body__campo--label">Beneficiario</label>
    <input type="text" class="form-control formulario__body__campo--input" name="beneficiario" id="beneficiario" value="<?php echo $poliza_caja->beneficiario; ?>">
</div>
<div class="mb-3 formulario__body__campo">
    <label for="" class="form-label formulario__body__campo--label">Fecha inicio</label>
    <input type="date" class="form-control formulario__body__campo--input" name="fe_inicio" id="fe_inicio" value="<?php echo $poliza_caja->fe_inicio; ?>">
</div>
<div class="mb-3 formulario__body__campo">
    <label for="" class="form-label formulario__body__campo--label">Fecha final</label>
    <input type="date" class="form-control formulario__body__campo--input" name="fe_final" id="fe_final" value="<?php echo $poliza_caja->fe_final; ?>">
</div>
<div class="mb-3 formulario__body__campo">
    <label for="" class="form-label formulario__body__campo--label">Enodoso Preferencial</label>
    <input type="text" class="form-control formulario__body__campo--input" name="endoso_pref" id="endoso_pref" value="<?php echo $poliza_caja->endoso_pref; ?>">
</div>
<div class="mb-3 formulario__body__campo">
    <label for="" class="form-label formulario__body__campo--label">Compañía</label>
    <input type="text" class="form-control formulario__body__campo--input" name="aseguradora" id="aseguradora" value="<?php echo $poliza_caja->aseguradora; ?>">
</div>
<div class="mb-3 formulario__body__campo">
    <label for="" class="form-label formulario__body__campo--label">Grupo</label>
    <select class="form-select form-select-sm formulario__body__campo--input" name="grupo" id="grupo">
        <option selected disabled>Seleccione...</option>
        <option value="2134" <?php echo ($poliza_caja->grupo == "2134") ? "selected" : ""; ?>> 2134 </option>
        <option value="5025" <?php echo ($poliza_caja->grupo == "5025") ? "selected" : ""; ?>> 5025 </option>
    </select>
</div>
<div class="mb-3 formulario__body__campo"">
    <label for="" class="form-label formulario__body__campo--label">Subgrupo</label>
    <select class="form-select form-select-sm formulario__body__campo--input" name="subgrupo" id="subgrupo">
        <option selected disabled>Seleccione...</option>
        <option value="1" <?php echo ($poliza_caja->subgrupo == "1") ? "selected" : ""; ?>> 1 </option>
    </select>
</div>
<div class="mb-3 formulario__body__campo">
    <label for="" class="form-label formulario__body__campo--label">Numero de Póliza</label>
    <input type="text" class="form-control formulario__body__campo--input" name="n_poliza" id="n_poliza" value="<?php echo $poliza_caja->n_poliza; ?>">
</div>
<div class="mb-3 formulario__body__campo">
    <label for="" class="form-label formulario__body__campo--label">Robo total</label>
    <select class="form-select form-select-sm formulario__body__campo--input" name="robo_total" id="robo_total">
        <option selected disabled>Seleccione...</option>
        <option value="VALOR COMERCIAL" <?php echo ($poliza_caja->robo_total == "VALOR COMERCIAL") ? "selected" : ""; ?>>VALOR COMERCIAL</option>
        <option value="VALOR FACTURA" <?php echo ($poliza_caja->robo_total == "VALOR FACTURA") ? "selected" : ""; ?>>VALOR FACTURA</option>
        <option value="VALOR CONVENIDO" <?php echo ($poliza_caja->robo_total == "VALOR CONVENIDO") ? "selected" : ""; ?>>VALOR CONVENIDO</option>
    </select>
</div>
<div class="mb-3 formulario__body__campo">
    <label for="" class="form-label formulario__body__campo--label">Daños materiales</label>
    <select class="form-select form-select-sm formulario__body__campo--input" name="danios_mat" id="danios_mat">
    <option selected disabled>Seleccione...</option>
        <option value="VALOR COMERCIAL" <?php echo ($poliza_caja->danios_mat == "VALOR COMERCIAL") ? "selected" : ""; ?>>VALOR COMERCIAL</option>
        <option value="VALOR FACTURA" <?php echo ($poliza_caja->danios_mat == "VALOR FACTURA") ? "selected" : ""; ?>>VALOR FACTURA</option>
        <option value="VALOR CONVENIDO" <?php echo ($poliza_caja->danios_mat == "VALOR CONVENIDO") ? "selected" : ""; ?>>VALOR CONVENIDO</option>
    </select>
</div>
<div class="mb-3 formulario__body__campo">
    <label for="" class="form-label formulario__body__campo--label">Responsabilidad Cívil</label>
    <input type="text" class="form-control formulario__body__campo--input" name="resp_civil" id="resp_civil" value="<?php echo $poliza_caja->resp_civil; ?>">
</div>
<div class="mb-3 formulario__body__campo">
    <label for="" class="form-label formulario__body__campo--label">Costo total Póliza</label>
    <input type="text" class="form-control formulario__body__campo--input" name="costo_poliza" id="costo_poliza" value="<?php echo $poliza_caja->costo_poliza; ?>">
</div>
<div class="mb-3 formulario__body__campo">
    <label for="subir_archivo" class="form-label formulario__body__campo--label">Adjuntar Póliza en PDF</label>
    <input type="file" class="form-control formulario__body__campo--input" name="subir_archivo" id="subir_archivo" accept="application/pdf">
</div>
