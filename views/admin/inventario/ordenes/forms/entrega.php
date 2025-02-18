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
            <input type="radio" name="user_id" value="<?php echo $usr->id ?>" id="usr-option-<?php echo $usr->id ?>" <?php echo ($usr->id == $inv->user_id) ? "checked" : "" ?>>
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
            <input computer-id="<?php echo $eq->id ?>" type="radio" name="computer_id" id="computer-option-<?php echo $eq->id ?>" value="<?php echo $eq->id ?>">
            <span title="Este computador pertenece a: <?php echo $eq->nombre . " " . $eq->apellido ?> "><?php echo $eq->nombre_equipo ?> : <?php echo $eq->nombre . " " . $eq->apellido ?></span>
         </label>
      <?php } ?>

   </ul>



</fieldset>

<label for="emission-date" class="input-group">
   <span>Fecha de Emision</span>
   <input type="date" name="emitted_date" id="emission-date" required>
</label>


<fieldset class="checklist-entries container-input-flex no-fieldset">


   <legend>Checklist de Caracteristicas</legend>



   <div class="container-input">

      <?php spawnCheckbox("check-0", "features","chrome-policies", "NAVEGADOR(CHROME) Y POLÍTICAS DE GOOGLE CHROME", false) ?>
      <?php spawnCheckbox("check-1", "features", "terms-manual", "MANUAL DE TÉRMINOS Y CONDICIONES DE USO DEL COMPUTADOR", false) ?>
      <?php spawnCheckbox("check-2", "features", "corporate-email", "CORREO CORPORATIVO", false) ?>
      <?php spawnCheckbox("check-3", "features", "assistant-email","CORREO ASISTENTE VIRTUAL", false) ?>

   </div>


   <div class="container-input">


      <?php spawnCheckbox("check-4", "features", "optimal-charger", "FUNCIONAMIENTO ÓPTIMO DE CARGADOR", false) ?>
      <?php spawnCheckbox("check-5", "features", "optimal-headset", "FUNCIONAMIENTO ÓPTIMO DE DIADEMAS", false) ?>
      <?php spawnCheckbox("check-6", "features", "optimal-computer", "FUNCIONAMIENTO ÓPTIMO DEL COMPUTADOR", false) ?>
      <?php spawnCheckbox("check-7", "features", "optimal-mouse", "FUNCIONAMIENTO ÓPTIMO DE MOUSE", false) ?>

      
   </div>
   <div class="container-input">



      <?php spawnCheckbox("check-8", "features", "classroom", "CLASSROOM", false) ?>
      <?php spawnCheckbox("check-9", "features", "wps", "WPS (OFFICE)", false) ?>
      <?php spawnCheckbox("check-10", "features", "google-drive", "GOOGLE DRIVE", false) ?>

      <?php spawnCheckbox("check-11", "features", "clowdwork", "CLOWDWORK", false) ?>



   </div>
   <div class="container-input">



      <?php spawnCheckbox("check-12", "features", "ring-central", "RING CENTRAL", false) ?>
      <?php spawnCheckbox("check-13", "features", "anydesk", "ANYDESK", false) ?>
      <?php spawnCheckbox("check-14", "features", "lightshot", "LIGHTSHOT", false) ?>

      <?php spawnCheckbox("check-15", "features", "vpn", "VPN", false) ?>



   </div>


</fieldset>

