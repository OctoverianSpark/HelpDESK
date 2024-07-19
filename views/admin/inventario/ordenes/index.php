



<main>


    <form method="post">


        <label for="type">Tipo de Orden</label>
        <select name="type" id="type">
            <option value="Entrega">Entrega</option>
            <option value="Salida">Salida</option>
            <option value="Recepcion">Recepcion</option>
        </select>

        <label for="computer">ID del Equipo</label>
        <select name="computer" id="computer">
            <?php foreach($inventario as $inv): ?>
                <option value="<?php echo $inv->nombre_equipo ?>"><?php echo $inv->nombre_equipo?></option>
            <?php endforeach ?>
        </select>
        <label for="nombre">Persona a asignar el equipo</label>
        <select name="nombre" id="nombre">
            <option value="same">Mismo usuario del equipo</option>
            <?php foreach($inventario as $inv): ?>
                <option value="<?php echo $inv->nombre . " " . $inv->apellido ?>"><?php echo $inv->nombre . " " . $inv->apellido ?></option>
            <?php endforeach ?>
        </select>

        <input type="submit" class="boton-morado-inline" value="Generar Plantilla">



    </form>

    




</main>





