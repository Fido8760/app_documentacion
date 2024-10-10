<h2 class="titulo_principal"><?php echo $titulo; ?></h2>

<div class="card sombreado">
    <div class="card-header">
        <a href="/usuarios/crear-usuario" class="btn btn-primary btn-lg">Agregar usuario</a>
    </div>
    <div class="card-body">
        <div class="table-responsive tabla">
            <table class="table align-middle table-hover" id="tabla_id">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Rol</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>

                <?php foreach($usuarios as $usuario){?>
                    <tr class="">
                        <td scope="row"><?php echo $usuario->id;?></td>
                        <td class="eco"> <button class="boton-eco" id="mostrarModal" data-id="<?php echo $usuario->id;?>"><?php echo $usuario->nombre . ' ' . $usuario->apellido; ?></button>  </td>
                        <td><?php echo $usuario->email;?></td>
                        <td><?php echo $usuario->roles->rol;?></td>
                        <td>
                        <?php if($usuario->email !== 'soporte@mudanzasamado.mx') : ?>
                            <form action="/usuarios/eliminar" method="POST">
                                <input type="hidden" name="id" value="<?php echo $usuario->id; ?>">
                                <button type="submit" class="btn btn-lg btn-danger btn-eliminar" role="button">Eliminar</button>
                            </form>
                        <?php endif; ?>
                        </td>
                    </tr>
                <?php } ?>

                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">
    <button class="btn btn-success btn-lg" onclick="exportarExcel()">Exportar a Excel</button>
    </div>
</div>


<?php
$script = "
    
    <script src='build/js/alertas.js'></script>
    <script src='build/js/modal-usuario.js'></script>
    <script src='build/js/datatable.js'></script>
    "
?>
