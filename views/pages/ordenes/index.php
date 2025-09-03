<h1 class="title">Solicitud de Orden de Salida</h1>




<form method="post" class="order-query-mngr container-grid">
    <label for="user_id" class="input-group">
        <span>Usuario</span>
        <select name="user_id" id="user_id
">
            <?php foreach ($usrs as $user) { ?>

                <option value="<?php echo $user->id ?>"><?php echo $user->first_name . ' ' . $user->last_name ?></option>
            <?php } ?>

        </select>

    </label>

    <label for="computer_id" class="input-group">
        <span>Computador</span>
        <select name="computer_id" id="computer_id">
            <?php foreach ($inv as $eq) { ?>
                <option value="<?php echo $eq->id ?>"><?php echo $eq->nombre_equipo ?>:<?php echo $eq->nombre ?></option>
            <?php } ?>
        </select>
    </label>



    <fieldset class="no-fieldset container-flex">

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


    <button type="submit" class="btn primary-btn">Enviar Solicitud</button>



</form>