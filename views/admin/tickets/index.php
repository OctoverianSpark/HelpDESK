<main class="container-tickets-viewer">



    <form class="search-form">

        <fieldset class="no-fieldset container-input-flex">
            <label for="col" class="input-group">
                <span>Columna</span>
                <select id="col">
                    <option value="" selected disabled>-- Elige una Opcion --</option>
                    <option value="id">ID</option>
                    <option value="categoria">Categoria</option>
                    <option value="usuario">Usuario</option>
                    <option value="estado">Status</option>
                    <option value="prioridad">Prioridad</option>
                    <option value="tecnico">Asignado a</option>
                </select>
            </label>


            <label for="val" class="input-group">
                <span>Valor</span>
                <input type="text" id="val">
            </label>

        </fieldset>

    </form>

    <div class="table-wrapper">

        <div class="table table-tickets-admin">

            <div class="table-row table-header">

                <div class="header">ID</div>
                <div class="header">Fecha</div>
                <div class="header">Categoria</div>
                <div class="header">Usuario</div>
                <div class="header">Status</div>
                <div class="header">Prioridad</div>
                <div class="header">Asignado a</div>
            </div>


            <?php foreach ($tickets as $ticket) { ?>


                <div class="table-row" data-id = "<?php echo $ticket->id ?>">
                    <div class="cell" col="id">
                        <button cell-id="<?php echo $ticket->id ?>" class="btn cell-btn view-btn" title="Ver Ticket">
                            <?php echo $ticket->id ?>
                            <i class="bi bi-box-arrow-up-right"></i>
                        </button>
                        <button class="btn cell-btn documentate" cell-id="<?php echo $ticket->id ?>" title="Documentar Ticket">
                            <i class="bi bi-file-earmark-plus-fill"></i>
                        </button>
                        <button class="btn cell-btn img-btn" cell-id="<?php echo $ticket->id ?>" title="Mostrar Imagen">
                            <i class="bi bi-image-fill"></i>
                        </button>
                    </div>
                    <div class="cell" col="fecha">
                        <?php echo date("d/m/Y H:i:s") ?>
                    </div>
                    <div class="cell" col="categoria" data-col="categoria">
                        <?php echo $ticket->categoria ?>
                    </div>
                    <div class="cell" col="usuario" >
                        <?php echo $ticket->usuario ?>
                    </div>
                    <div class="cell" col="estado" data-col="estado">
                        <?php echo $ticket->estado ?>
                    </div>
                    <div class="cell" col="prioridad" data-col="prioridad">
                        <?php echo $ticket->prioridad ?>
                    </div>
                    <div class="cell" col="tecnico" data-col="tecnico">
                        <?php echo $ticket->tecnico ?>
                    </div>
                </div>


            <?php } ?>


        </div>

    </div>



    <div class="modal tickets-view hidden">
            <button class="btn modal-close-btn">
                <i class="bi bi-x-circle-fill"></i>
            </button>
        <div class="container-data">

            <div class="container-info">
            </div>

            <div class="container-forms">

                <form method="post"  class="ticket-admin-form">
                    <fieldset class="container-input">
                        <legend>Tablero de acciones</legend>
                        <label for="status" class="input-group">
                            <span>Status</span>
                            <select name="estado" id="status" required>
                                <option value="" selected disabled>--Elige una Opcion--</option>
                                <option value="sin asignar">Sin Asignar</option>
                                <option value="pendiente">Pendiente</option>
                                <option value="en proceso">En Proceso</option>
                                <option value="completado">Completado</option>
                            </select>
                        </label>
                        <label for="category" class="input-group">
                            <span>Categoria</span>
                            <select name="categoria" id="category" required>
                                <option value="" selected disabled>--Elige una Opcion--</option>
                                <option value="red">Red</option>
                                <option value="aplicaciones">Aplicaciones</option>
                                <option value="equipo">Equipo</option>
                            </select>
                        </label>
                        <label for="subcat" class="input-group">
                            <span>Razon del Ticket</span>
                            <select name="subcategoria" id="subcat" required>
                                <option value="" selected disabled>--Elige una Opcion--</option>
                            </select>
                        </label>
                        <label for="asigned" class="input-group" >
                            <span>Asignar a</span>
                            <select name="tecnico_id" id="asigned" required>
                                <option value="" selected disabled>--Elige una opcion--</option>
                                <option value="0">Sin Asignar</option>
                                <?php foreach ($tecnicos as $tecnico) { ?>
                                    <option value="<?php echo $tecnico->id ?>"><?php echo ucwords(strtolower("$tecnico->first_name $tecnico->last_name")) ?></option>
                                <?php } ?>
                            </select>
                        </label>
                        <label for="priority" class="input-group" >
                            <span>Prioridad</span>
                            <select name="prioridad" id="priority" required>
                                <option value="" selected disabled>--Elige una Opcion--</option>
                                <option value="baja">Baja</option>
                                <option value="media">Media</option>
                                <option value="alta">Alta</option>
                            </select>
                        </label>
                        
                        <label for="solution" class="input-group">
                                <span>Solucion Brindada</span>
                                <textarea name="solucion" id="solution" placeholder="Describe la solucion brindada al problema" required></textarea>
                        </label>
                        <label for="comentarios" class="input-group">
                                <span>Comentarios adicionales</span>
                                <textarea name="comentarios" id="comentarios" placeholder="Comentarios adicionales"></textarea>
                        </label>
                        
                        <button class="btn btn-submit">
                            Actualizar
                        </button>
                    </fieldset>



                </form>

            </div>
        </div>
    </div>


    <div class="modal documentation-view hidden">
        <button class="btn modal-close-btn">
            <i class="bi bi-x-circle-fill"></i>
        </button>

        <div class="container-documentations">

                                
        </div>

        <form class="comment-form">

            <fieldset class="no-fieldset container-input">
                <legend>Documentacion de Seguimiento</legend>
                <label for="comment" class="chat-group">
                    <textarea name="comentario" id="comment" placeholder="Escribe la documentacion aqui..." required></textarea>
                    <button class="btn btn-send">
                        <i class="bi bi-send-fill"></i>
                    </button>
                </label>
            </fieldset>

        </form>
    </div>



    <div class="img-view hidden">

        <img src="/referencias/not-found.svg" alt="" loading="lazy">

    </div>

</main>