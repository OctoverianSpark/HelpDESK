

<main class="contenedor-data">  

    <h1 class="title">Mis Tickets</h1>

    <?php if ($resultado): ?>
        
        <?php $mensaje = mostrarNotificacion(intval($resultado)) ?>
        <?php if ($mensaje):?>
            <p class="alerta exito"><?php echo $mensaje ?></p>
        <?php endif ?>

    <?php endif ?>

    <table class="tickets-table">

        <thead>
            <th>ID</th>
            <th>Creado el</th>
            <th>Categoria</th>
            <th>Asunto</th>
            <th>Tecnico Asignado</th>
            <th>Estado del Ticket</th>
            <th>Referencia</th>
        </thead>
        <tbody>
            <?php foreach($tickets as $ticket) :?>
                <tr onclick="location.href = '/ticket?id=<?php echo s($ticket->id) ?>'">
                        <td><?php echo strtoupper(s($ticket->id)) ?></td>
                        <td><?php echo strtoupper(s($ticket->fecha)) ?></td>
                        <td><?php echo strtoupper(s($ticket->categoria)) ?></td>
                        <td><?php echo strtoupper(s($ticket->subcategoria)) ?></td>
                        <td><?php echo strtoupper(s($ticket->tecnico)) ?></td>
                        <td><?php echo strtoupper(s($ticket->estado)) ?></td>
                        <td><?php if($ticket->imagen){?><img src="/referencias/<?php echo $ticket->imagen ?>" alt="Imagen de Referencia"><?php }else{ ?><i class="bi bi-exclamation"></i>Referencia Inexistente<?php } ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>

    </table>




</main>