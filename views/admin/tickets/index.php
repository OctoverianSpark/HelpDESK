<h1 class="title">Administraci&oacute;n de Tickets</h1>

<form class="search-form container-flex">

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


</form>




<div class="modal ticket-detail-view">

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

        <label for="subcategoria" class="detail-group">
            <p><i class="bi bi-braces-asterisk"></i><span>Asunto</span></p>
            <input type="text" name="subcategoria" id="subcategoria">
        </label>

        <div class="container-flex --wrap">

            <label for="estado" class="detail-group">
                <p>
                    <i class="bi bi-diamond-fill"></i>
                    <span>Estado</span>
                </p>
                <select name="estado" id="estado">

                    <option value="en proceso">En proceso</option>
                    <option value="pendiente">Pendiente</option>
                    <option value="completado">Completado</option>
                </select>
            </label>
            <label for="tecnico_id" class="detail-group">
                <p>
                    <i class="bi bi-person-fill"></i>
                    <span>Tecnico asignado</span>
                </p>
                <select name="tecnico_id" id="tecnico_id">

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
            <label for="solucion" class="detail-group">
                <p><i class="bi bi-check2-circle"></i>Solucion</p>
                <textarea id="solucion"></textarea>
            </label>
        </div>

        <button type="submit" class="btn primary-btn">Actualizar</button>

    </form>

</div>



<div class="modal documentation-view">


    <form method="POST" class="documentation-form">
        <div class="updates">
            <div class="comment">
                <span class="fecha">Fecha</span>
                <span class="comentario">Informacion del comentario</span>
                <span class="cargado_por">Autor</span>
            </div>

        </div>

        <fieldset class="no-fieldset container-flex">
            <legend>Documentacion de Seguimiento</legend>
            <label for="comment" class="input-group">
                <input type="text" name="comentario" id="comment" placeholder="Escribe tu comentario aqui...">
            </label>
            <button type="submit" class="chat-btn"><i class="bi bi-send-arrow-up"></i></button>


        </fieldset>

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




<div class="img-view">

    <img src="/referencias/not-found.svg" alt="" loading="lazy">

</div>