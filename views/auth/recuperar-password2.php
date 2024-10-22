<div class="login">
    <div class="login__header">
        <header class="login__header--titulo">Reestablecer contraseña</header>
        <p class="login__header--texto">Coloca tu nuevo password a continuación, ingresa un password de al menos 6 carácteres, para acceder a tu panel</p>

    </div>
    <?php  
        include __DIR__ . "/../templates/alertas.php";
    ?>

    <?php if($token_valido) { ?>
    <form  method="POST" class="login__formulario">
        <div class="login__campo">
            <input type="password" class="login__campo--input" name="password" placeholder="Escribe tu nuevo Password">
        </div>
        <div class="login__olvide">
            <a href="/" class="login__olvide--enlace">¿Ya tienes tu cuenta? Inicia Sesión</a>
        </div>
        <div class="login__submit">
            <input type="submit" class="login__submit--boton" id="submit" value="Cambiar password">
        </div>
        
    </form>

    <?php } ?>
</div>