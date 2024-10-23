<?php 

    use Models\Notificaciones;

    if (!isset($_SESSION)) {
        session_start();
        
    }
    $auth = estaLogueado();

    $admin = admin();
    getCharge();

    $url = $_SERVER["REQUEST_URI"];
    
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HelpDesk</title>
    <link rel="stylesheet" href="/build/css/app.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body class="mainBody">
    <?php if($_SERVER["PATH_INFO"] != "/orden/print"){ ?>
        <header class="header">
            <div class="barra">
                <?php if($auth){ ?>
                    <a href="/" class= "logo">
                        <h1 class= "logo-title">HELP<span>DESK</span></h1>
                    </a>
                    <nav class="navegacion">
                        <ul class="nav_links">
                            <?php if($admin){ ?>
                                <div class="container-nav-link">
                                    <a href="/admin" class="nav_link">Administrador</a>
                                    <?php include "../includes/templates/drop-admin.php" ?>

                                </div>

                            <?php } ?>


                            <?php if($_SESSION["charge"] == "Coordinacion"){ ?>
                                <a href="/admin/inventario/ordenes" class="nav_link">Ordenes</a>

                            <?php }?>


                            <?php if(str_contains($url,"/admin")){?>
                                

                                <div class="container-nav-link">
                                    
                                    <a href="/admin/inventario" class="nav_link">Inventario</a>
                                    
                                </div>
                                <div class="container-nav-link">
                                    
                                    <a href="/admin/tickets" class="nav_link">Tickets</a>
                                    
                                </div>
                                <div class="container-nav-link">
                                    
                                    <a href="/admin/encuestas" class="nav_link">Encuestas</a>
                                    
                                </div>
                                <div class="container-nav-link">
                                    
                                    <a href="/admin/entradas" class="nav_link">Entradas</a>
                                    
                                </div>
                                <div class="container-nav-link">
                                    
                                    <a href="/logout" class="nav_link">Cerrar Sesion</a>
                                    
                                </div>
                            <?php }else{  ?>
                                <a href="/tickets/crear" class="nav_link">Crear un Ticket</a>
                                <a href="/tickets/ver" class="nav_link">Ver Mis Tickets</a>
                                <a href="/equipos" class="nav_link">Activos Asociados a Mi</a>
                                <a href="/logout" class="nav_link">Cerrar Sesion</a>
                                <?php } ?>
                            </ul>
                        </nav>

                        <div class="boton-notificaciones">
                            <button><i id="bell" class="bx bxs-bell"></i><i id="quantity"class="bi"></i></button>   
                        </div>
                <?php }else{?>
                    <h1 class= "logo-title">HELP<span>DESK</span></h1>
                <?php }?>
            </div>


            <?php ?>


        </header>
    <?php } ?>
        
    <?php include "../includes/templates/notifications.php" ?>
    
    <?php echo $contenido;?>
    <?php if($_SERVER["PATH_INFO"] != "/orden/print"){ ?>
        <footer class="footer">
            <a href="/" class= "logo">
                <h1 class= "logo-title">HELP<span>DESK</span></h1>
            </a>
            <p>ASISTENTE VIRTUAL S.A.S &copy;</p>
        </footer>
    <?php } ?>

    <script src="/build/js/bundle.min.js"></script>
</body>

</html>


