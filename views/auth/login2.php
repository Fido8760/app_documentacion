<div class="login">
    <div class="login__header">
        <header class="login__header--titulo">Sistema de Documentación Amado</header>
        <p class="login__header--texto">Ingresa con tu correo y contraseña, para acceder al panel</p>

    </div>
    <?php  
        include __DIR__ . "/../templates/alertas.php";
    ?>
    <form action="/" method="POST" class="login__formulario">
        <div class="login__campo">
            <input type="text" class="login__campo--input" name="email" placeholder="Escribe tu Email">
        </div>
        <div class="login__campo">
            <input type="password" class="login__campo--input" name="password" placeholder="Escribe tu Password">
        </div>
        <div class="login__olvide">
            <a href="/olvide" class="login__olvide--enlace">¿Olvidaste tu contraseña? Recuperala aquí</a>
        </div>
        <div class="login__submit">
            <input type="submit" class="login__submit--boton" id="submit" value="Acceder">
        </div>
        
    </form>
</div>