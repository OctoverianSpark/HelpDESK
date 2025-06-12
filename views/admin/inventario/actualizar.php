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


    <form method="post" class="inv-form">

        <button type="button" class="open-mdl btn btn-purple">Agendar manteminiento</button>
        <?php include "formulario.php" ?>
        <button class="btn btn-submit">Actualizar <i class="bi bi-floppy2-fill"></i></button>
    </form>


</main>