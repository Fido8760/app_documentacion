<br>
<main class="container">
<?php include_once __DIR__ . '/../template/alertas.php' ?>
    <div class="card">
        <div class="card-header">
            <h3>Crear Póliza de Unidad Vehícular</h3>
        </div>
        <form action="/polizas/crear-poliza-vehicular" method="POST" enctype="multipart/form-data" >
            <div class="card-body">
                <?php include __DIR__ . '/formulario.php' ?>
            </div>
            <div class="card-footer">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-success">Agregar</button>
                    <a class="btn btn-primary" href="/polizas">Cancelar</a>
                </div>
            </div> 
        </form> 
    </div>
</main>