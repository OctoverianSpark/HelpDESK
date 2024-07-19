

<fieldset class="entryFields">
    <input type="hidden" name="entrada[id]" value="<?php echo s($entrada->id??null) ?>">
    <input type="hidden" name="entrada[tipo]" value="<?php echo s($_GET["type"] ?? $entrada->tipo) ?>">

    <div class="container-input-entry">
        <label for="title">Titulo de la Entrada</label>
        <input type="text" id="title" name="entrada[titulo]" value="<?php echo $entrada->titulo ?>">
    </div>

    <div class="container-input-entry">
        <label for="content">Contenido</label>
        <textarea name="entrada[contenido]" id="content"><?php echo $entrada->contenido ?></textarea>
    </div>
    <div class="container-input-entry">
        <label for="image">Imagen</label>
        <input type="file" id="imagen" name="entrada[imagen]" accept="image/jpeg , image/png">
    </div>

    <?php if(isset($entrada->imagen)){ ?>
        <picture>
            <source srcset="/blog/<?php echo $entrada->imagen ?>.webp">
            <img src="/blog/<?php echo $entrada->imagen ?>.png"alt="">
        </picture>
    <?php } ?>

</fieldset>