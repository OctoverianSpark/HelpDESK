<main class="mainCards">
    
    <h1 class="title">Hola <?php echo ucfirst($_SESSION["name"]) ?></h1>

    <div class="card-container">

        <div class="card">
            <div class="banner-image banner-novelties">
                    <img srcset="build/img/novelties.jpg" alt="" type="image/jpg">
                    <h2>Novedades</h2>
            </div>
            <?php foreach($novedades as $novedad){ ?>

                <div class="content">
                    <h2><?php echo $novedad->titulo ?></h2>
                    <p><?php echo $novedad->contenido ?></p>
                </div>

            <?php } ?>
        </div>
        <div class="card">
            <div class="banner-image banner-recomendations">
                <img src="build/img/recomendations.jpeg" alt="">
                <h2>Recomendaciones</h2>
                    
            </div>
            <?php foreach($recomendaciones as $recomendacion){ ?>

                <div class="content">
                    <h2><?php echo $recomendacion->titulo ?></h2>
                    <p><?php echo $novedad->contenido ?></p>
                </div>

            <?php } ?>
        </div>
        <div class="card">
            <?php if($ticket){ ?>
                <div class="content ticket-content">
                    <h2>Ultimo Caso</h2>

                    <h4>Categoria: <?php echo $ticket->categoria ?></h4>
                    <h4>Tecnico asignado: <?php echo $ticket->tecnico ?></h4>

                    <a href="/ticket?id=<?php echo $ticket->id ?>" class="btn btn-purple">Ver mi ticket</a>
                </div>
            <?php }else{ ?>
                <div class="content">
                    
                        <picture>
                            <source srcset="build/img/sorryButNot.webp" type="image/webp">
                            <img src="build/img/sorryButNot.jpg" alt="">
                        </picture>
                        <h2>No tienes tickets por ahora</h2>
                </div>

            <?php } ?>
        </div>
        <div class="card">
            <div class="content ticket-content">
                    
            <?php if(!empty($encuestas)){ ?>
                        <h2>Encuestas</h2>
                        <h3>Fecha limite para contestar:<span><?php echo $encuestas->vencimiento ?></span></h3>
                        <h3>ID del Ticket: <span><?php echo $encuestas->ticket_id ?></span></h3>
                        <a href="/encuesta?id=<?php echo $encuestas->ticket_id ?>" class="btn btn-purple">Ir a la Encuesta</a>
                    <?php }else{ ?>
                        
                        <picture>
                            <source srcset="build/img/sorryButNot.webp" type="image/webp">
                            <img src="build/img/sorryButNot.jpg" alt="">
                        </picture>
                        <h2>No tienes encuestas pendientes por ahora</h2>
                    <?php } ?>
            </div>
        </div>


    </div>


       
</main>