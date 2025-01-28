<h1 class="title">Solicitud de Orden de Salida</h1>


<form method="get" class="selection-form">


    <?php if ($_GET["type"] !== "salida") { ?>
        <fieldset class="container-input-flex no-fieldset">
            <legend>Estancia del Usuario</legend>

            <label class="radio-label-card">
                <input type="radio" name="sede" value="avsas" <?php echo ($_GET["sede"] === "avsas") ? "checked" : "" ?>>
                <i class="bi bi-house-door"></i>
                <span>Colombia</span>
            </label>
            <label class="radio-label-card">
                <input type="radio" name="sede" value="avca" <?php echo ($_GET["sede"] === "avca") ? "checked" : "" ?>>
                <i class="bi bi-airplane-fill"></i>
                <span>Venezuela</span>
            </label>
            <label class="radio-label-card">
                <input type="radio" name="sede" value="ops" <?php echo ($_GET["sede"] === "ops") ? "checked" : "" ?>>
                <i class="bi bi-headphones"></i>
                <span>OPS</span>
            </label>

        </fieldset>
    <?php } ?>


</form>

<form method="post" class="order-query-mngr">

    <fieldset class="selector-wrapper no-fieldset">
        <legend>Usuario del equipo</legend>

        <label class="label-search-input" for="usr-search">
            <div class="search">
                <i class="bi bi-search"></i>
                <input type="text" id="usr-search" placeholder="Busca al usuario..." class="filter" autocomplete="off" required>
            </div>
        </label>
        <ul class="options">

            <?php foreach ($usrs as $usr) { ?>
                <label for="usr-option-<?php echo $usr->id ?>" class="option">
                    <input type="radio" name="user_id" value="<?php echo $usr->id ?>" id="usr-option-<?php echo $usr->id ?>" <?php echo ($usr->id == $inv->user_id) ? "checked" : "" ?>>
                    <span><?php echo "$usr->nombre $usr->apellido" ?></span>
                </label>
            <?php } ?>

        </ul>


    </fieldset>


    <fieldset class="selector-wrapper no-fieldset">
        <legend>Computador</legend>

        <label class="label-search-input" for="computer-search">
            <div class="search">
                <i class="bi bi-search"></i>
                <input type="text" id="computer-search" placeholder="Computador" class="filter" name="" autocomplete="off" required>
            </div>
        </label>
        <ul class="options">
            <?php foreach ($inv as $eq) { ?>
                <label for="computer-option-<?php echo $eq->id ?>" class="option">
                    <input type="radio" name="computer_id" id="computer-option-<?php echo $eq->id ?>" value="<?php echo $eq->id ?>">
                    <span title="Este computador pertenece a: <?php echo $eq->nombre . " " . $eq->apellido ?> "><?php echo $eq->nombre_equipo ?> : <?php echo $eq->nombre . " " . $eq->apellido ?></span>
                </label>
            <?php } ?>

        </ul>



    </fieldset>



    <fieldset class="no-fieldset container-input-flex">

                <label for="emitted" class="input-group">
                    <span>Fecha de Emisi&oacute;n</span>
                    <input type="date" name="emitted_date" id="emitted" required placeholder="Fecha">
                </label>

                <label for="return" class="input-group">
                    <span>Fecha de Retorno</span>
                    <input type="date" name="return_date" id="return" required placeholder="Fecha">
                </label>

    </fieldset>

    <fieldset class="no-fieldset container-input">

        <label for="description" class="input-group">
            <span>Descripcion</span>
            <textarea name="description" id="description" placeholder="Describe la razon de la salida..." required></textarea>
        </label>
    </fieldset>


    <button type="submit" class="btn btn-submit">Enviar Solicitud</button>



</form>