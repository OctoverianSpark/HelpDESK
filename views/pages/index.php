<main class="mainCards">
    
    <h1 class="title">Bienvenido / a</h1>
    <div id="slider">
        <div id="contenedor">
            <div class="tarjeta">
                <?php foreach($novedades as $novedad){ ?>
                    <div class="content">
                        <picture>
                            <source srcset="build/img/novelties.webp" type="image/webp">
                            <img src="build/img/novelties.jpg" alt="">
                        </picture>
                        <h2><?php echo $novedad->titulo ?></h2>
                        <p><?php echo $novedad->contenido ?></p>
                    </div>
                <?php } ?>
            </div>
            <div class="tarjeta">
                <?php foreach($recomendaciones as $recomendacion){ ?>
                    <div class="content">
                        <picture>
                            <source srcset="build/img/recomendations.webp" type="image/webp">
                            <img src="build/img/recomendations.jpg" alt="">
                        </picture>
                        <h2><?php echo $recomendacion->titulo ?></h2>
                        <p><?php echo $recomendacion->contenido ?></p>
                    </div>
                <?php } ?>
            </div>
            <div class="tarjeta">
                <div class="content content-ticket">
                    <?php if(!empty($tickets)){ ?>
                        <h2>Ultimo Ticket</h2>
                        <h3>Fecha: <span><?php echo $tickets->fecha ?></span></h3>
                        <h3>Categoria: <span><?php echo $tickets->categoria ?></span></h3>
                        <h3>Asunto: <span><?php echo $tickets->subcategoria ?></span></h3>
                        <a href="/ticket?id=<?php echo $tickets->id ?>" class="boton-morado-inline">Ir al Ticket</a>
                    <?php }else{ ?>
                        <picture>
                            <source srcset="build/img/sorryButNot.webp" type="image/webp">
                            <img src="build/img/sorryButNot.jpg" alt="">
                        </picture>
                        <h2>No has generado tickets por el momento</h2>
                    <?php } ?>
                </div>
                <div class="content content-ticket">
                    <?php if(!empty($encuestas)){ ?>
                        <h2>Encuestas</h2>
                        <h3>Fecha limite para contestar:<span><?php echo $encuestas->vencimiento ?></span></h3>
                        <h3>ID del Ticket: <span><?php echo $encuestas->ticket_id ?></span></h3>
                        <a href="/encuesta?id=<?php echo $encuestas->ticket_id ?>" class="boton-morado-inline">Ir a la Encuesta</a>
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
    </div>
</main>