<?php
if(!isset($_SESSION)) {
    session_start();
}

$auth = $_SESSION['login'] ?? false;

if(!isset($inicio)){
    $inicio = false;
}
?>

<!doctype html>
<html lang="es">

<head>

    <title>Sistema de Documentación Amado</title>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <!-- Scripts de data tables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.0/css/dataTables.dataTables.css" />
    <script src="https://cdn.datatables.net/2.1.0/js/dataTables.js"></script>
    <!-- Scripts de data sweetalert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.31/dist/sweetalert2.min.css">

    <script src="https://unpkg.com/xlsx@0.16.9/dist/xlsx.full.min.js"></script>
    <script src="https://unpkg.com/file-saverjs@latest/FileSaver.min.js"></script>
    <script src="https://unpkg.com/tableexport@latest/dist/js/tableexport.min.js"></script>
</head>

<body> 
    <header>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <div class="nav navbar-nav">

            <a class="nav-item nav-link" href="../secciones/index.php" aria-current="page">Home</a>
            <a class="nav-item nav-link" href="/unidades">Unidades</a>
            <a class="nav-item nav-link" href="/cajas">Cajas</a>
            <a class="nav-item nav-link" href="<?php $url_base; ?> ../secciones/vista_polizas.php">Pólizas de seguros</a>
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
            <a class="nav-item nav-link" href="<?php $url_base; ?> ../usuarios/index.php">Usuarios</a>
            <a class="nav-item nav-link" href="../secciones/cerrar.php">Cerrar sesión</a>
            
        </div>
    </nav>
    </header>
    <?php echo $contenido; ?>
    <footer>
    <div class="container">
        <!-- Bootstrap JavaScript Libraries -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
        </script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
        </script>
    </footer>
    <?php 
        echo $script ?? '';
    ?>
</body>
</html>
    
     
