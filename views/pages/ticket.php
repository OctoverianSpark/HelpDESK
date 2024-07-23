<main class="contenedor-ticket">
        
    <?php if (!is_null($tickets)) : ?>
                    <h1 class="title"><?php echo s($tickets->subcategoria) ?></h1>
                    <div class="destacada">
                        <img src="/referencias/<?php echo $tickets->imagen ?>" width="200" alt="Sin">
                    </div>
                    <div class="container">
                        <div class="container-info">
                            <p>Descripcion:<?php echo "\n".s($tickets->descripcion) ?></p>
                            <p>Categoria: <?php echo s($tickets->categoria) ?></p>
                        </div>
                        <div class="container-tecnical">
                            <p>Estado de Ticket: <?php echo s(ucfirst($tickets->estado)) ?></p>
                            <p>Tecnico asignado: <?php echo s($tickets->tecnico) ?></p>
                        </div>
                        

                        <?php if($comments){ ?>
                                <div class="comments">
                                    <?php foreach($comments as $comment){ ?>
                                        <div class="comment">
                                            <span><?php echo $comment->cargado_por ?></span>
                                            <blockquote><?php echo $comment->comentario ?></blockquote>
                                            <span>Creado el: <?php echo $comment->fecha ?></span>
                                        </div>
                                    <?php } ?>
                                </div>
                        <?php } ?>

                        <?php if($tickets->estado=="completado"){ ?>
                            <div class="encuesta-cont">
                                <h2>Tu ticket fue completado, el siguiente link te llevará a la encuesta de satisfaccion</h2>
                                <a href="/encuesta?id=<?php echo $tickets->id ?>" class="boton-morado-inline">Encuesta de Satisfaccion</a>
                            </div>
                        <?php } ?>


                    </div>











                <?php else:?>

                    <h1>Ticket Inexistente</h1>
                    <picture>
                        <source srcset="build/img/sorryButNot.webp" type="image/webp">
                        <img src="build/img/sorryButNot.png" alt="Error">
                    </picture>
        <?php endif?>


</main>