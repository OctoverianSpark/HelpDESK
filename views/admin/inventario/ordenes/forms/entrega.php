<fieldset class="selector-wrapper no-fieldset">
   <legend>Usuario del equipo</legend>

   <label class="label-search-input" for="usr-search">
      <div class="search">
         <i class="bi bi-search"></i>
         <input type="text" id="usr-search" placeholder="Busca al usuario..." class="filter" autocomplete="off" required>
      </div>
   </label>
   <ul class="options">

      <?php foreach ($users as $usr) { ?>
         <label for="usr-option-<?php echo $usr->id ?>" class="option">
            <input type="radio" name="user" value="<?php echo $usr->id ?>" id="usr-option-<?php echo $usr->id ?>" <?php echo ($usr->id == $inv->user_id) ? "checked" : "" ?>>
            <span><?php echo "$usr->nombre $usr->apellido" ?></span>
         </label>
      <?php } ?>

   </ul>


</fieldset>


<fieldset class="selector-wrapper no-fieldset">
   <legend>Computador</legend>

   <label class="label-search-input" for="computer-search">
      <div class="search">
         <i class="bi bi-search"></i>
         <input type="text" id="computer-search" placeholder="Computador" class="filter" name="" autocomplete="off" required>
      </div>
   </label>
   <ul class="options">
      <?php foreach ($inv as $eq) { ?>
         <label for="computer-option-<?php echo $eq->id ?>" class="option">
            <input computer-id="<?php echo $eq->id ?>" type="radio" name="computer" id="computer-option-<?php echo $eq->id ?>" value="<?php echo $eq->id ?>">
            <span title="Este computador pertenece a: <?php echo $eq->nombre . " " . $eq->apellido ?> "><?php echo $eq->nombre_equipo ?> : <?php echo $eq->nombre . " " . $eq->apellido ?></span>
         </label>
      <?php } ?>

   </ul>



</fieldset>

<label for="emission-date" class="input-group">
   <span>Fecha de Emision</span>
   <input type="date" name="emitted-date" id="emission-date" required>
</label>


<fieldset class="no-fieldset container-input-flex per-entries">

   <legend>Informacion de Perifericos</legend>

   <fieldset class="per-entry container-input">

      <legend>Mouse</legend>

      <label for="no-mouse" class="label-checkbox">
         <input type="checkbox" id="no-mouse" class="dsb-check" checked>
         <span>No lleva mouse</span>
      </label>

      <label for="mouse-marca" class="input-group">
         <span>Marca</span>
         <input type="text" name="pers[mouse][marca]" id="mouse-marca" disabled>
      </label>

      <label for="mouse-modelo" class="input-group">
         <span>Modelo</span>
         <input type="text" name="pers[mouse][modelo]" id="mouse-modelo" disabled>
      </label>

      <label for="mouse-serial" class="input-group">
         <span>Serial</span>
         <input type="text" name="pers[mouse][serial]" id="mouse-serial" disabled>
      </label>



   </fieldset>

   <fieldset class="per-entry container-input">

      <legend>Diademas</legend>

      <label for="no-diademas" class="label-checkbox">
         <input type="checkbox" id="no-diademas" class="dsb-check" checked>
         <span>No lleva diademas</span>
      </label>

      <label for="diadema-marca" class="input-group">
         <span>Marca</span>
         <input type="text" name="pers[diadema][marca]" id="diademas-marca" disabled>
      </label>

      <label for="diadema-modelo" class="input-group">
         <span>Modelo</span>
         <input type="text" name="pers[diadema][modelo]" id="diademas-modelo" disabled>
      </label>

      <label for="diadema-serial" class="input-group">
         <span>Serial</span>
         <input type="text" name="pers[diadema][serial]" id="diademas-serial" disabled>
      </label>



   </fieldset>









</fieldset>

<fieldset class="no-fieldset container-input-flex per-entries">

   <legend>Informacion de Perifericos #2</legend>

   <fieldset class="per-entry container-input">

      <legend>Teclado</legend>

      <label for="no-teclado" class="label-checkbox">
         <input type="checkbox" id="no-teclado" class="dsb-check" checked>
         <span>No lleva teclado</span>
      </label>

      <label for="teclado-marca" class="input-group">
         <span>Marca</span>
         <input type="text" name="pers[teclado][marca]" id="teclado-marca" disabled>
      </label>

      <label for="teclado-modelo" class="input-group">
         <span>Modelo</span>
         <input type="text" name="pers[teclado][modelo]" id="teclado-modelo" disabled>
      </label>

      <label for="teclado-serial" class="input-group">
         <span>Serial</span>
         <input type="text" name="pers[teclado][serial]" id="teclado-serial" disabled>
      </label>



   </fieldset>

   <fieldset class="per-entry container-input">

      <legend>Monitor</legend>

      <label for="no-monitor-1" class="label-checkbox">
         <input type="checkbox" id="no-monitor-1" class="dsb-check" checked>
         <span>No lleva monitor</span>
      </label>

      <label for="monitor-1-marca" class="input-group">
         <span>Marca</span>
         <input type="text" name="pers[monitor][marca]" id="monitor-1-marca" disabled>
      </label>

      <label for="monitor-1-modelo" class="input-group">
         <span>Modelo</span>
         <input type="text" name="pers[monitor][modelo]" id="monitor-1-modelo" disabled>
      </label>

      <label for="monitor-1-serial" class="input-group">
         <span>Serial</span>
         <input type="text" name="pers[monitor][serial]" id="monitor-1-serial" disabled>
      </label>



   </fieldset>

   <fieldset class="per-entry container-input">

      <legend>Monitor #2</legend>

      <label for="no-monitor-2" class="label-checkbox">
         <input type="checkbox" id="no-monitor-2" class="dsb-check" checked>
         <span>No lleva 2do monitor</span>
      </label>

      <label for="monitor-2-marca" class="input-group">
         <span>Marca</span>
         <input type="text" name="pers[monitor-2][marca]" id="monitor-2-marca" disabled>
      </label>

      <label for="monitor-modelo" class="input-group">
         <span>Modelo</span>
         <input type="text" name="pers[monitor-2][modelo]" id="monitor-2-modelo" disabled>
      </label>

      <label for="monitor-serial" class="input-group">
         <span>Serial</span>
         <input type="text" name="pers[monitor-2][serial]" id="monitor-2-serial" disabled>
      </label>



   </fieldset>









</fieldset>