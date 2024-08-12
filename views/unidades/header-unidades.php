<br>
<main class="container">
<?php include_once __DIR__ . '/../templates/alertas.php' ?>
    <div class="card">
        <form action="/unidades/crear" method="post">
            <div class="card-header">
                <h3>Crear Unidad</h3>
            </div>
            <?php include __DIR__ . '/formulario-unidad.php' ?>
            <div class="card-footer">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-success">Agregar</button>
                    <a class="btn btn-primary" href="/unidades">Cancelar</a>