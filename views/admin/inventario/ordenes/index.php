<h1 class='title'>Ordenes</h1>
   <form method="GET" class="search-form">

      <fieldset class="no-fieldset container-input-flex">
         <legend>Filtros de Busqueda</legend>



         <label for="col" class="input-group">

            <span>Columna</span>

            <select name="col" id="col">
               <option value="order_id">Orden</option>
               <option value="nombre">Nombre de Usuario</option>
               <option value="nombre_equipo">Nombre del computador</option>
               <option value="state">Estado</option>
            </select>




         </label>



         <label for="val" class="input-group">

            <span>Valor</span>
            <input type="text" name="val" id="val">




         </label>






      </fieldset>

   </form>


   <div class="table-wrapper">

      <div class="table">


         <div class="table-row table-header">

            <div class="header">Orden</div>
            <div class="header">Usuario</div>
            <div class="header">Computador</div>
            <div class="header">Fecha de Emision</div>
            <div class="header">Fecha de Retorno</div>
            <div class="header">Estado</div>

         </div>

         <?php foreach ($orders as $order) { ?>

            <div class="table-row" order-id="<?php echo $order->id ?>">
               <div class="cell" col="order_id">
                  <?php echo $order->order_id ?>
               </div>
               <div class="cell" col="nombre">
                  <?php echo $order->nombre . " " . $order->apellido ?>
               </div>
               <div class="cell" col="nombre_equipo">
                  <?php echo $order->nombre_equipo ?>
               </div>
               <div class="cell">
                  <?php echo $order->emitted_date ?>
               </div>
               <div class="cell">
                  <?php echo $order->return_date ?>
               </div>
               <div class="cell" col="state">
                  <?php echo $order->state ?>
               </div>
            </div>
         <?php } ?>




      </div>
   </div>


