<h2><?php echo $titulo; ?></h2>

<br>
<main class="inventario">
    <div class="inventario__format-container">
        <div class="inventario__search-container">
            <input type="text" id="searchInput" class="inventario__search-input" placeholder="Buscar...">
        </div>
        <div class="inventario__courses-box">
            <?php foreach ($unidades as $unidad): ?>
                <div class="inventario__courses-item mostrarModal" data-id="<?php echo $unidad->id; ?>">
                    <div class="inventario__courses-item-link--unidades">
                        <div class="inventario__courses-item-bg"></div>

                        <div class="inventario__courses-item-title">
                            <?php echo $unidad->no_unidad; ?>
                        </div>
                        <ul class="inventario__courses-item-description">
                            <li class="inventario__courses-item-type"><?php echo $unidad->tipo_unidad; ?></li>
                            <li class="inventario__courses-item-brand"><?php echo $unidad->u_marca; ?></li>
                        </ul>
                        <div class="inventario__courses-item-date-box">
                            Placa:
                            <span class="inventario__courses-item-date">
                                <?php echo $unidad->u_placas; ?>
                            </span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div id="pagination" class="inventario__pagination"></div>
    </div>
</main>




<?php
$script = "
    <script src='build/js/app.js'></script>
    <script src='build/js/modal.js'></script>
    "
?>