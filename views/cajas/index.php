<h2 class="titulo_principal"><?php echo $titulo; ?></h2>

<div class="card sombreado">
    <div class="card-header">
        <a href="/cajas/crear" class="btn btn-primary btn-lg">Agregar Remolque</a>
    </div>
    <div class="card-body">
        <div class="table-responsive tabla">
            <table class="table align-middle table-hover" id="tabla_id">
                <thead class="table-dark">
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
                        <td class="eco"> <button class="boton-eco mostrarModal" data-id="<?php echo $caja->id;?>"><?php echo $caja->numero_caja; ?></button>  </td>
                        <td><?php echo $caja->c_placas;?></td>
                        <td><?php echo $caja->capacidad;?></td>
                        <td><?php echo $caja->c_marca;?></td>
                        <td>
                        <?php if($_SESSION['rol'] == '1'){ ?>

                            <form action="/cajas/eliminar" method="POST">
                            <a class="btn btn-lg btn-info" href="/cajas/actualizar?id=<?php echo $caja->id; ?>" role="button">Editar</a>
                            |
                                <input type="hidden" name="id" value="<?php echo $caja->id; ?>">
                                <button type="submit" class="btn btn-lg btn-danger btn-eliminar" role="button">Eliminar</button>
                            </form>
                        <?php } ?>
                        </td>
                    </tr>
                <?php } ?>

                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">
        <button class="btn btn-success btn-lg" id="bontonExportarCajas" >Exportar a Excel</button>
    </div>
</div>


<?php
$script = "
    <script src='build/js/alertas.js'></script>
    <script src='build/js/datatable.js'></script>
    <script src='build/js/modal-caja.js'></script>
    <script src='build/js/exportarExcelCajas.js'></script>
    "
?>