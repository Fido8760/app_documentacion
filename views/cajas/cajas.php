<br>
<main class="container">
    <h3>Cajas</h3>
    <div class="card">
        <div class="card-header">
            <a href="/cajas/crear" class="btn btn-primary">Agregar Caja</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="tabla_id">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Número Caja</th>
                            <th scope="col">Placas</th>
                            <th scope="col">Capacidad</th>
                            <th scope="col">Marca</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>

                    <?php foreach($cajas as $caja){?>
                        <tr class="">
                            <td scope="row"><?php echo $caja->id;?></td>
                            <td><button type="button" class="btn btn-secondary" role ="button" ><?php echo $caja->numero_caja;?></button></td>
                            <td><?php echo $caja->c_placas;?></td>
                            <td><?php echo $caja->capacidad;?></td>
                            <td><?php echo $caja->c_marca;?></td>
                            <td>
                                <form action="/cajas/eliminar" method="POST" class="form-eliminar">
                                    <a class="btn btn-info" href="/cajas/actualizar?id=<?php echo $caja->id; ?>" role="button">Editar</a>
                                    <input type="hidden" name="id" value="<?php echo $caja->id; ?>">
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
    
    "
?>
