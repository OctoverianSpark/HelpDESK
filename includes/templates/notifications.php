<?php

    use Models\Notificaciones;
use Models\Tecnicos;

    $tecnico = Tecnicos::searchByName($_SESSION["name"]);


    if($tecnico){

        $notificaciones = Notificaciones::getAdmins($_SESSION["name"]);
    }else{
        
        $notificaciones = Notificaciones::getAll($_SESSION["name"]);
    }




?>


<div class="drop-notificaciones" style="display: none;">

    <?php foreach($notificaciones as $notificacion){ ?>
        <div class="notification">
            <a href="<?php echo $notificacion->url ?>">
                <i id="notification-icon" class="bi bi-ticket-fill"></i>
                <div class="container-content">
                    <h4 class="prompt-title"><?php echo $notificacion->titulo ?></h4>
                    <span class="prompt-text"><?php echo $notificacion->contenido ?></span>

                </div>
            </a>
        </div>
    <?php }?>


</div>


