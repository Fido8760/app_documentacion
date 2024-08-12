<header>
    <?php if (isset($showNavbar) && $showNavbar): ?>
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
            <div class="nav navbar-nav">

                <a class="nav-item nav-link" href="/principal" aria-current="page">Home</a>
                <a class="nav-item nav-link" href="/unidades">Unidades</a>
                <a class="nav-item nav-link" href="/cajas">Cajas</a>
                <a class="nav-item nav-link" href="/polizas">Pólizas de seguros</a>
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Verificaciones</a>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="<?php $url_base; ?> ../veri_ambiental/index.php">Verficiaciones Ambientales</a></li>
                        <li><a class="dropdown-item" href="<?php $url_base; ?> ../veri_fisico/index.php">Verificaciones Fisíco-Mecánicas</a></li>
                    </ul>
                </li>
                <a class="nav-item nav-link" href="<?php $url_base; ?> ../tarj_circ/index.php">Tarjetas de Circulación</a>
                <a class="nav-item nav-link" href="<?php $url_base; ?> ../acuse/index.php">Acuses</a>
                <a class="nav-item nav-link" href="<?php $url_base; ?> ../gps/index.php">GPS</a>
                <a class="nav-item nav-link" href="<?php $url_base; ?> ../operadores/index.php">Operadores</a>
                <a class="nav-item nav-link" href="<?php $url_base; ?> ../puestos/index.php">Puestos</a>
                <a class="nav-item nav-link" href="/auth/usuarios">Usuarios</a>
                <a class="nav-item nav-link" href="/logout">Cerrar sesión</a>           
            </div>
        </nav>
    </header>
    
    <?php  endif; ?>