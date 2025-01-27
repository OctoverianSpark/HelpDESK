<main>


    <h1 class="title">Control de Inventario</h1>

    <?php $mensaje = mostrarNotificacion($_GET["resultado"]) ?>

    <?php if ($mensaje) { ?>
        <div class="alerta exito">
            <?php echo $mensaje ?>
        </div>
    <?php } ?>

    <form class="search-form" method="GET">

        <div class="container-input">

            <div class="container-input-flex">

                <label for="col" class="input-group" direction="column">
                    <span>Buscar por:</span>

                    <select name="col" id="col">
                        <option value="" disabled selected>Elige una opcion</option>
                        <option value="nombre_equipo">Nombre del Equipo</option>
                        <option value="nombre">Nombre del Usuario</option>
                        <option value="marca">Marca</option>
                        <option value="modelo">Modelo</option>
                        <option value="color">Color</option>
                        <option value="serial">Serial</option>
                        <option value="anydesk">Anydesk</option>
                    </select>
                </label>

                <label for="val" class="input-group" direction="column">
                    <span>Valor</span>

                    <input type="text" name="val" id="val" placeholder="Buscar..." autocomplete="off">

                </label>
            </div>
        </div>



    </form>

    <div class="table-wrapper">

        <div class="table table-inv-admin">
            <div class="table-row table-header">
                <div class="header">Nombre del Equipo</div>
                <div class="header">Usuario del Equipo</div>
                <div class="header">Marca</div>
                <div class="header">Modelo</div>
                <div class="header">Color</div>
                <div class="header">Serial</div>
                <div class="header">Anydesk</div>
            </div>

            <?php foreach ($equipos as $equipo) { ?>
                <div class="table-row" cell-id="<?php echo $equipo->id ?>">
                    <div class="cell cell-link" col="nombre_equipo">
                        <button class="btn view-btn">
                            <?php echo $equipo->nombre_equipo ?>
                            <i class="bi bi-box-arrow-up-right"></i>
                        </button>
                    </div>
                    <div class="cell" col="nombre">

                        <?php echo "$equipo->nombre $equipo->apellido" ?>

                    </div>
                    <div class="cell" col="marca">

                        <?php echo $equipo->marca ?>

                    </div>
                    <div class="cell" col="modelo">
                        <?php echo $equipo->modelo ?>
                    </div>
                    <div class="cell" col="color">
                        <?php echo $equipo->color ?>
                    </div>
                    <div class="cell" col="serial">
                        <?php echo $equipo->serial ?>
                    </div>
                    <div class="cell" col="anydesk">
                        <?php echo $equipo->anydesk ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <div class="modal modal-view inv-view hidden">




        <div class="container-actions">
            <button class="modal-close-btn btn top-btn" title="Cerrar">
                Cerrar
                <i class="bi bi-x-circle-fill"></i>
            </button>
            <button class="btn stock-btn top-btn" cellId="">
                Mover a Stock
                <i class="bi bi-archive-fill"></i>
            </button>
            <button class="btn delete-btn top-btn" cellId="">
                Eliminar
                <i class="bi bi-trash-fill"></i>
            </button>
            <a class="btn update-btn top-btn">
                Actualizar
                <i class="bi bi-pen-fill"></i>
            </a>
        </div>
        <br>


    </div>

</main>