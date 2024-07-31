



<main class="ordenes-container">


    <div class="generator">
        <div class="container-input-order">
            <label for="orders-type">Como quieres generar las ordenes?</label>
            <select id="orders-type">
                <option value="manual">Generar Orden Manual</option>
                <option value="request">Generar Orden Solicitada</option>
            </select>
        </div>
        <form method="post" class="form-order" id="order-manual" style="display:none;">

            <input type="hidden" name="orderType" value="manual">

            <div class="container-input-order">
                <label for="type">Tipo de Orden</label>
                <select name="type" id="type">
                    <option value="Entrega">Entrega</option>
                    <option value="Salida">Salida</option>
                    <option value="Recepcion">Recepcion</option>
                </select>
            </div>

            <div class="container-input-order">
                <label for="computer">ID del Equipo : Usuario de ese equipo</label>
                <select name="computer" id="computer">
                    <?php foreach($inventario as $inv): ?>
                        <option value="<?php echo $inv->nombre_equipo ?>"><?php echo $inv->nombre_equipo . " : " . $inv->nombre . " " . $inv->apellido ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="container-input-order">
                <label for="nombre">Persona a asignar el equipo</label>
                <select name="nombre" id="nombre">
                    <option value="same">Mismo usuario del equipo</option>
                    <?php foreach($inventario as $inv): ?>
                        <option value="<?php echo $inv->nombre . " " . $inv->apellido ?>"><?php echo $inv->nombre . " " . $inv->apellido ?></option>
                    <?php endforeach ?>
                </select>
                <input type="submit" class="boton-morado-inline" value="Enviar Orden">
            </div>




        </form>
        <form method="post" class="form-order" id="order-requested" style="display:none">

            <input type="hidden" name="orderType" value="request">
            <div class="container-input-order">
                <label for="order-id">ID de la Orden Solicitada</label>
                <select name="orders[id]" id="order-id">
                    <?php foreach($ordenes as $orden){ ?>
                        <option value="<?php echo $orden->id ?>"><?php echo $orden->id . " : " . $orden->nombre ?></option>
                    <?php } ?>
                </select>
                <input type="submit" class="boton-morado-inline" value="Enviar Orden">
            </div>
        </form>
    </div>

    <div class="table">

        
        <form method="get" class="search-requests">

            <div class="container-input-order">
                <label for="estado">Estado</label>
                <select name="state" id="estado">
                    <option value="pendiente" <?php echo ($_GET["state"] ==="pendiente" || !$_GET["state"])?"selected":"" ?>>Pendiente</option>
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





