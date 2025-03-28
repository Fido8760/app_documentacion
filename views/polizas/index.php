<h2 class="titulo_principal"><?php echo $titulo; ?></h2>

<div class="card sombreado">
    <div class="card-header">
        <button class="btn btn-primary btn-lg modalSeleccion">Agregar Póliza</button>
    </div>
    <div class="card-body">
        <div class="table-responsive tabla">
            <table class="table align-middle table-hover" id="tabla_id">
                <thead class="table-dark">
                    <tr>
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

                <?php foreach($polizas as $poliza){?>
                    <tr class="">
                        <td class="eco"><button class="boton-eco" id="mostrarModal" data-id="<?php echo $poliza->id;?>"><?php echo $poliza->economico; ?></button></td>
                        <td><?php echo $poliza->n_poliza;?></td>
                        <td><?php echo $poliza->tipo;?></td>
                        <td><?php echo $poliza->placas;?></td>
                        <td><?php echo $poliza->fe_final;?></td>
                        <td><span class="estatus"><?php echo $poliza->estatus;?></span></td>
                        <td><a href="/polizas/archivo?pdf=<?php echo urlencode($poliza->subir_archivo); ?>" type="button" class="btn btn-lg btn-outline-secondary" target="_blank">PDF</a></td>
                        <td>
                        <?php if($_SESSION['rol'] == '1'){ ?>

                            <form action="/polizas/eliminar" method="POST">
                                <a class="btn btn-lg btn-info" href="<?php echo $poliza->url_detalle; ?>" role="button">Actualizar</a>
                                |
                                <input type="hidden" name="id" value="<?php echo $poliza->id; ?>">
                                <button type="submit" class="btn btn-lg btn-danger btn-eliminar" href="" role="button">Eliminar</button>
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
        <button class="btn btn-success btn-lg" id="bontonExportar" >Exportar a Excel</button>
    </div>
</div>


<?php
$script = "
    <script src='build/js/alertas.js'></script>
    <script src='build/js/modal-polizas.js'></script>
    <script src='build/js/modal-seleccion.js'></script>
    <script src='build/js/vencimiento.js'></script>
    <script src='build/js/datatable.js'></script>
    <script src='build/js/exportarExcelPolizas.js'></script>
    "
?>


