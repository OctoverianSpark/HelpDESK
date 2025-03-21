<h1 class="title">
   Revision de logs <i class="bi bi-file-earmark-text-fill"></i>
</h1>




<div class="table-wrapper">

   <div class="table">
      <div class="table-header">
         <div class="header">Fecha</div>
         <div class="header">Tipo</div>
         <div class="header">Accion</div>
         <div class="header">Descripcion</div>
         <div class="header">DATA ID</div>
      </div>
      <?php foreach ($logs as $log) { ?>

         <div class="table-row">
            <div class="cell"><?php echo $log->date ?></div>
            <div class="cell"><?php echo $log->type ?></div>
            <div class="cell"><?php echo $log->action  ?></div>
            <div class="cell"><?php echo $log->description ?></div>
            <div class="cell"><?php echo $log->data_id ?></div>
         </div>
      <?php } ?>
   </div>


</div>