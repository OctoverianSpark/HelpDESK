<main class="contenedor-ticket">
<h1>Administrador de Tickets</h1>
    
<div class="container-filters">
    <form method="get" class="form-search">
        <input type="hidden" name="type" value="tecnico_id">
        <div class="container-input-search" id="queryCont">
            <label for="queryText">Tecnico Asignado</label>
            <select type="text" name="query" id="queryText">
                <?php foreach($tecnicos as $tecnico): ?>
                    <option value="<?php echo $tecnico->id ?>" <?php echo ($_GET["query"] === $tecnico->id)? "selected":"" ?>  ><?php echo $tecnico->nombre . " " . $tecnico->apellido ?></option>
                <?php endforeach ?>
            </select>
        </div>

        <button type="submit" class="boton-morado-inline">Buscar <i class='bx bx-search-alt'></i></button>

    </form>
    <form method="get" class="form-search">

        <div class="container-input-search">
            <label for="typeOf">Tipo</label>
            <select name="type" id="typeOf">
                <option value="usuario" <?php echo ($_GET["type"] === "usuario")? "selected":"" ?>>Nombre del Usuario</option>
                <option value="categoria" <?php echo ($_GET["type"] === "categoria")? "selected":"" ?>>Categoria del Ticket</option>
                <option value="subcategoria" <?php echo ($_GET["type"] === "subcategoria")? "selected":"" ?>>Subcategoria</option>
                <option value="estado" <?php echo ($_GET["type"] === "estado")? "selected":"" ?>>Estado</option>
            </select>
        </div>
        <div class="container-input-search" id="queryCont">
            <label for="queryText">Que deseas buscar?</label>
            <input type="text" name="query" id="queryText">
        </div>

        <button type="submit" class="boton-morado-inline">Buscar <i class='bx bx-search-alt'></i></button>

    </form>
</div>



<?php if ($resultado): ?>
        <?php $mensaje = mostrarNotificacion(intval($resultado)) ?>
        <?php if ($mensaje):?>
            <p class="alerta exito"><?php echo $mensaje ?></p>
        <?php endif ?>
    
        <?php endif ?>
    
        <table class="tickets-table seccion contenido-centrado">
    
            <thead>
                <th>ID</th>
                <th>Creado el</th>
                <th>Creado por</th>
                <th>Categoria</th>
                <th>Asunto</th>
                <th>Descripcion</th>
                <th>Tecnico Asignado</th>
                <th>Estado del Ticket</th>
                <th>Referencia</th>
                <th>Acciones</th>
            </thead>
            <tbody>
                <?php foreach($tickets as $ticket) :?>
                        <tr>
                                <td><?php echo s($ticket->id) ?></td>
                                <td><?php echo s($ticket->fecha) ?></td>
                                <td><?php echo s($ticket->usuario) ?></td>
                                <td><?php echo s($ticket->categoria) ?></td>
                                <td><?php echo s($ticket->subcategoria) ?></td>
                                <td><?php echo s($ticket->descripcion) ?></td>
                                <td><?php echo s($ticket->tecnico) ?></td>
                                <td><?php echo ucwords(s($ticket->estado)) ?></td>
                                <td><img src="/referencias/<?php echo $ticket->imagen ?>" alt="Sin Referencia"></td>
                                <td>
                                    <a href="/admin/tickets/ticket?id=<?php echo s($ticket->id)?>" class="boton-morado-inline">Gestionar</a>
                                </td>
                        </tr>
                <?php endforeach ?>
            </tbody>
    
        </table>
    
    
    


    </main>