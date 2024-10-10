<fieldset class="formulario__fieldset">
    <legend>Datos de usuario</legend>
    <div class="mb-3 formulario__body__campo">
        <label for="nombre" class="form-label formulario__body__campo--label">Nombre: </label>
        <input type="text" class="form-control formulario__body__campo--input" name="nombre" id="nombre" aria-describedby="helpId" placeholder="Escriba su nombre" value="<?php echo s($usuario->nombre); ?>">

    </div>

    <div class="mb-3 formulario__body__campo">

        <label for="apellido" class="form-label formulario__body__campo--label">Apellido: </label>
        <input type="text" class="form-control formulario__body__campo--input" name="apellido" id="apellido" aria-describedby="helpId" placeholder="Escriba su apellido" value="<?php echo s($usuario->apellido); ?>">
    </div>
    <div class="mb-3 formulario__body__campo">
        <label for="email" class="form-label formulario__body__campo--label">E-Mail: </label>
        <input type="email" class="form-control formulario__body__campo--input" name="email" id="email" placeholder="Escriba su email" value="<?php echo s($usuario->email); ?>">
    </div>
    <?php if (!$actualizando): ?>
        <div class="mb-3 formulario__body__campo">
            <label for="password" class="form-label formulario__body__campo--label">Password: </label>
            <input type="password" class="form-control formulario__body__campo--input" name="password" id="password" placeholder="Escriba su password">
        </div>
    <?php endif; ?>
    <div class="mb-3 formulario__body__campo">
        <label for="id_rol" class="form-label formulario__body__campo--label">Rol de Usuario:</label>
        <select class="form-select form-select-sm formulario__body__campo--input" name="id_rol" id="id_rol">
            <?php foreach($roles as $rol) { ?>
            <?php if($rol->id) { ?>
                <option <?php echo $usuario->id_rol === $rol->id ? 'selected' : '' ?> value="<?php echo $rol->id; ?>"><?php echo $rol->rol; ?></option>
            <?php }}; ?>
        </select>
    </div>
</fieldset>