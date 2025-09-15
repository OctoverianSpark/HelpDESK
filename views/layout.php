<?php

use Models\Log;

if (!isset($_SESSION)) {
    session_start();
}
$auth = estaLogueado();



$url = $_SERVER["REQUEST_URI"];



?>




<!DOCTYPE html>
<html lang="en" data-theme='dark'>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="manifest" href="/manifest.json">
    <link rel="shortcut icon" href="/logo.png" type="image/png">
    <link rel="apple-touch-icon" href="/icons/apple-icon-180.png">

    <meta name="apple-mobile-web-app-capable" content="yes">

    <link rel="apple-touch-startup-image" href="/icons/apple-splash-2048-2732.jpg" media="(device-width: 1024px) and (device-height: 1366px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)">
    <link rel="apple-touch-startup-image" href="/icons/apple-splash-2732-2048.jpg" media="(device-width: 1024px) and (device-height: 1366px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)">
    <link rel="apple-touch-startup-image" href="/icons/apple-splash-1668-2388.jpg" media="(device-width: 834px) and (device-height: 1194px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)">
    <link rel="apple-touch-startup-image" href="/icons/apple-splash-2388-1668.jpg" media="(device-width: 834px) and (device-height: 1194px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)">
    <link rel="apple-touch-startup-image" href="/icons/apple-splash-1536-2048.jpg" media="(device-width: 768px) and (device-height: 1024px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)">
    <link rel="apple-touch-startup-image" href="/icons/apple-splash-2048-1536.jpg" media="(device-width: 768px) and (device-height: 1024px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)">
    <link rel="apple-touch-startup-image" href="/icons/apple-splash-1488-2266.jpg" media="(device-width: 744px) and (device-height: 1133px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)">
    <link rel="apple-touch-startup-image" href="/icons/apple-splash-2266-1488.jpg" media="(device-width: 744px) and (device-height: 1133px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)">
    <link rel="apple-touch-startup-image" href="/icons/apple-splash-1640-2360.jpg" media="(device-width: 820px) and (device-height: 1180px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)">
    <link rel="apple-touch-startup-image" href="/icons/apple-splash-2360-1640.jpg" media="(device-width: 820px) and (device-height: 1180px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)">
    <link rel="apple-touch-startup-image" href="/icons/apple-splash-1668-2224.jpg" media="(device-width: 834px) and (device-height: 1112px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)">
    <link rel="apple-touch-startup-image" href="/icons/apple-splash-2224-1668.jpg" media="(device-width: 834px) and (device-height: 1112px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)">
    <link rel="apple-touch-startup-image" href="/icons/apple-splash-1620-2160.jpg" media="(device-width: 810px) and (device-height: 1080px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)">
    <link rel="apple-touch-startup-image" href="/icons/apple-splash-2160-1620.jpg" media="(device-width: 810px) and (device-height: 1080px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)">
    <link rel="apple-touch-startup-image" href="/icons/apple-splash-1320-2868.jpg" media="(device-width: 440px) and (device-height: 956px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)">
    <link rel="apple-touch-startup-image" href="/icons/apple-splash-2868-1320.jpg" media="(device-width: 440px) and (device-height: 956px) and (-webkit-device-pixel-ratio: 3) and (orientation: landscape)">
    <link rel="apple-touch-startup-image" href="/icons/apple-splash-1206-2622.jpg" media="(device-width: 402px) and (device-height: 874px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)">
    <link rel="apple-touch-startup-image" href="/icons/apple-splash-2622-1206.jpg" media="(device-width: 402px) and (device-height: 874px) and (-webkit-device-pixel-ratio: 3) and (orientation: landscape)">
    <link rel="apple-touch-startup-image" href="/icons/apple-splash-1290-2796.jpg" media="(device-width: 430px) and (device-height: 932px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)">
    <link rel="apple-touch-startup-image" href="/icons/apple-splash-2796-1290.jpg" media="(device-width: 430px) and (device-height: 932px) and (-webkit-device-pixel-ratio: 3) and (orientation: landscape)">
    <link rel="apple-touch-startup-image" href="/icons/apple-splash-1179-2556.jpg" media="(device-width: 393px) and (device-height: 852px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)">
    <link rel="apple-touch-startup-image" href="/icons/apple-splash-2556-1179.jpg" media="(device-width: 393px) and (device-height: 852px) and (-webkit-device-pixel-ratio: 3) and (orientation: landscape)">
    <link rel="apple-touch-startup-image" href="/icons/apple-splash-1284-2778.jpg" media="(device-width: 428px) and (device-height: 926px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)">
    <link rel="apple-touch-startup-image" href="/icons/apple-splash-2778-1284.jpg" media="(device-width: 428px) and (device-height: 926px) and (-webkit-device-pixel-ratio: 3) and (orientation: landscape)">
    <link rel="apple-touch-startup-image" href="/icons/apple-splash-1170-2532.jpg" media="(device-width: 390px) and (device-height: 844px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)">
    <link rel="apple-touch-startup-image" href="/icons/apple-splash-2532-1170.jpg" media="(device-width: 390px) and (device-height: 844px) and (-webkit-device-pixel-ratio: 3) and (orientation: landscape)">
    <link rel="apple-touch-startup-image" href="/icons/apple-splash-1125-2436.jpg" media="(device-width: 375px) and (device-height: 812px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)">
    <link rel="apple-touch-startup-image" href="/icons/apple-splash-2436-1125.jpg" media="(device-width: 375px) and (device-height: 812px) and (-webkit-device-pixel-ratio: 3) and (orientation: landscape)">
    <link rel="apple-touch-startup-image" href="/icons/apple-splash-1242-2688.jpg" media="(device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)">
    <link rel="apple-touch-startup-image" href="/icons/apple-splash-2688-1242.jpg" media="(device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 3) and (orientation: landscape)">
    <link rel="apple-touch-startup-image" href="/icons/apple-splash-828-1792.jpg" media="(device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)">
    <link rel="apple-touch-startup-image" href="/icons/apple-splash-1792-828.jpg" media="(device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)">
    <link rel="apple-touch-startup-image" href="/icons/apple-splash-1242-2208.jpg" media="(device-width: 414px) and (device-height: 736px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)">
    <link rel="apple-touch-startup-image" href="/icons/apple-splash-2208-1242.jpg" media="(device-width: 414px) and (device-height: 736px) and (-webkit-device-pixel-ratio: 3) and (orientation: landscape)">
    <link rel="apple-touch-startup-image" href="/icons/apple-splash-750-1334.jpg" media="(device-width: 375px) and (device-height: 667px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)">
    <link rel="apple-touch-startup-image" href="/icons/apple-splash-1334-750.jpg" media="(device-width: 375px) and (device-height: 667px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)">
    <link rel="apple-touch-startup-image" href="/icons/apple-splash-640-1136.jpg" media="(device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)">
    <link rel="apple-touch-startup-image" href="/icons/apple-splash-1136-640.jpg" media="(device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)">
    <title>HelpDesk</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Imperial+Script&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link rel="stylesheet" href="/build/css/app.css">


    <script defer type="module" src="/build/js/bundle.min.js"></script>

