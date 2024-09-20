<h2 class="titulo_principal"><?php echo $titulo; ?></h2>

<main class="container">
    <div class="card">
        <div class="card-header">
            <a href="/auth/crear-usuario" class="btn btn-primary">Agregar Usuario</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="tabla_id">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Correo</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>

                    <?php foreach($usuarios as $usuario){?>
                        <tr class="">
                            <td scope="row"><?php echo $usuario->id;?></td>
                            <td><button type="button" class="btn btn-secondary" role ="button" ><?php echo $usuario->nombre . " " . $usuario->apellido;?></button></td>
                            <td><?php echo $usuario->email;?></td>
                            <td>
                                <form action="/auth/eliminar" method="POST" class="form-eliminar">
                                    <a class="btn btn-info" href="/auth/actualizar?id=<?php echo $usuario->id; ?>" role="button">Editar</a>
                                    <input type="hidden" name="id" value="<?php echo $usuario->id; ?>">
                                    <input type="submit" value="Eliminar" class="btn btn-danger btn-eliminar">
                                </form>
                            </td>
                        </tr>
                    <?php } ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<?php
    $script = "

    "
?>
