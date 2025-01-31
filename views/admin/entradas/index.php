<main class="contenedor-entradas">


        <h1 class="title">Administrar Entradas</h1>



        <div class="entries">


            <?php foreach($entradas as $entrada){ ?>

                <div class="entry">
                    <h4><?php echo $entrada->fecha ?></h4>
                    <p><?php echo $entrada->tipo ?></p>
                    <h4><?php echo $entrada->titulo ?></h4>
                    <p><?php echo $entrada->contenido ?></p>
                    
                    <label for="check-<?php echo $entrada->id ?>" class="checkbox-group">
                        <input type="checkbox" id="check-<?php echo $entrada->id ?> <?php echo (strtolower($entrada->mostrar) == "si")?"checked":"" ?>">
                        <span>Mostrar Entrada</span>
                    </label>
                </div>

            <?php } ?>

        </div>







</main>