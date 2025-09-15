<h1>Tickets de Agentes</h1>






<div class="table-wrapper">

  <div class="table">

    <div class="table-row table-header">
      <div class="header">Acciones</div>
      <div class="header">Fecha</div>
      <div class="header">Agente</div>
      <div class="header">Subcategoria</div>
      <div class="header">Estado</div>
      <div class="header">Tecnico</div>
    </div>


    <?php foreach ($tickets as $ticket) { ?>


      <div class="table-row">
        <div class="cell">
          <a href="/admin/agents/tickets/update?id=<?php echo $ticket->id ?>"><i class="bi bi-pencil-fill"></i></a>
        </div>
        <div class="cell"><?php echo $ticket->fecha ?></div>
        <div class="cell"><?php echo $ticket->name ?></div>
        <div class="cell"><?php echo $ticket->subcategoria ?></div>
        <div class="cell"><?php echo $ticket->estado ?></div>
        <div class="cell"><?php echo $ticket->tecnico ?></div>
      </div>


    <?php } ?>



  </div>
</div>