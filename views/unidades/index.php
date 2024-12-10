<h2 class="titulo_principal"><?php echo $titulo; ?></h2>

<div class="card sombreado">
    <div class="card-header">
        <a href="/unidades/crear" class="btn btn-primary btn-lg">Agregar Unidad</a>
    </div>
    <div class="card-body">
        <div class="table-responsive tabla">
            <table class="table align-middle table-hover" id="tabla_id">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Número Unidad</th>
                        <th scope="col">Placa</th>
                        <th scope="col">Tipo unidad</th>
                        <th scope="col">Marca</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>

                <?php foreach($unidades as $unidad){?>
                    <tr class="">
                        <td scope="row"><?php echo $unidad->id;?></td>
                        <td class="eco"> <button class="boton-eco" id="mostrarModal" data-id="<?php echo $unidad->id;?>"><?php echo $unidad->no_unidad; ?></button>  </td>
                        <td><?php echo $unidad->u_placas;?></td>
                        <td><?php echo $unidad->tipo_unidad;?></td>
                        <td><?php echo $unidad->u_marca;?></td>
                        <td>
                            <?php if($_SESSION['rol'] == '1'){ ?>
                                
                                <form action="/unidades/eliminar" method="POST">
                                <a class="btn btn-lg btn-info" href="/unidades/actualizar?id=<?php echo $unidad->id; ?>" role="button">Editar</a>
                                |
                                    <input type="hidden" name="id" value="<?php echo $unidad->id; ?>">
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
        <button class="btn btn-success btn-lg" id="bontonExportarUnidades" >Exportar a Excel</button>
    </div>
</div>


<?php
$script = "
    
    <script src='build/js/alertas.js'></script>
    <script src='build/js/modal-unidad.js'></script>
    <script src='build/js/datatable.js'></script>
    <script src='build/js/exportarExcelUnidades.js'></script>
    "
?>