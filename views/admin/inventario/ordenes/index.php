



<main class="ordenes-container">



    <a href="ordenes/crear" class="boton-morado-inline">Crear Orden</a>
        
        <form method="get" class="search-requests">

            <div class="container-input-order">
                <label for="estado">Estado</label>
                <select name="state" id="estado">
                    <option value="pendiente" <?php echo ($_GET["state"] ==="pendiente" || !$_GET["state"])?"selected":"" ?>>Pendiente</option>
                    <option value="aprobada">Aprobada</option>
                    <option value="denegada">Denegada</option>
                    <option value="generada">Generada</option>
                    <option value="firmada">Firmada</option>
                </select>
                <input type="submit" value="Buscar" class="boton-morado-inline">
            </div>

        </form>
        <table class="tabla-ordenes">
                        


            <thead>
                <th>ID</th>
                <th>Tipo</th>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Estado</th>
                <?php if(!$_GET["state"] || $_GET["state"]==="pendiente"): ?>
                    <th>Acciones</th>
                <?php endif ?>
            </thead>
            <tbody>
                <?php foreach($ordenes as $orden){ ?>
                    <tr>
                        <td><?php echo s($orden->id) ?></td>
                        <td><?php echo s($orden->tipo) ?></td>
                        <td><?php echo s($orden->nombre) ?></td>
                        <td><?php echo s($orden->descripcion) ?></td>
                        <td><?php echo s($orden->estado) ?></td>
                        <?php if(!$_GET["state"] || $_GET["state"]==="pendiente"): ?>
                                <td>
                                    <form method="post">
                                        <input type="hidden" name="orderType" value="request">
                                        <input type="hidden" name="orders[id]" value="<?php echo s($orden->id) ?>">
                                        <input type="submit" value="Generar Orden" class="boton-morado-inline">
                                    </form>
                                </td>
                        <?php endif ?>
                    </tr>
                <?php } ?>
            </tbody>

        </table>

    </div>

    




</main>





