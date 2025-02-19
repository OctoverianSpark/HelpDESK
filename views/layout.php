<?php


if (!isset($_SESSION)) {
    session_start();
}
$auth = estaLogueado();



$url = $_SERVER["REQUEST_URI"];

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HelpDesk</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Imperial+Script&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" href="/build/css/app.css">


    <script defer type="module" src="/build/js/bundle.min.js"></script>

</head>

<body class="mainBody">
    <?php if ($_SERVER["PATH_INFO"] != "/order/see") { ?>
        <header class="header">
            <?php if ($auth) { ?>
                <div class="barra">
                    <a href="/" class="logo">
                        <h1 class="logo-title">HELP<span>DESK</span></h1>
                    </a>
                    <nav class="navegacion">
                        <ul class="nav_links">
                            <?php if ($_SESSION["role"] == "ADMIN") { ?>


                                <div class="container-nav-link">
                                    <button class="nav_link">Administrador</button>


                                    <?php include "../includes/templates/drop/admin/admin.php" ?>
                                </div>

                            <?php } ?>




                            <?php if (str_contains($url, "/admin")) { ?>



                                <div class="container-nav-link">

                                    <button class="nav_link">Inventario</button>

                                    <?php include "../includes/templates/drop/admin/inventory.php" ?>

                                </div>
                                <div class="container-nav-link">

                                    <button class="nav_link">Tickets</button>


                                    <?php include "../includes/templates/drop/admin/tickets.php" ?>


                                </div>
                                <div class="container-nav-link">

                                    <a href="/admin/entradas" class="nav_link">Entradas</a>


                                </div>
                                <div class="container-nav-link">

                                    <a href="/logout" class="nav_link">Cerrar Sesion</a>

                                </div>


                            <?php } else {  ?>
                                <div class="container-nav-link">
                                    <a href="/tickets/crear" class="nav_link">Crear un Ticket</a>

                                </div>
                                <div class="container-nav-link">
                                    <button class="nav_link">Sobre mi</button>

                                    <?php include "../includes/templates/drop/user/about-me.php" ?>
                                </div>
                                <?php if ($_SESSION["role"] == "MNGR" || $_SESSION["role"] == "ADMIN") { ?>
                                    <div class="container-nav-link">

                                        <a href="/ordenes/crear" class="nav_link">SOLICITAR ORDENES</a>

                                    </div>
                                <?php } ?>
                                <div class="container-nav-link">
                                    <a href="/logout" class="nav_link">Cerrar Sesion</a>

                                </div>
                            <?php } ?>


                        </ul>
                    </nav>

                    <div class="boton-notificaciones">
                        <button class="btn btn-nots"><i id="bell" class="bx bxs-bell"></i><i id="quantity" class="bi"></i></button>
                        <?php include "../includes/templates/notifications.php" ?>
                    </div>
                </div>

            <?php } ?>




        </header>
    <?php } ?>


    <?php echo $contenido; ?>

    <?php if ($_SERVER["PATH_INFO"] != "/order/see" && $auth) { ?>
        <footer class="footer">
            <a href="/" class="logo">
                <h1 class="logo-title">HELP<span>DESK</span></h1>
            </a>
            <p>ASISTENTE VIRTUAL S.A.S &copy;</p>
        </footer>
    <?php } ?>
</body>

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>

</html>