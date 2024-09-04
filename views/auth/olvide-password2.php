<div class="login">
    <div class="login__header">
        <header class="login__header--titulo">Ovidé mi contraseña</header>
        <p class="login__header--texto">Ingresa tu correo con el que estas registrado, para restablecer tu contraseña</p>

    </div>
    <?php  
        include __DIR__ . "/../templates/alertas.php";
    ?>
    <form action="/olvide" method="POST" class="login__formulario">
        <div class="login__campo">
            <input type="text" class="login__campo--input" name="email" placeholder="Escribe tu Email">
        </div>
        <div class="login__olvide">
            <a href="/" class="login__olvide--enlace">¿Ya tienes tu cuenta? Inicia Sesión</a>
        </div>
        <div class="login__submit">
            <input type="submit" class="login__submit--boton" id="submit" value="Enviar Instrucciones">
        </div>
        
    </form>
</div>