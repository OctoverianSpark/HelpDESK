<h1 class="title">Control de Agentes</h1>


<button class="btn primary-btn" id="open-agent-creator">Agregar agente</button>



<div class="modal agent-modal">


  <form method="post">
    <input type="hidden" name="action" value="new">
    <label for="name" class="input-group">
      <span>Nombre del Agente</span>
      <input type="text" name="name" id="name">
    </label>

    <button type="submit" class="btn primary-btn">Cargar</button>

  </form>

</div>



<div class="table-wrapper">
  <div class="table">
    <div class="table-header table-row">
      <div class="header">Acciones</div>
      <div class="header">Nombre</div>
    </div>

    <?php foreach ($agents as $agent) { ?>
      <div class="table-row">
        <div class="cell">
          <div class="container-flex">
            <form method="post">
              <input type="hidden" name="action" value="delete">
              <input type="hidden" name="id" value="<?php echo $agent->id ?>">
              <button type="submit" class="cell-btn"><i class="bi bi-trash-fill"></i></button>
            </form>
            <button type="button" cell-id='<?php echo $agent->id ?>' class="cell-btn update-agent-btn"><i class="bi bi-pencil-fill"></i></button>
          </div>
        </div>
        <div class="cell"><?php echo $agent->name ?></div>
      </div>
    <?php } ?>
  </div>
</div>