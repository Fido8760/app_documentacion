<br>
<main class="container">
<?php include_once __DIR__ . '/../template/alertas.php' ?>
    <div class="card">
        <form action="/auth/crear-usuario" method="post">
            <div class="card-header">
                <h3>Agregar Usuario</h3>
            </div>
            <?php include __DIR__ . '/formulario.php' ?>
            <div class="card-footer">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-success">Agregar</button>
                    <a class="btn btn-primary" href="/auth/usuarios">Cancelar</a>
                </div>
            </div>  
        </form>
    </div>
</main>