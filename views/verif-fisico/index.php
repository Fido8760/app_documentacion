<h2 class="titulo_principal"><?php echo $titulo; ?></h2>

<div class="card sombreado">
    <div class="card-header">
        <button class="btn btn-primary btn-lg seleccionFisico">Agregar Verificación Físico</button>
    </div>
    <div class="card-body">
        <div class="table-responsive tabla">
            <table class="table align-middle table-hover" id="tabla_id">
                <thead class="table-dark tabla-encabezado">
                    <tr class="tabla-encabezado--fila">
                        <th scope="col">ECONOMICO</th>
                        <th scope="col">PLACAS</th>
                        <th scope="col">FOLIO</th>
                        <th scope="col">FECHA VERIFICIACIÓN</th>
                        <th scope="col">VERIFICACIÓN PDF</th>
                        <th scope="col">ACCIONES</th>
                    </tr>
                </thead>
                <tbody class="tabla-body">
                <?php foreach($verificaciones_fisico as $verificacion){?>
                    <tr class="tabla-body--rows">
                        <td class="eco"> <button class="boton-eco" id="mostrarModal" data-id="<?php echo $verificacion->id;?>"><?php echo $verificacion->economico; ?></button>  </td>
                        <td><?php echo $verificacion->placas;?></td>
                        <td ><span class="verif_folio-actual"><?php echo $verificacion->folio_fis;?></span></td>
                        <td ><span class="verif_fecha-actual"><?php echo $verificacion->fecha_verif_fis;?></span></td>
                        <td><a href="/verif-fisico/archivo?pdf=<?php echo urlencode($verificacion->subir_archivo_fisico); ?>" type="button" class="btn btn-lg btn-outline-secondary" target="_blank">PDF</a></td>
                        <td>
                        <?php if($_SESSION['rol'] == '1'){ ?>

                            <form action="/verif-fisico/eliminar" method="POST">
                            <a class="btn btn-lg btn-info" href="<?php echo $verificacion->url_detalle; ?>" role="button">Actualizar</a>
                            |
                                <input type="hidden" name="id" value="<?php echo $verificacion->id; ?>">
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
    <script src='build/js/modal-seleccion-fisico.js'></script>
    <script src='build/js/datatable.js'></script>
    <script src='build/js/exportarExcelVerifFisico.js'></script>

"
?>