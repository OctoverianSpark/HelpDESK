<h1 class="title">Mis Ordenes</h1>




<table class="tabla-ordenes">
    <thead>
        <th>Fecha</th>
        <th>Tipo de Orden</th>
        <th>Salida</th>
        <th>Retorno</th>
        <th>Descripcion</th>
        <th>Estado</th>
        <th>Observaciones</th>
    </thead>
    <tbody>
        <?php foreach($ordenes as $orden){ ?>
            <tr>
                <td><?php echo $orden->fecha ?></td>
                <td><?php echo $orden->tipo ?></td>
                <td><?php echo $orden->fecha_salida ?></td>
                <td><?php echo $orden->fecha_retorno ?></td>
                <td><?php echo $orden->descripcion ?></td>
                <td><?php echo $orden->estado ?></td>
                <td><?php echo $orden->observaciones ?></td>
            </tr>


        <?php } ?>
    </tbody>
</table>