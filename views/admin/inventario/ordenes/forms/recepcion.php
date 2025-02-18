<fieldset class="selector-wrapper no-fieldset">
   <legend>Usuario del equipo</legend>

   <label class="label-search-input" for="search">
      <div class="search">
         <i class="bi bi-search"></i>
         <input type="text" id="search" placeholder="Busca al usuario..." class="filter" autocomplete="off" required>
      </div>
   </label>
   <ul class="options">

      <?php foreach ($users as $usr) { ?>
         <label for="user-option-<?php echo $usr->id ?>" class="option">
            <input type="radio" name="user_id" value="<?php echo $usr->id ?>" id="user-option-<?php echo $usr->id ?>" <?php echo ($usr->id == $inv->user_id) ? "checked" : "" ?>>
            <span><?php echo "$usr->nombre $usr->apellido" ?></span>
         </label>
      <?php } ?>

   </ul>


</fieldset>


<fieldset class="selector-wrapper no-fieldset">
   <legend>Computador</legend>

   <label class="label-search-input" for="search">
      <div class="search">
         <i class="bi bi-search"></i>
         <input type="text" id="search" placeholder="Computador" class="filter" name="" autocomplete="off" required>
      </div>
   </label>
   <ul class="options">
      <label for="same-computer" class="option">
         <input type="radio" name="computer" id="same-computer" value="same">
         <span>MISMO EQUIPO DEL USUARIO</span>
      </label>
      <?php foreach ($inv as $eq) { ?>
         <label for="computer-option-<?php echo $eq->id ?>" class="option">
            <input computer-id="<?php echo $eq->id ?>" type="radio" name="computer_id" id="computer-option-<?php echo $eq->id ?>" value="<?php echo $eq->id ?>">
            <span title="Este computador pertenece a: <?php echo $eq->nombre . " " . $eq->apellido ?> "><?php echo $eq->nombre_equipo ?> : <?php echo $eq->nombre . " " . $eq->apellido ?></span>
         </label>
      <?php } ?>

   </ul>



</fieldset>

<label for="emission-date" class="input-group">
         <span>Fecha de Emision</span>
         <input type="date" name="emitted-date" id="emission-date" required>
</label>
