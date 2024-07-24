<main class="container">
    <h1>Crear</h1>
    <?php include_once __DIR__ . '/../template/alertas.php' ?>
    <form action="/unidades/crear" method="post">
        <?php include __DIR__ . '/formulario.php' ?>
    <div class="form-group row">
        <div class="col-sm-10">
            <button type="submit" class="btn btn-success">Agregar</button>
            <a class="btn btn-primary" href="/unidades">Cancelar</a>
        </div>
    </div>
       
    </form>
</main>