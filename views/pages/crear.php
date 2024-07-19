<h1>Crear</h1>



<?php foreach($errores as $error): ?>
            <p class="alerta error"><?php echo $error ?></p>

<?php endforeach ?>


<?php if(!$selectedCat){ ?>
    <a href="/" class="boton-morado-inline">Volver</a>

    
    <div class="container-categories">

    <?php foreach ($cats as $cat):?>
            <?php $limite = 3?>
            <div class="categories-selected seccion">
                <a class="boton-azul-block" href="?cat=<?php echo $cat ?>"><?php echo $cat ?></a>
                <p>Casos relacionados:</p>
                <?php foreach($allsubcats as $subcat){ ?>
                        <?php if($limite === 0) break ?>
                        <?php if($subcat->subcategoria === "Otro...") continue;?>
                        <?php if ($subcat->categoria === $cat) { ?>
                            <li><?php echo $subcat->subcategoria; ?></li>
                        <?php $limite--; }?>
                <?php } ?>
            </div>
    <?php endforeach ?>
    </div>


<?php } else if(in_array($selectedCat,$cats)){  ?>

    <div class="container-create">
        <div class="info">
            <h2>Creando un Ticket</h2>

            <ul>
                <li>1. Selecciona el asunto que encaje con el problema de tu equipo</li>
                <li>2. Coloca una breve descripcion sobre la falla que este presenta</li>
                <li>3. En caso de ser necesario el formulario solicita tu numero de anydesk para conexion remota</li>
                <li>4. Luego de la descripcion puedes colocar una imagen de referencia como un dato opcional a conectar</li>
                <li>5. Cuando se envia el ticket te llegará un correo a ti con la confirmacion de que se ha creado y un correo al departamento de A.T.I</li>
            </ul>
        </div>
        <form action="/tickets/crear" method="post" enctype = "multipart/form-data" class="formulario" id="tik-form"> 
            <input type="hidden" value="<?php echo $selectedCat ?>" name="tickets[categoria]">
            <div class="container-formulario-casos">
                <fieldset class="usuario">
                    <legend>Datos del Usuario</legend>
                    <label for="nombre">Nombre</label>
                    <input type="text" id="nombre" placeholder="Tu Nombre" name = "tickets[usuario]" value = "<?php echo $_SESSION["name"] ?>" disabled>
                </fieldset>
                <fieldset class="general">
                    <legend>Informacion General</legend>

                        <label for="subcategoria">Asunto</label>
                        <select name="tickets[subcategoria]" id="subcategoria">
                            <?php foreach($subcats as $subcat){ ?>
                                <option value="<?php echo s($subcat->subcategoria) ?>"><?php echo s($subcat->subcategoria)?></option>
                            <?php } ?>
                        </select>
                        <?php if($selectedCat === "Aplicaciones"): ?>
                            <label for="apps">Aplicacion</label>
                            <select id="apps" name="tickets[selected_app]">
                                <?php foreach($apps as $app):?>
                                    <option value="<?php echo $app->app ?>"><?php echo $app->app ?></option>
                                <?php endforeach ?>
                            </select>
                        <?php endif?>
                        <label for="otro"></label>
                        <input id="otro" type="text" placeholder="">
                        <label for="descripcion">Descripcion</label>
                        <textarea name="tickets[descripcion]" id="descripcion"></textarea>
                        <?php if($selectedCat === "Aplicaciones"):?>
                            <label for="anydesk">AnyDesk</label>
                            <input type="text" id="anydesk" name="tickets[anydesk]">
                        <?php endif ?>

                </fieldset>

                <fieldset>
                        <legend>Referencias</legend>
                        <label for="imagen">Referencias del Ticket</label>
                        <input type="file" id="imagen" name="tickets[imagen]" accept="image/jpeg , image/png">
                </fieldset>
                <input type="submit" value="Enviar Ticket" class="boton-morado-block">

            </div>
        </form>


    </div>
    


<?php }
    else { 
    
        header("Location: /");
    
    
}?>