<fieldset class="container-grid-selector no-fieldset">

   <legend>Solicitudes pendientes</legend>


   <?php foreach ($orders as $order) { ?>

      <label for="radio-<?php echo $order->id ?>" class="radio-label-card">
         <input computer-id="<?php echo $order->computer_id ?>" type="radio" name="order_id" id="radio-<?php echo $order->id ?>" value="<?php echo $order->order_id ?>">
         <span class="data-id" title="ID de peticion"><?php echo $order->order_id  ?></span>
         <span class="data-emit-date" title="Emision"><?php echo date("d / m / Y", strtotime($order->emitted_date)) ?></span>
         <span class="data-return-date" title="Retorno"><?php echo (strtolower($order->return_date) === "no return")?"Sin Retorno":date("d / m / Y", strtotime($order->return_date)) ?></span>
         <span class="data-name"><?php echo s($order->nombre . ' ' . $order->apellido) ?></span>
      </label>

   <?php } ?>









</fieldset>




