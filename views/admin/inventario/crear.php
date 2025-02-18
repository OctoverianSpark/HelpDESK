<?php foreach ($errores as $error): ?>
    <div class="alerta error">
        <?php echo $error ?>
    </div>
<?php endforeach  ?>

<main>

    <form class="selection-form" method="get">


        <fieldset class="container-input-flex no-fieldset">

            <legend>Este equipo esta asignado a un miembro de: </legend>

            <label for="colombia" class="radio-label-card">
                <input type="radio" name="sede" id="colombia" value="avsas" <?php echo (strtolower($inv->sede) == "avsas") ? "checked" : "" ?>>
                <i class="bi bi-house-door-fill"></i>
                <span>Sede Colombia</span>
            </label>
            <label for="venezuela" class="radio-label-card">
                <input type="radio" name="sede" id="venezuela" value="avca" <?php echo (strtolower($inv->sede) == "avca") ? "checked" : "" ?>>
                <i class="bi bi-houses-fill"></i>
                <span>Sede Venezuela</span>
            </label>
            <label for="ops" class="radio-label-card">
                <input type="radio" name="sede" id="ops" value="ops" <?php echo ($inv->sede == "ops") ? "checked" : "" ?>>
                <i class="bi bi-headset"></i>
                <span>Equipo de OPS</span>
            </label>
        </fieldset>
    </form>

    <form method="post" class="inv-form">
        <input type="hidden" name="sede" value="<?php echo $_GET["sede"] ?>">
        <?php include "formulario.php" ?>


        <button class="btn btn-submit">Enviar <i class="bi bi-floppy2-fill"></i></button>
    </form>
</main>