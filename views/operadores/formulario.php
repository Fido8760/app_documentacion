<fieldset class="formulario__fieldset">
    <legend>Datos Personales</legend>
    <div class="mb-3 formulario__body__campo">
        <label for="nombre" class="form-label formulario__body__campo--label">Nombre</label>
        <input type="text" class="form-control formulario__body__campo--input" name="nombre" id="nombre" value="<?php echo $operador->nombre; ?>" placeholder="Escribe el nombre del Operador">       
    </div>
    <div class="mb-3 formulario__body__campo">
        <label for="apellido_p" class="form-label formulario__body__campo--label">Apellido Paterno</label>
        <input type="text" class="form-control formulario__body__campo--input" name="apellido_p" id="apellido_p" value="<?php echo $operador->apellido_p; ?>" placeholder="Escribe el Apellido Paterno del Operador">       
    </div>
    <div class="mb-3 formulario__body__campo">
        <label for="apellido_m" class="form-label formulario__body__campo--label">Apellido Materno</label>
        <input type="text" class="form-control formulario__body__campo--input" name="apellido_m" id="apellido_m" value="<?php echo $operador->apellido_m; ?>" placeholder="Escribe el Apellido Materno del Operador">       
    </div>
    <div class="mb-3 formulario__body__campo">
        <label for="id_puesto" class="form-label formulario__body__campo--label">Puesto</label>
        <select class="form-select form-select-sm formulario__body__campo--input" name="id_puesto" id="id_puesto">
            <?php foreach($puestos as $puesto) { ?>
            <?php if($puesto->id) { ?>
                <option <?php echo $operador->id_puesto === $puesto->id ? 'selected' : '' ?> value="<?php echo $puesto->id; ?>"><?php echo $puesto->puesto; ?></option>
            <?php }}; ?>
        </select>
    </div>
    <div class="mb-3 formulario__body__campo">
        <label for="curp" class="form-label formulario__body__campo--label">CURP:</label>
        <input type="text" class="form-control formulario__body__campo--input" name="curp" id="curp" value="<?php echo $operador->curp; ?>" placeholder="Escribe el CURP del Operador">       
    </div>
    <div class="mb-3 formulario__body__campo">
        <label for="rfc" class="form-label formulario__body__campo--label">RFC:</label>
        <input type="text" class="form-control formulario__body__campo--input" name="rfc" id="rfc" value="<?php echo $operador->rfc; ?>" placeholder="Escribe el RFC del Operador">       
    </div>
    <div class="mb-3 formulario__body__campo">
        <label for="nss" class="form-label formulario__body__campo--label">Número de Seguridad Social:</label>
        <input type="text" class="form-control formulario__body__campo--input" name="nss" id="nss" value="<?php echo $operador->nss; ?>" placeholder="Escribe el NSS del Operador">       
    </div>
    <div class="mb-3 formulario__body__campo">
        <label for="fe_ingreso" class="form-label formulario__body__campo--label">Fecha de Ingreso:</label>
        <input type="date" class="form-control formulario__body__campo--input" name="fe_ingreso" id="fe_ingreso" value="<?php echo $operador->fe_ingreso; ?>" >       
    </div>
</fieldset>

<fieldset class="formulario__fieldset">
    <legend>Documentación</legend>
    <div class="mb-3 formulario__body__campo">
        <label for="subir_archivo_licencia" class="form-label formulario__body__campo--label">Adjuntar Licencia en PDF</label>
        <input type="file" class="form-control formulario__body__campo--input" name="subir_archivo_licencia" id="subir_archivo_licencia" accept="application/pdf">
    </div>
    <div class="mb-3 formulario__body__campo">
        <label for="vigencia_lic" class="form-label formulario__body__campo--label">Vigencia de Licencia:</label>
        <input type="date" class="form-control formulario__body__campo--input" name="vigencia_lic" id="vigencia_lic" value="<?php echo $operador->vigencia_lic; ?>" >       
    </div>

    <div class="mb-3 formulario__body__campo">
        <label for="subir_archivo_apto" class="form-label formulario__body__campo--label">Adjuntar Apto en PDF</label>
        <input type="file" class="form-control formulario__body__campo--input" name="subir_archivo_apto" id="subir_archivo_apto" accept="application/pdf">
    </div>
    <div class="mb-3 formulario__body__campo">
        <label for="vigencia_apto" class="form-label formulario__body__campo--label">Vigencia del Apto:</label>
        <input type="date" class="form-control formulario__body__campo--input" name="vigencia_apto" id="vigencia_apto" value="<?php echo $operador->vigencia_apto; ?>" >       
    </div>

    <div class="mb-3 formulario__body__campo">
        <label for="subir_archivo_ine" class="form-label formulario__body__campo--label">Adjuntar INE en PDF</label>
        <input type="file" class="form-control formulario__body__campo--input" name="subir_archivo_ine" id="subir_archivo_ine" accept="application/pdf">
    </div>

    <div class="mb-3 formulario__body__campo">
        <label for="subir_archivo_control" class="form-label formulario__body__campo--label">Adjuntar R-Control en PDF</label>
        <input type="file" class="form-control formulario__body__campo--input" name="subir_archivo_control" id="subir_archivo_control" accept="application/pdf">
    </div>

</fieldset>