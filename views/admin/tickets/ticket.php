<main class="gestor-container">

    


    <h1 class="title">Gestion detallada del ticket <?php echo $tickets->id ?></h1>
    <div class="container-info-ticket">
        <h2>Informacion del Ticket</h2>
        <h3>ID: <?php echo $tickets->id ?></h3>
        <h3>Usuario: <?php echo $tickets->usuario ?></h3>
        <h3>Categoria: <?php echo $tickets->categoria ?></h3>
        <h3>Solicitud: <?php echo $tickets->subcategoria ?></h3>
        <h3>Descripcion: <?php echo $tickets->descripcion ?></h3>
        <h3 id="copyText">Numero de Anydesk: <button title="Click para copiar al portapapeles" class="clipboard-button"><?php echo $tickets->anydesk ?></button></h3>
        <h3>Prioridad: <?php echo ucwords($tickets->prioridad??"Sin Establecer") ?></h3>



    </div>


    <div class="container-state-asign">

        <form method="post" id="stateAsign">

            <fieldset>
                <legend>Estado y Asignación</legend>
                <input type="hidden" name="tickets[id]" value="<?php echo $tickets->id ?>">
                <div class="container-state-input">
                    <label for="estado">Estado</label>
                    <select name="tickets[estado]" id="estado">
                        <option value="sin asignar" <?php echo ($tickets->estado == "sin asignar") ? "selected" : "" ?>>Sin Asignar</option>
                        <option value="en proceso" <?php echo ($tickets->estado == "en proceso") ? "selected" : "" ?>>En Proceso</option>
                        <option value="pendiente" <?php echo ($tickets->estado == "pendiente") ? "selected" : "" ?>>Pendiente</option>
                        <?php if($tickets->estado != "sin asignar"){ ?>
                            <option value="completado" <?php echo ($tickets->estado == "completado") ? "selected" : "" ?>>Completado</option>
                        <?php } ?>
                    </select>
                </div>

                
                <label for="subcategoria">Solicitud</label>
                <select name="tickets[subcategoria]" id="subcategoria">
                        <?php foreach($subcats as $subcat){ ?>
                            <option value="<?php echo s($subcat->subcategoria) ?>"><?php echo s($subcat->subcategoria)?></option>
                        <?php } ?>
                </select>
                <?php if($tickets->categoria === "Aplicaciones"){ ?>
                                <select name="tickets[selected_app]" id="apps">
                                    <?php foreach($apps as $app):?>
                                        <option value="<?php echo $app->app ?>"><?php echo $app->app ?></option>
                                    <?php endforeach ?>
                                </select>
                <?php } ?>
                                    
                <div class="container-state-input hidden" id="otro-container" style="display: none;">
                    <label for="otro"></label>
                    <input id="otro" type="text" placeholder="">

                </div>
                <div class="container-state-input">
                    <label for="tecnico">Tecnico</label>
                    <select name="tickets[tecnico_id]" id="tecnico">
                        <?php foreach($tecnicos as $tecnico){ ?>
                            <option value="<?php echo $tecnico->id ?>" <?php echo ($tickets->tecnico_id === $tecnico->id)? "selected" : "" ?>><?php echo $tecnico->nombre . " " . $tecnico->apellido ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="container-state-input">
                    <label for="prioridad">Prioridad</label>
                    <select name="tickets[prioridad]" id="prioridad">
                        <option value="baja" <?php echo ( $tickets->prioridad == "baja" ) ? "selected" : "" ?>>Baja</option>
                        <option value="media" <?php echo ( $tickets->prioridad == "media" ) ? "selected" : "" ?>>Media</option>
                        <option value="alta" <?php echo ( $tickets->prioridad == "alta" ) ? "selected" : "" ?>>Alta</option>
                    </select>
                </div>

                <input type="submit" value="Actualizar" class="boton-morado-block">
            </fieldset>

        </form>

    </div>



    <div class="container-comments-history">

        




        
        <form method="post" id="comments-history">
            <fieldset>
                <legend>Historial de Comentarios</legend>
                            
                <div class="comments">
                    <?php foreach($comentarios as $comentario){ ?>
                        <div class="comment">
                            <span><?php echo $comentario->cargado_por ?></span>
                            <blockquote><?php echo $comentario->comentario ?></blockquote>
                            <span>Creado el: <?php echo $comentario->fecha ?></span>
                        </div>
                    <?php } ?>
                </div>
                <div class="container-textchat">
                    <input type="hidden" name="comentarios[ticket_id]" value="<?php echo $tickets->id ?>">
                    <input type="text" name="comentarios[comentario]">
                    <button type="submit"><i class='bx bxs-send'></i></button>
                </div>
            </fieldset>



        </form>

                


    </div>



</main>