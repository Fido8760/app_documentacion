<main class="container">
    <h3>Unidades</h3>
    <div class="card">
        <div class="card-header">
            <a href="/unidades/crear" class="btn btn-primary">Agregar Unidad</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="tabla_id">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Número Unidad</th>
                            <th scope="col">Placa</th>
                            <th scope="col">Tipo unidad</th>
                            <th scope="col">Marca</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>

                    <?php foreach($unidades as $unidad){?>
                        <tr class="">
                            <td scope="row"><?php echo $unidad->id;?></td>
                            <td><button type="button" class="btn btn-secondary" role ="button" ><?php echo $unidad->no_unidad;?></button></td>
                            <td><?php echo $unidad->u_placas;?></td>
                            <td><?php echo $unidad->tipo_unidad;?></td>
                            <td><?php echo $unidad->u_marca;?></td>
                            <td>
                                <form action="/unidades/eliminar" method="POST" class="form-eliminar">
                                    <a class="btn btn-info" href="/unidades/actualizar?id=<?php echo $unidad->id; ?>" role="button">Editar</a>
                                    <input type="hidden" name="id" value="<?php echo $unidad->id; ?>">
                                    <input type="submit" value="Eliminar" class="btn btn-danger btn-eliminar">
                                </form>
                            </td>
                        </tr>
                    <?php } ?>

                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-success" onclick="exportarExcel()">Exportar a Excel</button>
        </div>
    </div>
</main>

<?php
    $script = "
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script src='build/js/app.js'></script>
    "
?>
