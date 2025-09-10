<h1 class="title">Mantenimientos</h1>


<div class="table-wrapper">

  <div class="table table-mant-admin">
    <div class="table-row table-header">
      <div class="header">Acciones</div>
      <div class="header">Encargado</div>
      <div class="header">Ultimo</div>
      <div class="header">Siguiente</div>
      <div class="header">Computador</div>
    </div>

    <?php foreach ($agenda as $mantenimiento) { ?>

      <div class="table-row">
        <div class="cell">
          <div class="container-flex">

            <a href="/admin/mantenimientos/update?id=<?php echo $mantenimiento->id ?>" class="cell-btn" title="Actualizar"><i class="bi bi-pencil-fill"></i></a>
            <form method="POST" class="cell-btn">
              <input type="hidden" name="id" value="<?php echo $mantenimiento->id ?>">
              <button type="submit" class="cell-btn" title="Eliminar"><i class="bi bi-trash-fill"></i></button>
            </form>
          </div>
        </div>
        <div class="cell"><?php echo $mantenimiento->tech ?></div>
        <div class="cell"><?php echo $mantenimiento->latest ?></div>
        <div class="cell"><?php echo $mantenimiento->next ?></div>
        <div class="cell"><?php echo $mantenimiento->computer ?></div>
      </div>


    <?php } ?>



  </div>
</div>