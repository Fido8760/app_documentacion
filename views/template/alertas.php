<?php
foreach($alertas as $key => $mensajes) {
    foreach($mensajes as $mensaje) {
?>
<div class="alert alert-danger" role="alert">
<?php echo $mensaje; ?>
</div>
    
<?php
    }
}
?>