
<?php if(!empty($errores)){ ?>
            <?php foreach($errores as $error){ ?>
                <p class="alerta error"><?php echo $error ?></p>
            <?php } ?>
<?php } ?>
<main class="contenedor-perfil">


    <div class="modal modal-solicitud dragable" style="display: none;">
        <h3 class="subtitle">Solicitud</h3>

        <form method="post" class="formulario-modal">
                <div class="container-inputs">
                    <div class="container-input">
                        <label for="fecha-salida">Fecha de Salida</label>
                        <input type="datetime-local" name="ordenes[fecha_salida]" id="fecha-salida">
                    </div>
                    <div class="container-input">
                        <label for="fecha-retorno">Fecha de Retorno</label>
                        <input type="datetime-local" name="ordenes[fecha_retorno]" id="fecha-retorno">
                    </div>
                </div>
                <div class="container-input">
                    <label for="equipo">Equipo</label>
                    <select name="ordenes[equipo]" id="equipo">
                        <?php foreach($equipos as $equipo){ ?>
                            <option value="<?php echo $equipo->nombre_equipo ?>"><?php echo $equipo->nombre_equipo ?> : <?php echo $equipo->tipo  ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="container-input">
                    <label for="descripcion">Motivo de la Solicitud</label>
                    <textarea name="ordenes[descripcion]" id="descripcion"></textarea>

                </div>

                
            <div class="container-actions">
                <button type="submit" class="boton-morado-inline">Enviar</button>
                <button type="button" class="boton-rojo-inline close-modal">Cancelar</button>
            </div>

        </form>

    </div>
    

        <aside class="sidebar">
            
        <img src="<?php echo $_SESSION["picture"] ?>" class="profile-image" alt="">
        <?php foreach($equipos as $equipo): ?>
                <?php if(!isset($times)): ?>
                    <h2>Nombre</h2>
                    <p><?php echo s($equipo->nombre . " " . $equipo->apellido) ?></p>
                    <h2>Documento</h2>
                    <p><?php echo s($equipo->tipo_documento . " " . $equipo->documento) ?></p>
                    <h2>Correo</h2>
                    <p><?php echo s(strtoupper($equipo->correo)) ?></p>
                    <h2>Telefono</h2>
                    <p><?php echo s(strtoupper($equipo->telefono)) ?></p>
                <?php endif ?>
                <?php $times = 1 ?>
        <?php endforeach ?>
        
        <button class="boton-morado-inline modal-button hidden">Solicitar Orden de Salida</button>

    </aside>

    <?php foreach($equipos as $equipo): ?>
        <div class="machine">
                    <h2><?php echo $equipo->tipo ?></h2>

                    <div class="title">
                        <h3>Marca</h3>
                        <p><?php echo $equipo->marca ?></p>
                    </div>
                    <div class="title">
                        <h3>Modelo</h3>
                        <p><?php echo $equipo->modelo ?></p>
                    </div>
                    <div class="title">
                        <h3>Color</h3>
                        <p><?php echo $equipo->color ?></p>
                    </div>
                    <div class="title">
                        <h3>Nombre del equipo</h3>
                        <p><?php echo $equipo->nombre_equipo ?></p>
                    </div>
                    <div class="title">
                        <h3>Serial</h3>
                        <p><?php echo $equipo->serial ?></p>
                    </div>
        </div>
    <?php endforeach ?>
    <?php foreach ($perifericos as $periferico) { ?>
        <?php foreach($periferico as $per): ?>
            <div class="<?php echo strtolower($per->tipo) ?> periferico">
                <h2><?php echo $per->tipo ?></h2>
                    <div class="title">
                        <h3>Marca</h3>
                        <p><?php echo $per->marca ?></p>
                    </div>
                    <div class="title">
                        <h3>Modelo</h3>
                        <p><?php echo $per->modelo ?></p>
                    </div>
                    <div class="title">
                        <h3>Color</h3>
                        <p><?php echo $per->color ?></p>
                    </div>
                    <div class="title">
                        <h3>Serial</h3>
                        <p><?php echo $per->serial ?></p>
                    </div>
            </div>
        <?php endforeach ?>
            
    <?php } ?>



</main>


