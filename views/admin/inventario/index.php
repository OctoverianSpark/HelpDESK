<main>


    <h1 class="title">Control de Inventario</h1>

    <?php $mensaje = mostrarNotificacion($_GET["resultado"])?>

    <?php if($mensaje){ ?>
        <div class="alerta exito">
            <?php echo $mensaje ?>
        </div>
    <?php } ?>


    <a href="/admin/inventario/crear" class="boton-morado-inline" >Añadir Equipo</a>
    <a href="/admin/inventario/ordenes" class="boton-morado-inline" >Ordenes</a>
    <form method="get" class="form-search">

        <div class="container-input-search">
            <label for="typeOf">Tipo</label>
            <select name="type" id="typeOf">
                <option value="nombre">Nombre del Ejecutivo</option>
                <option value="correo">Correo del Ejecutivo</option>
                <option value="nombre_equipo">Nombre del Equipo</option>
                <option value="marca">Marca</option>
                <option value="modelo">Modelo</option>
                <option value="color">Color</option>
                <option value="serial">Serial</option>
                <option value="usuarioPC">Usuario de Dominio</option>
                <option value="tipo">Tipo de Equipo</option>
            </select>
        </div>
        <div class="container-input-search">
            <label for="queryText">Que deseas buscar?</label>
            <input type="text" name="query" id="queryText">
        </div>

        <button type="submit" class="boton-morado-inline">Buscar <i class='bx bx-search-alt'></i></button>

    </form>

    <?php if(empty($equipos)){ ?>
        <div class="alerta error">
            No hay datos relacionados
        </div>
    <?php }else{ ?>
        <table class="table-inventario">

            <thead>
                <th>Nombre del equipo</th>
                <th>Usuario</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Color</th>
                <th>Serial</th>
                <th>Anydesk</th>
                <th>Acciones</th>
            </thead>
            <tbody>

                <?php foreach($equipos as $equipo):?>
                    <tr>

                        <td><?php echo $equipo->nombre_equipo ?><a href="/admin/inventario/ver?id=<?php echo $equipo->id ?>"><i class="bi bi-box-arrow-up-right"></i></a></td>
                        <td><?php echo $equipo->nombre . " " . $equipo->apellido ?></td>
                        <td><?php echo $equipo->marca ?></td>
                        <td><?php echo $equipo->modelo ?></td>
                        <td><?php echo $equipo->color ?></td>
                        <td><?php echo $equipo->serial ?></td>
                        <td><?php echo $equipo->anydesk ?><button type="button"><i class="bi bi-clipboard"></i></button></td>
                        <td>
                            <div class="inventory-actions">
                                <a href="/admin/inventario/actualizar?id=<?php echo $equipo->id ?>" class="boton-azul-block">Actualizar</a>
                                <form method="post">
                                    <input type="hidden" name="equipo[id]" value="<?php echo $equipo->id ?>">
                                    <input type="submit" value="Eliminar" class="boton-rojo-block">
                                </form>
                            </div>
                        </td>


                    </tr>
                <?php endforeach ?>
            </tbody>




        </table>
    <?php } ?>





</main>