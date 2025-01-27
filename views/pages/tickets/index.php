<main class="contenedor-data">

    <h1 class="title">Mis Tickets</h1>

    <div class="table-wrapper">


        <div class="table">


            <div class="table-row table-header">
                <div class="header">Creado El</div>
                <div class="header">Descripcion</div>
                <div class="header">Estado</div>
                <div class="header">Tecnico Asignado</div>
            </div>

            <?php foreach ($tickets as $ticket) { ?>

                <div class="table-row">
                    <div class="cell"><?php echo $ticket->fecha ?></div>
                    <div class="cell"><?php echo $ticket->descripcion ?></div>
                    <div class="cell"><?php echo $ticket->estado ?></div>
                    <div class="cell"><?php echo $ticket->tecnico ?></div>
                </div>

            <?php } ?>

        </div>
    </div>




</main>