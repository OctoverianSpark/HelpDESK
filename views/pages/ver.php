

<main class="contenedor-data">  

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
            <th>Descripcion</th>
            <th>Tecnico Asignado</th>
            <th>Estado del Ticket</th>
            <th>Referencia</th>
        </thead>
        <tbody>
            <?php foreach($tickets as $ticket) :?>
                <tr onclick="location.href = '/ticket?id=<?php echo s($ticket->id) ?>'">
                        <td><?php echo s($ticket->id) ?></td>
                        <td><?php echo s($ticket->fecha) ?></td>
                        <td><?php echo s($ticket->categoria) ?></td>
                        <td><?php echo s($ticket->subcategoria) ?></td>
                        <td><?php echo s($ticket->descripcion) ?></td>
                        <td><?php echo s($ticket->tecnico) ?></td>
                        <td><?php echo s($ticket->estado) ?></td>
                        <td><img src="/referencias/<?php echo $ticket->imagen ?>" alt="Sin Referencia"></td>
                </tr>
            <?php endforeach ?>
        </tbody>

    </table>




</main>