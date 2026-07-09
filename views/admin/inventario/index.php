<h1 class="title">Control de Inventario</h1>

<?php $mensaje = mostrarNotificacion($_GET["resultado"]) ?>

<?php if ($mensaje) { ?>
    <div class="alerta exito">
        <?php echo $mensaje ?>
    </div>
<?php } ?>


<button type="button" class="btn primary-btn" id="sync-btn">Sincronizar con clickup <i class="bi bi-arrow-left-right"></i></button>
<button type="button" class="btn primary-btn" id="tracer-sync-btn">Sincronizar con Tracer <i class="bi bi-arrow-left-right"></i></button>

<div class="bulk-actions-bar" id="bulk-actions-bar" hidden>
    <span><span id="bulk-selected-count">0</span> equipo(s) seleccionado(s)</span>
    <button type="button" class="btn" id="bulk-edit-btn">Editar campos <i class="bi bi-pencil-fill"></i></button>
    <button type="button" class="btn" id="bulk-stock-btn">Pasar a Stock <i class="bi bi-archive"></i></button>
    <button type="button" class="btn danger-btn" id="bulk-delete-btn">Eliminar <i class="bi bi-trash-fill"></i></button>
</div>

<form method="get" class="selection-form">

    <div class="container-flex">

        <label for="active" class="radio-label-card">
            <i class="bi bi-check"></i>
            <input type="radio" name="state" value="1" id="active" />
            <span>Activo</span>
        </label>

        <label for="stock" class="radio-label-card">
            <i class="bi bi-archive"></i>
            <input type="radio" name="state" value="0" id="stock" />
            <span>Stock</span>
        </label>

    </div>
</form>

<form class="inv-filter-form" method="GET">

    <div class="container-grid">

        <div class="container-flex">

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
            <div class="header"><input type="checkbox" id="bulk-select-all"></div>
            <div class="header">Nombre del Equipo</div>
            <div class="header">Usuario del Equipo</div>
            <div class="header">Marca</div>
            <div class="header">Modelo</div>
            <div class="header">Color</div>
            <div class="header">Serial</div>
        </div>


    </div>

</div>
<div id="pagination"></div>


<div class="modal inv-view">



    <div class="inv-content">
        <div class="computer">
            <h1 id="computer-nombre">Nombre</h1>

            <p><span id="computer-nombre_equipo"></span></p>
            <p><span id="computer-tipo"></span></p>
            <p><span id="computer-marca"></span></p>
            <p><span id="computer-modelo"></span></p>
            <p><span id="computer-color"></span></p>
            <p><span id="computer-serial"></span></p>

        </div>
        <div class="pers">

        </div>

    </div>

</div>

<div class="modal maintenance-form-modal bulk-edit-modal">
    <form id="bulk-edit-form">
        <h2>Editar equipos seleccionados</h2>
        <p class="bulk-edit-hint">Deja vacio lo que no quieras cambiar. Se aplica a <span id="bulk-edit-count">0</span> equipo(s).</p>

        <label class="input-group">
            <span>Tipo</span>
            <input type="text" name="tipo" autocomplete="off">
        </label>
        <label class="input-group">
            <span>Marca</span>
            <input type="text" name="marca" autocomplete="off">
        </label>
        <label class="input-group">
            <span>Modelo</span>
            <input type="text" name="modelo" autocomplete="off">
        </label>
        <label class="input-group">
            <span>Color</span>
            <input type="text" name="color" autocomplete="off">
        </label>
        <label class="input-group">
            <span>Propietario</span>
            <input type="text" name="propietario" autocomplete="off">
        </label>
        <label class="input-group">
            <span>Correo dominio</span>
            <input type="text" name="correo_dominio" autocomplete="off">
        </label>

        <div class="container-flex">
            <button type="button" class="btn" id="bulk-edit-cancel">Cancelar</button>
            <button type="submit" class="btn primary-btn">Aplicar</button>
        </div>
    </form>
</div>