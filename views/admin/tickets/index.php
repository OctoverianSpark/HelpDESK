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




<div class="ticket-detail-view hidden">

    <form method="post" class="ticket-details">

        <h1 id="usuario">Ticket</h1>
        <div class="radio-group">
            <p class="label"><i class="bi bi-grid-fill"></i> <span>Categoria</span></p>
            <div class="container-flex">
                <label for="aplicaciones" class="radio-label-card --smaller">
                    <span><i class="bi-gear-fill"></i>Aplicaciones</span>
                    <input type="radio" name="categoria" id="aplicaciones" value="aplicaciones">
                </label>
                <label for="equipo" class="radio-label-card --smaller">
                    <span><i class="bi-pc-display"></i><br>Equipo</span>
                    <input type="radio" name="categoria" id="equipo" value="equipo">
                </label>
                <label for="red" class="radio-label-card --smaller">
                    <span><i class="bi-ethernet"></i><br>Red</span>
                    <input type="radio" name="categoria" id="red" value="red">
                </label>
            </div>
        </div>

        <label for="asunto" class="detail-group">
            <p><i class="bi bi-braces-asterisk"></i><span>Asunto</span></p>
            <input type="text" name="asunto" id="asunto">
        </label>

        <div class="container-flex --wrap">

            <label for="state" class="detail-group">
                <p>
                    <i class="bi bi-diamond-fill"></i>
                    <span>Estado</span>
                </p>
                <select name="state" id="state">
                    <option value="">--Selecciona una opcion--</option>
                    <option value="en proceso">En proceso</option>
                    <option value="pendiente">pendiente</option>
                    <option value="completado">Completado</option>
                </select>
            </label>
            <label for="tecnico_id" class="detail-group">
                <p>
                    <i class="bi bi-person-fill"></i>
                    <span>Tecnico asignado</span>
                </p>
                <select name="tenico_id" id="tecnico_id">
                    <?php foreach ($techs as $tech) { ?>
                        <option value="<?php echo $tech->id ?>"><?php echo ucwords(strtolower($tech->first_name . ' ' . $tech->last_name)) ?></option>
                    <?php } ?>
                </select>
            </label>
            <label for="prioridad" class="detail-group">
                <p>
                    <i class="bi bi-flag-fill"></i>
                    <span>Prioridad</span>
                </p>
                <select name="prioridad" id="prioridad">
                    <option value="">--Selecciona una opcion--</option>
                    <option value="baja">Baja</option>
                    <option value="media">Media</option>
                    <option value="alta">Alta</option>
                </select>
            </label>
        </div>
        <div class="container-flex">

            <label for="descripcion" class="detail-group">
                <p><i class="bi bi-file-earmark-fill"></i>Descripcion</p>
                <textarea id="descripcion" readonly></textarea>
            </label>
            <label for="solution" class="detail-group">
                <p><i class="bi bi-check2-circle"></i>Solucion</p>
                <textarea id="solution"></textarea>
            </label>
        </div>

        <button type="submit" class="btn primary-btn">Actualizar</button>

    </form>

</div>




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


    </div>

</div>
<div id="pagination"></div>



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