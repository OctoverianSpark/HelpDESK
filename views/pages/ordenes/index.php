<h1 class="title">Solicitud de Orden de Salida</h1>




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
                    <span><?php echo "$usr->first_name $usr->last_name" ?></span>
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
                <label for="computer-option-<?php echo $eq->getID() ?>" class="option">
                    <input type="radio" name="computer_id" id="computer-option-<?php echo $eq->getID() ?>" value="<?php echo $eq->id ?>">
                    <span><?php echo $eq->getNombreEquipo() ?> : <?php echo $eq->getNombre() . " " . $eq->getApellido() ?></span>
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
            <label for="no-return" class="checkbox-group">
                <input type="checkbox" name="return_date" id="no-return" value="no return">
                <span>Sin Retorno</span>
            </label>
        </label>

    </fieldset>

    <label class="input-group" for="mail">
        <span>Enviar orden al correo: </span>
        <input type="email" name="mail" id="mail" required>
    </label>

    <fieldset class="no-fieldset container-input">

        <label for="description" class="input-group">
            <span>Descripcion</span>
            <textarea name="description" id="description" placeholder="Describe la razon de la salida..." required></textarea>
        </label>
    </fieldset>


    <button type="submit" class="btn btn-submit">Enviar Solicitud</button>



</form>