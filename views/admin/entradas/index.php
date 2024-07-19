<main class="contenedor-entradas">




    <div class="container-links">
        <a href="/admin/entradas/crear?type=novedad" class="boton-morado-titles">Añadir Novedad</a>
        <a href="/admin/entradas/crear?type=recomendacion" class="boton-morado-titles">Añadir Recomendacion</a>
    </div>



        <section class="entradas">
            <?php foreach($entradas as $entrada){ ?>
                <article class="entrada">
                    <div class="entrada-imagen">
                        <picture>
                            <source srcset="/blog/<?php echo s($entrada->imagen).".webp" ?>" type="image/webp">
                            <img src="/blog/<?php echo s($entrada->imagen).".png" ?>" type="image/png">
                        </picture>
                    </div>
                    <div class="texto-entrada">
                        <h4><?php echo $entrada->titulo ?></h4>
                        <p class="type"><?php echo ucwords($entrada->tipo) ?></p>
                        <p class="metadata">Creado el: <span><?php echo $entrada->fecha ?></span> por <span><?php echo s($entrada->cargado_por) ?></span></p>
                        
                        <p><?php echo $entrada->contenido ?></p>
                        <div class="container-mostrar">
                            <form class="show-form"  id="showForm" method="post">
                                <input type="hidden" name="entrada[id]" value="<?php echo s($entrada->id) ?>">
                                <input type="checkbox" name="entrada[mostrar]" id="type" <?php echo s(($entrada->mostrar === "si")? "checked":"") ?>>
                                <label >Mostrar Entrada?</label>
                            </form>
                        </div>
                        <p class="text-actions">Acciones</p>
                        <div class="actions">
                            <form method="post">
                                <input type="hidden" name="entradas[id]" value="<?php echo s($entrada->id) ?>">
                                <input type="submit" value="Eliminar" class="boton-rojo-inline">
                            </form>
                            <a href="/admin/entradas/actualizar?id=<?php echo $entrada->id?>" class="boton-morado-inline">Actualizar</a>
                        </div>
                    </div>
                        
                </article>
                
                
                <?php $count++ ?>
                <?php } ?>
            </section>







</main>