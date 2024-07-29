<?php
foreach($alertas as $tipo => $mensajes) {
    foreach($mensajes as $mensaje) {
        $alertClass = $tipo === 'exito' ? 'alert-success' : 'alert-danger';
?>
        <br>
        <div class="alert <?php echo $alertClass; ?>" role="alert">
            <?php echo $mensaje; ?>
        </div>
<?php
    }
}
?>