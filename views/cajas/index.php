<h2><?php echo $titulo; ?></h2>

<br>
<main class="inventario">
    <div class="inventario__format-container">
        <div class="inventario__search-container">
            <input type="text" id="searchInput" class="inventario__search-input" placeholder="Buscar...">
        </div>
        <div class="inventario__courses-box">
            <?php foreach ($cajas as $caja): ?>
                <div class="inventario__courses-item">
                    <div class="inventario__courses-item-link--cajas">
                        <div class="inventario__courses-item-bg"></div>

                        <div class="inventario__courses-item-title">
                            <?php echo $caja->numero_caja; ?>
                        </div>
                        <ul class="inventario__courses-item-description">
                            <li class="inventario__courses-item-type"><?php echo $caja->capacidad; ?></li>
                            <li class="inventario__courses-item-brand"><?php echo $caja->c_marca; ?></li>
                        </ul>
                        <div class="inventario__courses-item-date-box">
                            Placa:
                            <span class="inventario__courses-item-date">
                                <?php echo $caja->c_placas; ?>
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
    "
?>