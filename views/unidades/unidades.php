<?php include_once __DIR__ . '/../templates/navbar.php' ?>



<br>
<main class="container">
    <div class="ag-format-container">
        <div class="search-container">
            <input type="text" id="searchInput" placeholder="Buscar...">
        </div>
        <div class="ag-courses_box">
            <?php foreach ($unidades as $unidad): ?>
                <table id="table_id">
                    <div class="ag-courses_item">
                        <div class="ag-courses-item_link">
                            <div class="ag-courses-item_bg"></div>

                            <div class="ag-courses-item_title">
                                <?php echo $unidad->no_unidad;  ?>
                            </div>
                            <ul class="ag-courses-item_description">
                                <li><?php echo $unidad->tipo_unidad;  ?></li>
                                <li><?php echo $unidad->u_marca;  ?></li>
                            </ul>
                            <div class="ag-courses-item_date-box">
                                Placa:
                                <span class="ag-courses-item_date">
                                    <?php echo $unidad->u_placas;  ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </table>
            <?php endforeach; ?>
        </div>
        <div id="pagination" class="pagination"></div>
    </div>
</main>



<?php
$script = "
    <script src='build/js/app.js'></script>
    "
?>