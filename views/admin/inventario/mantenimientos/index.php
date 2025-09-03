<?php

use Models\Inventory;

?>

<h1 class="title">Mantenimientos</h1>


<div class="table-wrapper">

  <div class="table table-mant-admin">
    <div class="table-row table-header">
      <div class="header">Encargado</div>
      <div class="header">Ultimo</div>
      <div class="header">Siguiente</div>
      <div class="header">Computador</div>
    </div>

    <?php foreach ($agenda as $mantenimiento) { ?>

      <div class="table-row">
        <div class="cell"><?php echo $mantenimiento->tech ?></div>
        <div class="cell"><?php echo $mantenimiento->latest ?></div>
        <div class="cell"><?php echo $mantenimiento->next ?></div>
        <div class="cell"><?php echo $mantenimiento->computer ?></div>
      </div>


    <?php } ?>



  </div>
</div>