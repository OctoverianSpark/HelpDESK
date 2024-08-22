<main class="gestor-container">

    


    <h1 class="title">Gestion detallada del ticket <?php echo $tickets->id ?></h1>
    <div class="container-info-ticket">
        <h2>Informacion del Ticket</h2>
        <h3>ID: <?php echo $tickets->id ?></h3>
        <h3>Usuario: <?php echo $tickets->usuario ?></h3>
        <h3>Categoria: <?php echo $tickets->categoria ?></h3>
        <h3>Solicitud: <?php echo $tickets->subcategoria ?></h3>
        <h3>Descripcion: <?php echo $tickets->descripcion ?></h3>




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
                        <option value="completado" <?php echo ($tickets->estado == "completado") ? "selected" : "" ?>>Completado</option>
                    </select>
                </div>
                <div class="container-state-input">
                    <label for="tecnico">Tecnico</label>
                    <select name="tickets[tecnico_id]" id="tecnico">
                        <?php foreach($tecnicos as $tecnico){ ?>
                            <option value="<?php echo $tecnico->id ?>" <?php echo ($tickets->tecnico_id === $tecnico->id)? "selected" : "" ?>><?php echo $tecnico->nombre . " " . $tecnico->apellido ?></option>
                        <?php } ?>
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