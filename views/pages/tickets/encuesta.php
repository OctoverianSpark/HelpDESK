<?php
    
    if($encuesta->estado==="completado"){
        header("Location: /");
    }else if($encuesta->estado==="vencido"){
        header("Location: /");
    }

?>


<main>



    <h1 class="title">Encuesta de Satisfaccion</h1>


    <form method="post" class="form-poll">

        <input type="hidden" name="encuesta[id]" value="<?php echo $encuesta->id ?>">
        
        <div class="container-promedial">
                <p class="subtitle">Promedio</p>
                <p class="promedial">3</p>
                <input type="hidden" id="promedial" name="encuesta[promedio]" value="3"/>
        </div>
    
        <fieldset>
            <legend>Datos del Ticket</legend>
            <h4><span>Fecha de Creacion</span> <?php echo $ticket->fecha ?></h4>
            <h4><span>ID del Ticket Referenciado</span> <?php echo $ticket->id ?></h4>
            <h4><span>Categoria</span> <?php echo $ticket->categoria ?></h4>
            <h4><span>Asunto </span><?php echo $ticket->subcategoria ?></h4>
            <h4><span>Tecnico Asignado</span> <?php echo $ticket->tecnico ?></h4>
            <h4><span>Descripcion</span></h4>
            <h4><?php echo $ticket->descripcion ?></h4>
        </fieldset>

        <fieldset class="container-inputs-poll">
            <legend>Encuesta de Satisfacción</legend>
            <div class="container-poll-input" id="container-resol">
                <label for="resol">Resolucion que tuvo el Tecnico</label>
                <input type="range" name="encuesta[resolucion]" id="resol" min="1" max="5">
                <span class="resol-value results-span"></span>
            </div>
            <div class="container-poll-input" id="container-asert">
                <label for="asert">Asertividad del Tecnico</label>
                <input type="range" name="encuesta[asertividad]" id="asert" min="1" max="5">
                <span class="asert-value results-span"></span>
            </div>
            <div class="container-poll-input" id="container-rap">
                <label for="rap">Rapidez de la Atención</label>
                <input type="range" name="encuesta[rapidez]" id="rap" min="1" max="5">
                <span class="rap-value results-span"></span>
            </div>
            <div class="container-poll-input" id="container-qa">
                <label for="qa">Calidad de la Atención</label>
                <input type="range" name="encuesta[calidad]" id="qa" min="1" max="5">
                <span class="qa-value results-span"></span>
            </div>
            <div class="container-poll-input" id="container-qa">
                <label for="comments">Comentarios</label>
                <textarea name="encuesta[comentarios]" placeholder="Describe comentarios sobre la asistencia recibida..." id="comments"></textarea>
            </div>

            <input type="submit" value="Enviar Encuesta" class="boton-morado-inline">
        </fieldset>



    </form>

</main>