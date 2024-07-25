<br>
<main class="container">
<?php include_once __DIR__ . '/../template/alertas.php' ?>
    <div class="card">
        <form method="post">
            <div class="card-header">
                <h3>Actualizar  Unidad</h3>
            </div>
            <?php include __DIR__ . '/formulario.php' ?>
            <div class="card-footer">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-success">Actualizar</button>
                    <a class="btn btn-primary" href="/unidades">Cancelar</a>
                </div>
            </div>
        </form>
    </div>
</main>