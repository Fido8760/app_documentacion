<h2 class="titulo_principal"><?php echo $titulo; ?></h2>

<div class="card sombreado">
    <div class="card-header">
        <button class="btn btn-primary btn-lg seleccionAcuse">Agregar Acuse</button>
    </div>
    <div class="card-body">
        <div class="table-responsive tabla">
            <table class="table align-middle table-hover" id="tabla_id">
                <thead class="table-dark tabla-encabezado">
                    <tr class="tabla-encabezado--fila">
                        <th scope="col">ECONOMICO</th>
                        <th scope="col">PLACAS</th>
                        <th scope="col">PÓLIZA</th>
                        <th scope="col">TARJETA DE CIRCULACIÓN</th>
                        <th scope="col">VERIFICACIÓN AMBIENTAL</th>
                        <th scope="col">VERIFICACIÓN FISICO</th>
                        <th scope="col">ACCIONES</th>
                    </tr>
                </thead>
                <tbody class="tabla-body">
                <?php foreach($acuses as $acuse){ ?>
                    <tr class="tabla-body--rows">
                        <td class="eco"><button class="boton-eco" id="mostrarModal" data-id="<?php echo $acuse->id;?>"><?php echo $acuse->economico; ?></button></td>
                        <td><?php echo $acuse->placas; ?></td>
                        <td>
                            <?php if(!empty($acuse->archivo_poliza_acuse)) { ?>
                                <a href="/acuses/archivo?pdf=<?php echo urlencode($acuse->archivo_poliza_acuse); ?>" type="button" class="btn btn-lg btn-outline-secondary" target="_blank">PDF</a>
                            <?php } ?>
                        </td>
                        <td>
                            <?php if(!empty($acuse->archivo_tarcirc_acuse)) { ?>
                                <a href="/acuses/archivo?pdf=<?php echo urlencode($acuse->archivo_tarcirc_acuse); ?>" type="button" class="btn btn-lg btn-outline-secondary" target="_blank">PDF</a>
                            <?php } ?>
                        </td>
                        <td>
                            <?php if(!empty($acuse->archivo_veriambiental_acuse)) { ?>
                                <a href="/acuses/archivo?pdf=<?php echo urlencode($acuse->archivo_veriambiental_acuse); ?>" type="button" class="btn btn-lg btn-outline-secondary" target="_blank">PDF</a>
                            <?php } ?>
                        </td>
                        <td>
                            <?php if(!empty($acuse->archivo_verifisico_acuse)) { ?>
                                <a href="/acuses/archivo?pdf=<?php echo urlencode($acuse->archivo_verifisico_acuse); ?>" type="button" class="btn btn-lg btn-outline-secondary" target="_blank">PDF</a>
                            <?php } ?>
                        </td>
                        <td>
                        <?php if($_SESSION['rol'] == '1'){ ?>

                            <form action="/acuses/eliminar" method="POST">
                                <a class="btn btn-lg btn-info" href="<?php echo $acuse->url_detalle; ?>" role="button">Actualizar</a>
                                |
                                <input type="hidden" name="id" value="<?php echo $acuse->id; ?>">
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
    <button class="btn btn-success btn-lg" onclick="exportarExcel()">Exportar a Excel</button>
    </div>
</div>


<?php
$script = "
    <script src='build/js/alertas.js'></script>
    <script src='build/js/modal-seleccion-acuse.js'></script>
    <script src='build/js/datatable.js'></script>
"
?>