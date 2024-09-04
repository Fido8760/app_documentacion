<div class="card-body">
    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre: </label>
    
        <input type="text" class="form-control" name="nombre" id="nombre" aria-describedby="helpId" placeholder="Escriba su nombre" value="<?php echo s($usuario->nombre); ?>">
    
    </div>
    
    <div class="mb-3">
    
        <label for="apellido" class="form-label">Apellido: </label>
        <input type="text" class="form-control" name="apellido" id="apellido" aria-describedby="helpId" placeholder="Escriba su apellido" value="<?php echo s($usuario->apellido); ?>" >
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">E-Mail: </label>
        <input type="email" class="form-control" name="email" id="email" placeholder="Escriba su email" value="<?php echo s($usuario->email); ?>">
    </div>
       
    <div class="mb-3">
        <label for="password" class="form-label">Password: </label>
        <input type="password" class="form-control" name="password" id="password" placeholder="Escriba su password">
    </div>
</div>