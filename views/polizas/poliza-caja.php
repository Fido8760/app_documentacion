<div class="container contenedor">

    <div class="card formulario">
        <div class="card-header d-flex justify-content-between formulario__header">
            <h2 class="display-5 formulario__header--titulo"><?php echo $titulo; ?></h2>
            <a href="/polizas" class="btn btn-info formulario__header--btn-volver">Volver</a>
        </div>
        <div class="card-body formulario__body">
            <h4 class="card-title formulario__body--titulo">Llena los datos solicitados para el registro de la póliza, todos los campos son obligatorios</h4>

            <div class="formulario__body--alertas"><?php include_once __DIR__ . '/../templates/alertas.php' ?></div>


            <form action="/polizas/crear-poliza-remolque" method="POST" enctype="multipart/form-data">

                <?php include_once __DIR__ . '/formulario-c.php' ?>


                <div class="d-grid gap-2 col-6 mx-auto formulario__footer">
                    <input type="submit" class="btn btn-primary formulario__footer--btn-registrar" value="Registrar Póliza de Unidad"></input>
                </div>
            </form>
        </div>
    </div>
</div>