<?php 
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
?>

<aside class="dashboard__sidebar">
    <nav class="dashboard__menu">
        <a href="/principal" class="dashboard__enlace <?php echo pagina_actual('/principal') ? 'dashboard__enlace--actual' : ''; ?>">
            <i class="fa-solid fa-house dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                Inicio
            </span>
        </a>
        
        <?php if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2): // Administrador y Usuario ?>
            <a href="/unidades" class="dashboard__enlace <?php echo pagina_actual('/unidades') ? 'dashboard__enlace--actual' : ''; ?>">
                <i class="fa-solid fa-truck-front dashboard__icono"></i>
                <span class="dashboard__menu-texto">
                    Unidades
                </span>
            </a>
            <a href="/cajas" class="dashboard__enlace <?php echo pagina_actual('/cajas') ? 'dashboard__enlace--actual' : ''; ?>">
                <i class="fa-solid fa-trailer dashboard__icono"></i>
                <span class="dashboard__menu-texto">
                    Cajas
                </span>
            </a>
            <a href="/polizas" class="dashboard__enlace <?php echo pagina_actual('/polizas') ? 'dashboard__enlace--actual' : ''; ?>">
                <i class="fa-solid fa-file-shield dashboard__icono"></i>
                <span class="dashboard__menu-texto">
                    Pólizas de seguros
                </span>
            </a>
            <a href="/verif-ambiental" class="dashboard__enlace <?php echo pagina_actual('/verif-ambiental') ? 'dashboard__enlace--actual' : ''; ?>">
                <i class="fa-solid fa-leaf dashboard__icono"></i>
                <span class="dashboard__menu-texto">
                    Verficiaciones Ambientales
                </span>
            </a>
            <a href="/verif-fisico" class="dashboard__enlace <?php echo pagina_actual('/verif-fisico') ? 'dashboard__enlace--actual' : ''; ?>">
                <i class="fa-solid fa-toolbox dashboard__icono"></i>
                <span class="dashboard__menu-texto">
                    Verificaciones Fisíco-Mecánicas
                </span>
            </a>
            <a href="/tarjetas-circulacion" class="dashboard__enlace <?php echo pagina_actual('/tarjetas-circulacion') ? 'dashboard__enlace--actual' : ''; ?>">
                <i class="fa-solid fa-file-invoice dashboard__icono"></i>
                <span class="dashboard__menu-texto">
                    Tarjetas de Circulación
                </span>
            </a>
            <a href="/acuses" class="dashboard__enlace <?php echo pagina_actual('/acuses') ? 'dashboard__enlace--actual' : ''; ?>">
                <i class="fa-solid fa-file-signature dashboard__icono"></i>
                <span class="dashboard__menu-texto">
                    Acuses
                </span>
            </a>
        <?php endif; ?>

        <?php if ($_SESSION['rol'] == 1): // Solo Administrador ?>
            <a href="/gps" class="dashboard__enlace <?php echo pagina_actual('/gps') ? 'dashboard__enlace--actual' : ''; ?>">
                <i class="fa-solid fa-location-dot dashboard__icono"></i>
                <span class="dashboard__menu-texto">
                    GPS
                </span>
            </a>
        <?php endif; ?>

        <?php if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2 || $_SESSION['rol'] == 3): // Administrador y Recursos Humanos ?>
            <a href="/operadores" class="dashboard__enlace <?php echo pagina_actual('/operadores') ? 'dashboard__enlace--actual' : ''; ?>">
                <i class="fa-regular fa-id-card dashboard__icono"></i>
                <span class="dashboard__menu-texto">
                    Operadores
                </span>
            </a>
        <?php endif; ?>

        <?php if ($_SESSION['rol'] == 1): // Solo Administrador ?>
            <a href="/usuarios" class="dashboard__enlace <?php echo pagina_actual('/usuarios') ? 'dashboard__enlace--actual' : ''; ?>">
                <i class="fa-solid fa-users dashboard__icono"></i>
                <span class="dashboard__menu-texto">
                    Usuarios
                </span>
            </a>
        <?php endif; ?>
    </nav>
</aside>
