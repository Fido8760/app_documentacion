<h2 class="titulo_principal"><?php echo $titulo; ?></h2>

<div class="card sombreado">
    <div class="card-header">
        <a href="/gps/crear" class="btn btn-primary btn-lg">Ligar GPS a Unidad</a>
    </div>
    <div class="card-body">
        <div class="table-responsive tabla">
            <table class="table align-middle table-hover" id="tabla_id">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">UNIDAD</th>
                        <th scope="col">MARCA</th>
                        <th scope="col">MODELO</th>
                        <th scope="col">IMEI</th>
                        <th scope="col">LÍNEA</th>
                        <th scope="col">APN</th>
                        <th scope="col">ACCIONES</th>
                    </tr>
                </thead>
                <tbody>

                <?php foreach($localizadores as $localizador){?>
                    <tr class="">
                        <td scope="row"><?php echo $localizador->id;?></td>
                        <td class="eco"> <button class="boton-eco" id="mostrarModal" data-id="<?php echo $localizador->unidades->id;?>"><?php echo $localizador->unidades->no_unidad; ?></button>  </td>
                        <td><?php echo $localizador->marca_gps;?></td>
                        <td><?php echo $localizador->modelo;?></td>
                        <td><?php echo $localizador->imei_gps;?></td>
                        <td><?php echo $localizador->linea;?></td>
                        <td><?php echo $localizador->apn;?></td>
                        <td>
                            <form action="/gps/eliminar" method="POST">
                            <a class="btn btn-lg btn-info" href="/gps/actualizar?id=<?php echo $localizador->id; ?>" role="button">Editar</a>
                            |
                                <input type="hidden" name="id" value="<?php echo $localizador->id; ?>">
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
    <script src='build/js/modal-unidad.js'></script>
    <script src='build/js/datatable.js'></script>
    "
?>