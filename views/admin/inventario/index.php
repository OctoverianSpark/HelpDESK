<h1 class="title">Control de Inventario</h1>

<?php $mensaje = mostrarNotificacion($_GET["resultado"]) ?>

<?php if ($mensaje) { ?>
    <div class="alerta exito">
        <?php echo $mensaje ?>
    </div>
<?php } ?>
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