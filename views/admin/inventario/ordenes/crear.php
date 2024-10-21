<h1 class="title">Generar Orden de <span id="order-name">Entrega</span></h1>



<form method="post" class="form-order">


            <div class="container-input-order">
                <label for="type">Tipo de Orden</label>
                <select name="tipo" id="type">
                    <option value="entrega">Entrega</option>
                    <option value="salida">Salida</option>
                    <option value="recepcion">Recepcion</option>
                </select>
            </div>
            <div class="container-input-order" style="display:none" id="salida">
                <label for="fecha-salida">Fecha de Salida</label>
                <input type="datetime-local" name="fecha_salida" id="fecha-salida">
            </div>
            <div class="container-input-order" style="display:none" id="retorno">
                <label for="fecha-retorno">Fecha de Retorno</label>
                <input type="datetime-local" name="fecha_retorno" id="fecha-retorno">
            </div>
                

            <div class="container-input-order">
                <label for="computer">ID del Equipo : Usuario de ese equipo</label>
                <select name="equipo" id="computer">
                    <?php foreach($inventario as $inv): ?>
                        <option value="<?php echo $inv->nombre_equipo ?>"><?php echo $inv->nombre_equipo . " : " . $inv->nombre . " " . $inv->apellido ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="container-input-order">
                <label for="nombre">Persona a asignar el equipo</label>
                <select name="nombre" id="nombre">
                    <?php foreach($inventario as $inv): ?>
                        <option value="<?php echo $inv->nombre . " " . $inv->apellido ?>"><?php echo $inv->nombre . " " . $inv->apellido ?></option>
                    <?php endforeach ?>
                        <option value="other">OTRO</option>
                </select>

            </div>

            <div class="container-input-order" style="display:none" id="container-othername">
                <label for="otroNombre">Nombre</label>
                <input type="text" name="nombre" id="otroNombre" disabled>
            </div>
                        
            <div class="container-input-order">
                <label for="comentarios">Comentarios</label>
                <textarea name="observaciones" id="comentarios"></textarea>
            </div>


            <input type="submit" class="boton-morado-inline" value="Enviar Orden">



</form>