   <h1 class="title">Generar Orden</h1>
   
   <form method="get" class="order-type-form">

      <fieldset class="container-flex no-fieldset container-flex--wrap">

         <legend>Tipo de Orden</legend>

         <label for="entrega" class="radio-label-card">
            <input type="radio" name="type" id="entrega" value="entrega" <?php echo ($_GET["type"] === "entrega") ? "checked" : "" ?>>
            <i class="bi bi-person-fill-add"></i>
            <span>Entrega</span>
         </label>

         <label for="salida" class="radio-label-card">
            <input type="radio" name="type" id="salida" value="salida" <?php echo ($_GET["type"] === "salida") ? "checked" : "" ?>>
            <i class="bi bi-house-up-fill"></i>
            <span>Salida</span>
         </label>

         <label for="recepcion" class="radio-label-card">
            <input type="radio" name="type" id="recepcion" value="recepcion" <?php echo ($_GET["type"] === "recepcion") ? "checked" : "" ?>>
            <i class="bi bi-person-fill-dash"></i>
            <span>Recepcion</span>
         </label>

      </fieldset>
   </form>
   <br>

   <form method="post" class="ord-form container-grid">

      <?php if ($_GET["type"]) { ?>



         <?php include "forms/" . $_GET["type"] . ".php" ?>


         <?php foreach ($_GET as $key => $value) { ?>
            <input type="hidden" name="<?php echo $key ?>" value="<?php echo $value ?>">
         <?php } ?>



      <?php } ?>

      <div class="container-grid">
         <fieldset class="no-fieldset container-flex container-flex--wrap per-entries">

            <legend>Informacion de Perifericos</legend>

            <fieldset class="per-entry container-input">

               <legend>Mouse</legend>
               <label for="no-mouse" class="checkbox-group">
                  <input type="checkbox" id="no-mouse" class="dsb-check" checked>
                  <span>No lleva mouse</span>
               </label>

               <label for="mouse-marca" class="input-group">
                  <span>Marca</span>
                  <input type="text" name="mouse[marca]" id="mouse-marca" disabled>
               </label>

               <label for="mouse-modelo" class="input-group">
                  <span>Modelo</span>
                  <input type="text" name="mouse[modelo]" id="mouse-modelo" disabled>
               </label>

               <label for="mouse-serial" class="input-group">
                  <span>Serial</span>
                  <input type="text" name="mouse[serial]" id="mouse-serial" disabled>
               </label>



            </fieldset>

            <fieldset class="per-entry container-input">

               <legend>Diademas</legend>

               <label for="no-diademas" class="checkbox-group">
                  <input type="checkbox" id="no-diademas" class="dsb-check" checked>
                  <span>No lleva diademas</span>
               </label>

               <label for="diadema-marca" class="input-group">
                  <span>Marca</span>
                  <input type="text" name="diademas[marca]" id="diademas-marca" disabled>
               </label>

               <label for="diadema-modelo" class="input-group">
                  <span>Modelo</span>
                  <input type="text" name="diademas[modelo]" id="diademas-modelo" disabled>
               </label>

               <label for="diadema-serial" class="input-group">
                  <span>Serial</span>
                  <input type="text" name="diademas[serial]" id="diademas-serial" disabled>
               </label>



            </fieldset>









         </fieldset>



         <fieldset class="no-fieldset container-flex per-entries">

            <legend>Informacion de Perifericos #2</legend>

            <fieldset class="per-entry container-input">

               <legend>Teclado</legend>

               <label for="no-teclado" class="checkbox-group">
                  <input type="checkbox" id="no-teclado" class="dsb-check" checked>
                  <span>No lleva teclado</span>
               </label>

               <label for="teclado-marca" class="input-group">
                  <span>Marca</span>
                  <input type="text" name="teclado[marca]" id="teclado-marca" disabled>
               </label>

               <label for="teclado-modelo" class="input-group">
                  <span>Modelo</span>
                  <input type="text" name="teclado[modelo]" id="teclado-modelo" disabled>
               </label>

               <label for="teclado-serial" class="input-group">
                  <span>Serial</span>
                  <input type="text" name="teclado[serial]" id="teclado-serial" disabled>
               </label>



            </fieldset>

            <fieldset class="per-entry container-input">

               <legend>Monitor</legend>

               <label for="no-monitor-1" class="checkbox-group">
                  <input type="checkbox" id="no-monitor-1" class="dsb-check" checked>
                  <span>No lleva monitor</span>
               </label>

               <label for="monitor-1-marca" class="input-group">
                  <span>Marca</span>
                  <input type="text" name="monitor[marca]" id="monitor-1-marca" disabled>
               </label>

               <label for="monitor-1-modelo" class="input-group">
                  <span>Modelo</span>
                  <input type="text" name="monitor[modelo]" id="monitor-1-modelo" disabled>
               </label>

               <label for="monitor-1-serial" class="input-group">
                  <span>Serial</span>
                  <input type="text" name="monitor[serial]" id="monitor-1-serial" disabled>
               </label>



            </fieldset>

            <fieldset class="per-entry container-input">

               <legend>Monitor #2</legend>

               <label for="no-monitor-2" class="checkbox-group">
                  <input type="checkbox" id="no-monitor-2" class="dsb-check" checked>
                  <span>No lleva 2do monitor</span>
               </label>

               <label for="monitor-2-marca" class="input-group">
                  <span>Marca</span>
                  <input type="text" name="monitor-2[marca]" id="monitor-2-marca" disabled>
               </label>

               <label for="monitor-modelo" class="input-group">
                  <span>Modelo</span>
                  <input type="text" name="monitor-2[modelo]" id="monitor-2-modelo" disabled>
               </label>

               <label for="monitor-serial" class="input-group">
                  <span>Serial</span>
                  <input type="text" name="monitor-2[serial]" id="monitor-2-serial" disabled>
               </label>



            </fieldset>









         </fieldset>
      </div>

      <button class="btn primary-btn">Generar Orden <i class="bi bi-file-earmark-post-fill"></i></button>



   </form>