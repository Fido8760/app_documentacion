<h2 class="titulo_principal"><?php echo $titulo; ?></h2>

<div class="card sombreado">
    <div class="card-header">
        <button class="btn btn-primary btn-lg seleccionTarjeta">Agregar Tarjeta de Circulación</button>
    </div>
    <div class="card-body">
        <div class="table-responsive tabla">
            <table class="table align-middle table-hover" id="tabla_id">
                <thead class="table-dark tabla-encabezado">
                    <tr class="tabla-encabezado--fila">
                        <th scope="col">ECONÓMICO</th>
                        <th scope="col">PLACA</th>
                        <th scope="col">FECHA EXPEDICIÓN</th>
                        <th scope="col">FOLIO TARJETA</th>
                        <th scope="col">PERMISO SCT</th>
                        <th scope="col">TARJETA PDF</th>
                        <th scope="col">ACCIONES</th>
                    </tr>
                </thead>
                <tbody class="tabla-body">
                <?php foreach($tarjetas as $tarjeta){?>
                    <tr class="tabla-body--rows">
                        <td class="eco"> <button class="boton-eco" id="mostrarModal" data-id="<?php echo $tarjeta->id;?>"><?php echo $tarjeta->economico; ?></button>  </td>
                        <td><?php echo $tarjeta->placas;?></td>
                        <td><?php echo $tarjeta->fecha_exped;?></td>
                        <td ><?php echo $tarjeta->folio_tarjeta;?></td>
                        <td ><?php echo $tarjeta->permiso_sct;?></td>
                        <td><button type="button" class="btn btn-lg btn-outline-info">PDF</button></td>
                        <td>
                            <form action="/tarjetas-circulacion/eliminar" method="POST">
                            <a class="btn btn-lg btn-info" href="<?php echo $tarjeta->url_detalle; ?>" role="button">Actualizar</a>
                            |
                                <input type="hidden" name="id" value="<?php echo $tarjeta->id; ?>">
                                <button type="submit" class="btn btn-lg btn-danger btn-eliminar" href="" role="button">Eliminar</button>
                            </form>
                           
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
    <script src='build/js/modal-seleccion-tarjeta.js'></script>
    <script src='build/js/datatable.js'></script>
"
?>