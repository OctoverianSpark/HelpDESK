<fieldset class="selector-wrapper no-fieldset">
    <legend>Usuario del equipo</legend>

    <label class="label-search-input" for="search">
        <div class="search">
            <i class="bi bi-search"></i>
            <input type="text" id="search" placeholder="Busca al usuario..." class="filter" value="<?php echo "$inv->nombre $inv->apellido" ?>" autocomplete="off" required>
        </div>
    </label>
    <ul class="options">
        <label class="option" for="option-0">
            <input type="radio" name="user_id" value="0" id="option-0" <?php echo ($inv->user_id == "0")?"checked":"" ?>>
            <span>STOCK</span>
        </label>
        <?php foreach ($users as $usr) { ?>
            <label for="option-<?php echo $usr->id ?>" class="option">
                <input type="radio" name="user_id" value="<?php echo $usr->id ?>" id="option-<?php echo $usr->id ?>" <?php echo ($usr->id == $inv->user_id)?"checked":"" ?>>
                <span><?php echo "$usr->nombre $usr->apellido" ?></span>
            </label>
        <?php } ?>

    </ul>


</fieldset>



<fieldset class="container-input-flex no-fieldset">
    <legend>Tipo de Equipo</legend>


    <label for="computer" class="radio-label-card">

        <input type="radio" name="tipo" id="computer" value="computador" required <?PHP echo (strtolower($inv->tipo) == "computer")?"checked":"" ?>>
        <i class="bi bi-pc-display"></i>
        <span>Computador de Escritorio</span>


    </label>
    <label for="laptop" class="radio-label-card">

        <input type="radio" name="tipo" id="laptop" value="laptop" required <?PHP echo (strtolower($inv->tipo) == "laptop")?"checked":"" ?>>
        <i class="bi bi-laptop"></i>
        <span>Laptop</span>


    </label>

</fieldset>

<div class="container-input-flex">

    <fieldset>
        <legend>Informacion del computador</legend>
        <label for="nombre_equipo" class="input-group">
            <span>Nombre del Equipo</span>
            <input type="text" name="nombre_equipo" id="nombre_equipo" placeholder="AV o AV-ASIST o AV-ASISTV" value="<?php echo $inv->nombre_equipo ?>" required>
        </label>

        <label for="marca" class="input-group">
            <span>Marca del equipo</span>
            <input type="text" name="marca" id="marca" placeholder="HP, TOSHIBA, LENOVO, etc..." required value ="<?php echo $inv->marca ?>">
        </label>

        <label for="modelo" class="input-group">
            <span>Modelo del equipo</span>
            <input type="text" name="modelo" id="modelo" placeholder="245 G8, L740, PROBOOK,etc..." required value ="<?php echo $inv->modelo ?>">
        </label>

        <label for="color" class="input-group">
            <span>Color del equipo</span>
            <input type="text" name="color" id="color" placeholder="Gris, Negro, etc" required value ="<?php echo $inv->color ?>">
        </label>


        <label for="serial" class="input-group">
            <span>Serial del equipo</span>
            <input type="text" name="serial" id="serial" placeholder="2CE123, 5CG123 ,etc..." required value ="<?php echo $inv->serial ?>">
        </label>

        <label for="anydesk" class="input-group">
            <span>Numero de Anydesk</span>
            <input type="text" name="anydesk" id="anydesk" placeholder="Ej: 123456789" required value ="<?php echo $inv->anydesk ?>">
        </label>
        <label for="password_anydesk" class="input-group">
            <span>Numero de Anydesk</span>
            <input type="text" name="password_anydesk" id="password_anydesk" placeholder="Ej: D0ntT0uch" required value ="<?php echo $inv->password_anydesk ?>">
        </label>




    </fieldset>

    <fieldset class="container-input-flex">

        <legend>Usuario y Correo</legend>

        <label for="usuarioPC" class="input-group">
            <span>Usuario del Computador</span>
            <input type="text" name="usuarioPC" id="usuarioPC" placeholder="Nombre.Inicial del Apellido" value="<?php echo $inv->usuarioPC ?>">
        </label>
        <label for="correo_dominio" class="input-group">
            <span>Correo del Dominio</span>
            <input type="text" name="correo_dominio" id="correo_dominio" placeholder="Nombre.Apellido@asistentevirtualsas" value="<?php echo $inv->correo_dominio ?>">
        </label>

    </fieldset>
</div>

<div class="container-input-flex">

    <fieldset class="container-input-flex no-fieldset">
        <legend>Propietario</legend>

        <label class="radio-label-card" for="avsas">
            <input type="radio" name="propietario" id="avsas" value="avsas" <?php echo (strtolower($inv->propietario) == "avsas")?"checked":"" ?>>
            <i class="bi bi-house-door-fill"></i>
            <span>AVSAS</span>
        </label>
        <label class="radio-label-card" for="rentadvisor">
            <input type="radio" name="propietario" id="rentadvisor" value="rentadvisor" <?php echo (strtolower($inv->propietario) == "rentadvisor")?"checked":"" ?>>
            <i class="bi bi-laptop-fill"></i>
            <span>Rentadvisor</span>
        </label>
        <label class="radio-label-card" for="lacloud">
            <input type="radio" name="propietario" id="lacloud" value="lacloud" <?php echo (strtolower($inv->propietario) == "lacloud")?"checked":"" ?>>
            <i class="bi bi-pc-display"></i>
            <span>LaCloud</span>
        </label>


    </fieldset>

    <fieldset class="container-input-flex no-fieldset">

        <legend>Este equipo esta asignado a un miembro de: </legend>

        <label for="colombia" class="radio-label-card">
            <input type="radio" name="sede" id="colombia" value="avsas" <?php echo (strtolower($inv->sede )== "avsas")?"checked":"" ?>>
            <i class="bi bi-house-door-fill"></i>
            <span>Sede Colombia</span>
        </label>
        <label for="venezuela" class="radio-label-card">
            <input type="radio" name="sede" id="venezuela" value="avca" <?php echo (strtolower($inv->sede )== "avca")?"checked":"" ?>>
            <i class="bi bi-houses-fill"></i>
            <span>Sede Venezuela</span>
        </label>
        <label for="ops" class="radio-label-card">
            <input type="radio" name="sede" id="ops" value="ops" <?php echo ($inv->sede == "ops")?"checked":"" ?>>
            <i class="bi bi-headset"></i>
            <span>Equipo de OPS</span>
        </label>
    </fieldset>
</div>


<div class="container-actions">
        
        <button type="button" class="btn btn-green add-btn"><i class="bi bi-plus-circle-fill" title="Agregar Periferico"></i></button>
        <button type="button" class="btn btn-red remove-btn"><i class="bi bi-dash-circle-fill" title="Eliminar Periferico"></i></button>

</div>




<div class="container-peripherals">



</div>