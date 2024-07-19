
<body>
    <h1>Bienvenido/a</h1>



    <div class="container">
        <div class="contenedor info-index">

            <div class="blue-card novelties">
                <?php if(!empty($novedad)){ ?>
                    <h2>Novedades</h2>
                    <picture>
                        <source srcset="blog/<?php echo $novedad->imagen?>.webp" type="image/webp">
                        <img src="blog/<?php echo $novedad->imagen?>.png" alt="">
                    </picture>
                    <h3><?php echo $novedad->titulo ?></h3>
                    <p><?php echo $novedad->contenido ?></p>
                <?php }else { ?>
                    <picture>
                        <source srcset="build/img/sorryButNot.webp" type="image/webp">
                        <img src="build/img/sorryButNot.png" alt="">
                    </picture>
                    <h2>Sin Informacion por los momentos</h2>
                <?php } ?>
            </div>


            <div class="blue-card recomendations">
                <?php if(!empty($recomendacion)){ ?>
                    <h2>Recomendaciones</h2>
                    <picture>
                        <source srcset="blog/<?php echo $recomendacion->imagen?>.webp" type="image/webp">
                        <img src="blog/<?php echo $recomendacion->imagen?>.png" alt="">
                    </picture>
                    <h3><?php echo $recomendacion->titulo ?></h3>
                    <p><?php echo $recomendacion->contenido ?></p>
                <?php }else { ?>
                    <picture>
                        <source srcset="build/img/sorryButNot.webp" type="image/webp">
                        <img src="build/img/sorryButNot.png" alt="">
                    </picture>
                    <h2>Sin Informacion por los momentos</h2>
                <?php } ?>
            </div>
        </div>
        


        <div class="container-tik-sat">

                <div class="blue-card tickets">
                    
                    <h2>Ultimo Caso</h2>

                    <?php foreach ($tickets as $ticket):?>
                        <p class="tickets-info">Fecha: <?php echo $ticket->fecha ?></p>
                        <p class="tickets-info">Categoria: <?php echo $ticket->categoria ?></p>
                        <p class="tickets-info">Asunto: <?php echo $ticket->subcategoria ?></p>
                        <p class="tickets-info">Descripcion: <?php echo $ticket->descripcion ?></p>
                        <p class="tickets-info">Asignado a: <?php echo $ticket->tecnico ?></p>
                        <p class="tickets-info">Estado: <?php echo $ticket->estado ?></p>
                        <a class="boton-morado-block" href="ticket?id=<?php echo $ticket->id?>">Ir al Ticket</a>

                    <?php endforeach ?>


                </div>
                <div class="blue-card encuestas">
                    
                    <h2>Encuestas</h2>

                    <?php foreach ($encuestas as $encuesta):?>
                        <p class="tickets-info">Fecha: <?php echo $encuesta->creado ?></p>
                        <p class="tickets-info">ID de Ticket: <?php echo $encuesta->ticket_id ?></p>
                        <a class="boton-morado-block" href="/encuesta?id=<?php echo $encuesta->id ?>">Ir a Encuesta</a>
                    <?php endforeach ?>
                </div>
                



        </div>
    </div>
        



</body>