</head>

<body class="mainBody <?php echo $_SERVER['PATH_INFO'] == '/order/see' ? 'doc-order' : '' ?>">

    <?php if (!empty($_SESSION) && $_SERVER['PATH_INFO'] != '/order/see') { ?>

        <aside class="menu-sidebar">
            <a href="/" class="logo sidebar-title">
                HelpDesk
            </a>

            <nav class="nav-menu">

                <?php if ($_SESSION['role'] == 'ADMIN') { ?>

                    <div class="drop-menu">

                        <label for="home" class="drop-btn" title="Administrador">
                            <input type="checkbox" id="home" name="menu">

                            <i class='bi bi-terminal-fill'></i>
                            <span>
                                Administrador
                            </span>
                        </label>
                        <ul class="nav-links">
                            <div>
                                <a href="/admin"><span><i class="bi bi-graph-up"></i>Panel de Administracion</span></a>
                                <a href="/admin/servers"><span><i class="bi bi-pc-display-horizontal"></i>Servidores</span></a>
                                <a href="/admin/users"><span><i class="bi bi-person-fill"></i>Usuarios</span></a>
                                <a href="/admin/logs"><span><i class="bi bi-file-earmark-binary-fill"></i>Logs</span></a>
                                <a href="/admin/export"><span><i class="bi bi-file-earmark-excel-fill"></i>Exportar</span></a>
                            </div>
                        </ul>
                    </div>
                <?php } ?>
                <?php if (str_contains($_SERVER['PATH_INFO'], 'admin')) { ?>
                    <div class="drop-menu">

                        <label for="inventario" class="drop-btn" title="Inventario">
                            <input type="checkbox" id="inventario" name="menu">

                            <i class='bi bi-pc-display'></i>
                            <span>
                                Inventario
                            </span>
                        </label>
                        <ul class="nav-links">
                            <div>
                                <a href="/admin/inventario/dashboard"><span><i class="bi bi-bar-chart-fill"></i>Panel de Inventario</span></a>
                                <a href="/admin/inventario"><span><i class="bi bi-table"></i>Ver Inventario</span></a>
                                <a href="/admin/inventario/crear"><span><i class="bi bi-plus-circle"></i>Añadir Equipo</span></a>
                                <a href="/admin/pers"><span><i class="bi bi-table"></i>Ver Perifericos</span></a>
                                <a href="/admin/pers/create"><span><i class="bi bi-plus-circle"></i>Agregar Perifericos</span></a>
                                <a href="/admin/mantenimientos"><span><i class="bi bi-calendar"></i>Mantenimientos</span></a>
                            </div>
                        </ul>
                    </div>
                    <div class="drop-menu">

                        <label for="tickets" class="drop-btn" title="Tickets">
                            <input type="checkbox" id="tickets" name="menu">

                            <i class='bi bi-ticket-fill'></i>
                            <span>
                                Tickets
                            </span>
                        </label>
                        <ul class="nav-links">
                            <div>
                                <a href="/admin/tickets/dashboard"><span><i class="bi bi-bar-chart-fill"></i>Panel de tickets</span></a>
                                <a href="/admin/tickets"><span><i class="bi bi-table"></i>Ver tickets</span></a>
                                <a href="/admin/tickets/create"><span><i class="bi bi-plus-circle"></i>Crear ticket</span></a>
                            </div>
                        </ul>
                    </div>
                    <div class="drop-menu">

                        <label for="personal" class="drop-btn" title="Personal">
                            <input type="checkbox" id="personal" name="menu">

                            <i class='bi bi-person-rolodex'></i>
                            <span>
                                Personal
                            </span>
                        </label>
                        <ul class="nav-links">
                            <div>
                                <a href="/admin/personal"><span><i class="bi bi-table"></i>Ver Personal</span></a>
                                <a href="/admin/personal/register"><span><i class="bi bi-plus-circle"></i>Registrar Personal</span></a>
                            </div>
                        </ul>
                    </div>
                    <div class="drop-menu">

                        <label for="ordenes" class="drop-btn" title="Ordenes">
                            <input type="checkbox" id="ordenes" name="menu">

                            <i class='bi bi-file-earmark-fill'></i>
                            <span>
                                Ordenes
                            </span>
                        </label>
                        <ul class="nav-links">
                            <div>
                                <a href="/admin/ordenes"><span><i class="bi bi-table"></i>Ver Ordenes</span></a>
                                <a href="/admin/ordenes/crear"><span><i class="bi bi-plus-circle"></i>Generar Orden</span></a>
                            </div>
                        </ul>
                    </div>
                    <div class="drop-menu">
                        <label for="agents" class="drop-btn" for='agents'>
                            <i class="bi bi-person-fill-check"></i>
                            <span>Agentes</span>

                            <input type="checkbox" name="menu" id="agents">
                        </label>

                        <ul class="nav-links">
                            <div>
                                <a href="/admin/agents"><span>
                                        <i class="bi bi-table"></i>
                                        Ver Agentes
                                    </span></a>
                                <a href="/admin/agents/tickets"><span>
                                        <i class="bi bi-table"></i>
                                        Ver Tickets
                                    </span></a>
                                <a href="/admin/agents/tickets/create"><span>
                                        <i class="bi bi-plus-circle"></i>
                                        Crear Ticket
                                    </span></a>
                            </div>
                        </ul>
                    </div>

                <?php } else { ?>
                    <div class="drop-menu">

                        <label for="tickets" class="drop-btn" title="Tickets">
                            <input type="checkbox" id="tickets" name="menu">

                            <i class='bi bi-ticket'></i>
                            <span>
                                Tickets
                            </span>
                        </label>
                        <ul class="nav-links">
                            <div>
                                <a href="/tickets/ver"><span><i class="bi bi-table"></i>Ver mis tickets</span></a>

                                <a href="/tickets/crear"><span><i class="bi bi-plus-circle"></i>Crear ticket</span></a>
                            </div>
                        </ul>
                    </div>
                    <?php if ($_SESSION['role'] == 'MNGR' || $_SESSION['role'] == 'ADMIN') { ?>

                        <div class="drop-menu">

                            <label for="orders" class="drop-btn" title='Ordenes'>
                                <input type="checkbox" id="orders" name="menu">

                                <i class='bi bi-file-earmark'></i>
                                <span>
                                    Ordenes
                                </span>
                            </label>
                            <ul class="nav-links">
                                <div>
                                    <a href="/ordenes/crear"><span><i class="bi bi-file-arrow-up"></i>Solicitar Orden</span></a>

                                </div>
                            </ul>
                        </div>
                    <?php } ?>

                <?php } ?>
                <div class="drop-menu">

                    <label for="options" class="drop-btn" title='Opciones'>
                        <input type="checkbox" id="options" name="menu">

                        <i class='bi bi-gear-fill'></i>
                        <span>
                            Opciones
                        </span>
                    </label>
                    <ul class="nav-links">
                        <div>
                            <a href="/logout"><span><i class="bi bi-door-open"></i>Cerrar Sesion</span></a>
                        </div>
                    </ul>
                </div>
            </nav>


        </aside>
    <?php } ?>

    <main>
        <?php echo $contenido ?>
    </main>

</body>

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>

</html>