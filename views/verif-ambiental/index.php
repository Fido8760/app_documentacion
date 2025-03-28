<h2 class="titulo_principal"><?php echo $titulo; ?></h2>

<div class="card sombreado">
    <div class="card-header">
        <a href="/verif-ambiental/crear" class="btn btn-primary btn-lg">Agregar Verificación</a>
    </div>
    <div class="card-body">
        <div class="table-responsive tabla">
            <table class="table align-middle table-hover" id="tabla_id">
                <thead class="table-dark tabla-encabezado">
                    <tr class="tabla-encabezado--fila">
                        <th scope="col">UNIDAD</th>
                        <th scope="col">PLACAS</th>
                        <th scope="col">FOLIO ACTUAL</th>
                        <th scope="col">FOLIO ANTERIOR</th>
                        <th scope="col">FECHA SEMESTRE ACTUAL</th>
                        <th scope="col">FECHA SEMESTRE ANTERIOR</th>
                        <th scope="col">VERIFICACIÓN PDF</th>
                        <th scope="col">ACCIONES</th>
                    </tr>
                </thead>
                <tbody class="tabla-body">
                <?php foreach($verificaciones_amb as $verificacion){?>
                    <tr class="tabla-body--rows">
                        <td class="eco"> <button class="boton-eco" id="mostrarModal" data-id="<?php echo $verificacion->id;?>"><?php echo $verificacion->unidad->no_unidad; ?></button>  </td>
                        <td><?php echo $verificacion->unidad->u_placas;?></td>
                        <td ><span class="verif_folio-actual"><?php echo $verificacion->folio_amb;?></span></td>
                        <td ><span class="verif_folio-anterior"><?php echo $verificacion->anterior->folio_verif_ant ?? '';?></span></td>
                        <td ><span class="verif_fecha-actual"><?php echo $verificacion->fecha_semestre_actual;?></span></td>
                        <td ><span class="verif_fecha-anterior"><?php echo $verificacion->anterior->fecha_verif_ant ?? '';?></span></td>
                        <td><a href="/verif-ambiental/archivo?pdf=<?php echo urlencode($verificacion->subir_archivo_amb); ?>" type="button" class="btn btn-lg btn-outline-secondary" target="_blank">PDF</a>
                        <td>
                        <?php if($_SESSION['rol'] == '1'){ ?>
                            
                            <form action="/verif-ambiental/eliminar" method="POST">
                            <a class="btn btn-lg btn-info" href="/verif-ambiental/actualizar?id=<?php echo $verificacion->id; ?>" role="button">Editar</a>
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
    <script src='build/js/modal-unidad.js'></script>
    <script src='build/js/datatable.js'></script>
    <script src='build/js/exportarExcelVerifAmb.js'></script>

    "
?>