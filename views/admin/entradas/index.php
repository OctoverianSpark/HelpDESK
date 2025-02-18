<main class="contenedor-entradas">


    <div class="modal entry-form hidden">


        <form method="POST">
            <input type="hidden" name="id" value="">
            <fieldset class="container-input-flex no-fieldset">

                <legend>Tipo de Entrada</legend>

                <label for="recommendation" class="radio-label-card">
                    <input type="radio" name="tipo" id="recommendation" value="recomendacion" required>
                    <i class="bi bi-info-circle-fill"></i>
                    <span>Recomendacion</span>
                </label>
                <label for="noveltie" class="radio-label-card">
                    <input type="radio" name="tipo" id="noveltie" value="novedad" required>
                    <i class="bi bi-chat-left-dots-fill"></i>
                    <span>Novedad</span>
                </label>


            </fieldset>

            <label for="title" class="input-group">
                <span>Titulo</span>
                <input type="text" name="titulo" id="title" required>

            </label>
            <label for="content" class="input-group">
                <span>Contenido</span>
                <textarea type="text" name="contenido" id="content" required></textarea>

            </label>

            <button class="btn btn-submit" type="submit">Cargar entrada <i class="bi bi-arrow-up"></i></button>

        </form>



    </div>







    <h1 class="title">Administrar Entradas</h1>



    
    <button class="add-entry-btn btn btn-entries">Añadir Entrada <i class="bi bi-plus-circle"></i></button>

    <div class="container-legend">
        <div class="lgnd">
            <span class="colored-blue"></span>
            <p>Mostrar</p>
        </div>
        <div class="lgnd">
            <span class="colored-white"></span>
            <p>No mostrar</p>
        </div>
    </div>


    <div class="entries">


        <?php foreach ($entradas as $entrada) { ?>



            <label for="option-<?php echo $entrada->id ?>" class="checkbox-card">

                <div class="container-flex">
                    <button data-id="<?php echo $entrada->id ?>" class="cell-btn update-entry-btn btn" title="Actualizar"><i class="bi bi-pencil-fill"></i></button>
                    <button data-id="<?php echo $entrada->id ?>" class="cell-btn delete-entry-btn btn" title="Eliminar"><i class="bi bi-trash-fill"></i></button>
                </div>
                <input type="checkbox" name="show" value="<?php echo $entrada->id ?>" id="option-<?php echo $entrada->id ?>" <?php echo (strtolower($entrada->mostrar) === "si") ? "checked" : "" ?>>
                <div class="entry">
                    <h4><?php echo $entrada->fecha ?></h4>
                    <p><?php echo $entrada->tipo ?></p>
                    <h4><?php echo $entrada->titulo ?></h4>
                    <p><?php echo $entrada->contenido ?></p>

                </div>
            </label>

        <?php } ?>

    </div>







</main>