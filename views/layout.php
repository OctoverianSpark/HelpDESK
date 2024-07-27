<?php 

    use Models\Notificaciones;

    if (!isset($_SESSION)) {
        session_start();
        
    }
    $auth = estaLogueado();

    $admin = admin();
    if($admin){
        $_SESSION["admin"] == $admin;
    }

    $url = $_SERVER["REQUEST_URI"];

    if($admin){

        $notificacion = Notificaciones::getUnshowed("user");
        
        
    }else{
        $notificacion = Notificaciones::getUnshowed($_SESSION["name"]);

    }

    $notificaciones = new Notificaciones($notificacion->id);

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HelpDesk</title>
    <link rel="stylesheet" href="/build/css/app.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <?php if(!empty($notificacion)): ?>
        <input type="hidden" id="not-id" value="<?php echo $notificacion->id ?>">
        <input type="hidden" id="not-titulo" value="<?php echo $notificacion->titulo ?>">
        <input type="hidden" id="not-content" value="<?php echo $notificacion->contenido ?>">
    <?php endif ?>
    <header class="header">
        <div class="barra">
            <?php if($auth){ ?>
                <a href="/" class= "logo">
                    <h1 class= "logo-title">HELP<span>DESK</span></h1>
                </a>
                <nav class="navegacion">
                    <ul class="nav_links">
                        <?php if($admin): ?>
                            <a href="/admin" class="nav_link">Administrador</a>
                        <?php endif?>
                        <?php if(str_contains($url,"/admin")){?>
                            
                            <a href="/admin/inventario" class="nav_link">Inventario</a>
                            <a href="/admin/tickets" class="nav_link">Tickets</a>
                            <a href="/admin/encuestas" class="nav_link">Encuestas</a>
                            <a href="/admin/entradas" class="nav_link">Entradas</a>
                            <a href="/logout" class="nav_link">Cerrar Sesion</a>
                        <?php }else{  ?>
                            <a href="/tickets/crear" class="nav_link">Crear un Ticket</a>
                            <a href="/tickets/ver" class="nav_link">Ver Mis Tickets</a>
                            <a href="/equipos" class="nav_link">Activos Asociados a Mi</a>
                            <a href="/logout" class="nav_link">Cerrar Sesion</a>
                        <?php } ?>
                    </ul>
                </nav>
            <?php }else{?>
                <h1 class= "logo-title">HELP<span>DESK</span></h1>
            <?php }?>
        </div>
    </header>


    
    <?php echo $contenido;?>
    <footer class="footer">
        <a href="/" class= "logo">
            <h1 class= "logo-title">HELP<span>DESK</span></h1>
        </a>
        <p>ASISTENTE VIRTUAL S.A.S &copy;</p>
    </footer>

    <script src="/build/js/bundle.min.js"></script>
</body>

</html>




<?php 
    if(!empty($notificacion)){
        $notificaciones->setShowed($notificacion->id);
    }

 
?>