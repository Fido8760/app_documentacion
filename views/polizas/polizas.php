<?php include_once __DIR__ . '/../templates/navbar.php' ?>
<br>
<main class="container">
    <h1>Pólizas</h1>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col float-right">
                <!-- Modal trigger button -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_Seleccion_Poliza">Agregar Póliza</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="tabla_id">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Economico</th>
                        <th scope="col">No. Póliza</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Placas</th>
                        <th scope="col">Vigencia</th>
                        <th scope="col">Estatus</th>
                        <th scope="col">Póliza PDF</th>
                        <th scope="col">Acción</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($polizas as $poliza):?>
                        <tr class="">
                            <td scope="row"><?php echo $poliza->id;?></td>
                            <td><button type="button" class="btn btn-secondary abrirModal" ><?php echo $poliza->economico;?></button></td>
                            <td><?php echo $poliza->n_poliza;?></td>
                            <td><?php echo $poliza->tipo;?></td>
                            <td><?php echo $poliza->placas;?></td>
                            <td><?php echo $poliza->fe_final;?></td>
                            <td><?php  echo '<button type="button" class="btn btn-danger">Vencido</button>';?></td>
                            <td><a class="btn btn-info" href="#" target="_blank">PDF</a></td>
                            <td>
                                <form action="/polizas/eliminar" method="POST" class="form-eliminar">
                                    <a class="btn btn-info" href="#" role="button">Editar</a>
                                    <input type="hidden" name="id" value="<?php echo $poliza->id; ?>">
                                    <input type="submit" value="Eliminar" class="btn btn-danger btn-eliminar">
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            <a name="" id="" class="btn btn-success" href="#" role="button">Exportar a Excel</a>
        </div>
    </div>
</main>

<?php 
include_once __DIR__ . '/modal-seleccion.php';
?>