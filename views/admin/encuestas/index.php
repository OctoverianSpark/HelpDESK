<h1 class="title">Administrar Encuestas de Satisfaccion</h1>








<form method="get" class="form-search">

    <div class="container-input-search">
        <label for="state">Buscar encuestas</label>
        <select name="state" id="state">
            <option value="completada" <?php echo ($_GET["state"] === "completada")? "selected" : "" ?>>Completada</option>
            <option value="pendiente" <?php echo ($_GET["state"] === "pendiente")? "selected" : "" ?>>Pendiente</option>
            <option value="vencida" <?php echo ($_GET["state"] === "vencida")? "selected" : "" ?>>Vencida</option>
            <option value="aptos" <?php echo ($_GET["state"] === "vencida")? "selected" : "" ?>>Aptos a Rifa</option>
        </select>

    </div>

    <button type="submit" class="boton-morado-inline">Buscar <i class='bx bx-search-alt'></i></button>


    <a href="/admin/encuestas" class="boton-morado-inline">Borrar Filtro <i class='bx bxs-trash' ></i></a>

</form>



<?php ?>
<table class="tabla-encuestas">



    <?php if($_GET["state"]==="completada" || !$_GET["state"]){ ?>

        <thead>
            <th>ID</th>
            <th>Creacion / Vencimiento</th>
            <th>Estado</th>
            <th>Ticket</th>
            <th>Usuario</th>
            <th>Resolucion</th>
            <th>Asertividad</th>
            <th>Rapidez</th>
            <th>Calidad</th>
            <th>Promedio</th>
            <th>Comentarios</th>
        </thead>
        <tbody>
            <?php foreach($encuestas as $encuesta){ ?>

                <tr>
                    <td><?php echo s($encuesta->id) ?></td>
                    <td><?php echo s($encuesta->creado) . " / " . s($encuesta->vencimiento) ?></td>
                    <td><?php echo ucwords(s($encuesta->estado)) ?></td>
                    <td><?php echo s($encuesta->subcategoria) ?></td>
                    <td><?php echo s($encuesta->usuario) ?></td>
                    <td><?php echo s($encuesta->resolucion) ?></td>
                    <td><?php echo s($encuesta->asertividad) ?></td>
                    <td><?php echo s($encuesta->rapidez) ?></td>
                    <td><?php echo s($encuesta->calidad) ?></td>
                    <td><?php echo s($encuesta->promedio) ?></td>
                    <td><?php echo s($encuesta->comentarios) ?></td>

                </tr>

            <?php } ?>
        </tbody>

    <?php }else if($_GET["state"] === "pendiente" || $_GET["state"] === "vencida"){ ?>
        
        <thead>
            <th>ID</th>
            <th>Creacion / Vencimiento</th>
            <th>Estado</th>
            <th>Ticket</th>
            <th>Usuario</th>
        </thead>
        <tbody>
            <?php foreach($encuestas as $encuesta){ ?>

                <tr>
                    <td><?php echo s($encuesta->id) ?></td>
                    <td><?php echo s($encuesta->creado) . " / " . s($encuesta->vencimiento) ?></td>
                    <td><?php echo ucwords(s($encuesta->estado)) ?></td>
                    <td><?php echo s($encuesta->subcategoria) ?></td>
                    <td><?php echo s($encuesta->usuario) ?></td>

                </tr>

            <?php } ?>
        </tbody>

    <?php }?>
</table>
