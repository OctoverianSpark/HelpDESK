<main>



    <div class="modal maintenance-form-modal">
        <form method="post">

            <input type="hidden" name="computer" value="<?php echo $inv->id ?>">

            <label for="latest" class="input-group">
                <span>Mantenimiento Previo</span>
                <input type="date" name="latest" id="latest">
            </label>

            <label for="next" class="input-group">
                <span>Siguiente Mantenimiento</span>
                <input type="date" name="next" id="next">
            </label>

            <label for="tech" class="input-group">
                <span>Tecnico</span>
                <select name="tech" id="tech">
                    <?php foreach ($techs as $tech) { ?>
                        <option value="<?php echo "$tech->first_name $tech->last_name" ?>"><?php echo "$tech->first_name $tech->last_name" ?></option>
                    <?php } ?>
                    <option value="other">Otro</option>
                </select>
                <input type="text" name="tech" id="other" disabled>
            </label>


            <button type="submit" class="btn-submit btn">Cargar Mantenimiento</button>
        </form>
    </div>


    <form class="selection-form" method="get">


        <fieldset class="container-input-flex no-fieldset">

            <legend>Este equipo esta asignado a un miembro de: </legend>

            <label for="colombia" class="radio-label-card">
                <input type="radio" name="sede" id="colombia" value="avsas" <?php echo (($_GET['sede'] ?? strtolower($inv->sede)) === "avsas") ? "checked" : "" ?>>
                <i class="bi bi-house-door-fill"></i>
                <span>Sede Colombia</span>
            </label>
            <label for="venezuela" class="radio-label-card">
                <input type="radio" name="sede" id="venezuela" value="avca" <?php echo (($_GET['sede'] ?? strtolower($inv->sede)) === "avca") ? "checked" : "" ?>>
                <i class="bi bi-houses-fill"></i>
                <span>Sede Venezuela</span>
            </label>
            <label for="ops" class="radio-label-card">
                <input type="radio" name="sede" id="ops" value="ops" <?php echo (($_GET['sede'] ?? strtolower($inv->sede)) === "ops") ? "checked" : "" ?>>
                <i class="bi bi-headset"></i>
                <span>Equipo de OPS</span>
            </label>
        </fieldset>
    </form>


    <form method="post" class="inv-form">

        <button type="button" class="open-mdl btn btn-purple">Agendar manteminiento</button>
        <?php include "formulario.php" ?>
        <button class="btn btn-submit">Actualizar <i class="bi bi-floppy2-fill"></i></button>
    </form>


</main>