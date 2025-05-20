<h2 class="titulo_principal"><?php echo $titulo; ?></h2>

<div class="card sombreado">
    <div class="card-header d-flex justify-content-between">
        <a href="/operadores/crear" class="btn btn-primary btn-lg">Nuevo Operador</a>
    </div>
    <div class="card-body">
        <div class="table-responsive tabla">
            <table class="table align-middle table-hover" id="tabla_id">
                <thead class="table-dark tabla-encabezado">
                    <tr class="tabla-encabezado--fila">
                        <th scope="col">ID</th>
                        <th scope="col">OPERADOR</th>
                        <th scope="col">LICENCIA</th>
                        <th scope="col">APTO</th>
                        <th scope="col">INE</th>
                        <th scope="col">R-CONTROL</th>
                        <th scope="col">ACCIONES</th>
                    </tr>
                </thead>
                <tbody class="tabla-body">
                <?php foreach($operadores as $operador){?>
                    <tr class="tabla-body--rows">
                        <td><?php echo $operador->id;?></td>
                        <td class="eco"> <button class="boton-eco" id="mostrarModal" data-id="<?php echo $operador->id;?>"><?php echo $operador->nombre . " " . $operador->apellido_p . " " . $operador->apellido_m; ?></button>  </td>
                        <td>
                            <?php if(!empty($operador->subir_archivo_licencia)) { ?>
                                <a href="/operadores/archivo?pdf=<?php echo urlencode($operador->subir_archivo_licencia); ?>" type="button" class="btn btn-lg btn-outline-secondary" target="_blank">PDF</a>
                            <?php } ?>
                        </td>
                        <td>
                            <?php if(!empty($operador->subir_archivo_apto)) { ?>
                                <a href="/operadores/archivo?pdf=<?php echo urlencode($operador->subir_archivo_apto); ?>" type="button" class="btn btn-lg btn-outline-secondary" target="_blank">PDF</a>
                            <?php } ?>
                        </td>
                        <td>
                            <?php if(!empty($operador->subir_archivo_ine)) { ?>
                                <a href="/operadores/archivo?pdf=<?php echo urlencode($operador->subir_archivo_ine); ?>" type="button" class="btn btn-lg btn-outline-secondary" target="_blank">PDF</a>
                            <?php } ?>
                        </td>
                        <td>
                            <?php if(!empty($operador->subir_archivo_control)) { ?>
                                <a href="/operadores/archivo?pdf=<?php echo urlencode($operador->subir_archivo_control); ?>" type="button" class="btn btn-lg btn-outline-secondary" target="_blank">PDF</a>
                            <?php } ?>
                        </td>
                        <td>
                        <?php if($_SESSION['rol'] == '1' || $_SESSION['rol'] == '3'){ ?>

                            <form action="/operadores/eliminar" method="POST">
                            <a class="btn btn-lg btn-info"href="/operadores/actualizar?id=<?php echo $operador->id; ?>" role="button">Actualizar</a>
                            |
                                <input type="hidden" name="id" value="<?php echo $operador->id; ?>">
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
        <button class="btn btn-success btn-lg" id="bontonExportarOperadores" >Exportar a Excel</button>
    </div>
</div>


<?php
$script = "
    <script src='build/js/alertas.js'></script>
    <script src='build/js/modal-operadores.js'></script>
    <script src='build/js/datatable.js'></script>
    <script src='build/js/exportarExcelOperadores.js'></script>
"
?>