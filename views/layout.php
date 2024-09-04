
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Documentación<?php echo !empty($titulo) ? ' | ' . $titulo : ''; ?></title>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    <!-- FontAwesome para iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"
        integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.31/dist/sweetalert2.min.css">

    <!-- Estilos personalizados -->
    <link rel="stylesheet" type="text/css" href="build/css/app.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Scripts para exportar a Excel -->
    <script src="https://unpkg.com/xlsx@0.16.9/dist/xlsx.full.min.js"></script>
    <script src="https://unpkg.com/file-saverjs@latest/FileSaver.min.js"></script>
    <script src="https://unpkg.com/tableexport@latest/dist/js/tableexport.min.js"></script>
</head>
<body class="dashboard">
    <?php
    // Mostrar el header solo si mostrarLayout es verdadero
    if (isset($mostrarLayout) && $mostrarLayout) {
        include_once __DIR__ . '/templates/header.php';
    }
    ?>

    <div class="dashboard__grid">
        <?php
        // Mostrar el sidebar solo si mostrarLayout es verdadero
        if (isset($mostrarLayout) && $mostrarLayout) {
            include_once __DIR__ . '/templates/sidebar.php';
        }
        ?>

        <main class="dashboard__contenido">
            <?php
            echo $contenido;
            ?>
        </main>
    </div>

    <footer>
        <!-- Contenido del footer -->
        <?php echo $script ?? ''; ?>
        <!-- Tu archivo JS -->
        <script src="/build/js/app.js"></script>
    </footer>
</body>

</html>