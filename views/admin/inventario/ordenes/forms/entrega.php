<label for="user_id" class="input-group">
   <span>Usuario</span>
   <select name="user_id" id="user_id
">
      <?php foreach ($users as $user) { ?>

         <option value="<?php echo $user->id ?>"><?php echo $user->first_name . ' ' . $user->last_name ?></option>
      <?php } ?>

   </select>

</label>

<label for="computer_id" class="input-group">
   <span>Computador</span>
   <select name="computer_id" id="computer_id">
      <?php foreach ($inv as $eq) { ?>
         <option value="<?php echo $eq->id ?>"><?php echo $eq->nombre_equipo ?>:<?php echo $eq->nombre ?></option>
      <?php } ?>
   </select>
</label>

<label for="emission-date" class="input-group">
   <span>Fecha de Emision</span>
   <input type="date" name="emitted_date" id="emission-date" required>
</label>


<fieldset class="checklist-entries container-flex no-fieldset">


   <legend>Checklist de Caracteristicas</legend>


   <div class="container-input">
      <?php spawnCheckbox("check-0", "features", "NAVEGADOR(CHROME) Y POLÍTICAS DE GOOGLE CHROME", "NAVEGADOR(CHROME) Y POLÍTICAS DE GOOGLE CHROME", true) ?>
      <?php spawnCheckbox("check-1", "features", "MANUAL DE TÉRMINOS Y CONDICIONES DE USO DEL COMPUTADOR", "MANUAL DE TÉRMINOS Y CONDICIONES DE USO DEL COMPUTADOR", true) ?>
      <?php spawnCheckbox("check-2", "features", "CORREO CORPORATIVO", "CORREO CORPORATIVO", true) ?>
      <?php spawnCheckbox("check-3", "features", "CORREO ASISTENTE VIRTUAL", "CORREO ASISTENTE VIRTUAL", true) ?>
   </div>

   <div class="container-input">
      <?php spawnCheckbox("check-4", "features", "FUNCIONAMIENTO ÓPTIMO DE CARGADOR", "FUNCIONAMIENTO ÓPTIMO DE CARGADOR", true) ?>
      <?php spawnCheckbox("check-5", "features", "FUNCIONAMIENTO ÓPTIMO DE DIADEMAS", "FUNCIONAMIENTO ÓPTIMO DE DIADEMAS", true) ?>
      <?php spawnCheckbox("check-6", "features", "FUNCIONAMIENTO ÓPTIMO DEL COMPUTADOR", "FUNCIONAMIENTO ÓPTIMO DEL COMPUTADOR", true) ?>
      <?php spawnCheckbox("check-7", "features", "FUNCIONAMIENTO ÓPTIMO DE MOUSE", "FUNCIONAMIENTO ÓPTIMO DE MOUSE", true) ?>
   </div>

   <div class="container-input">
      <?php spawnCheckbox("check-8", "features", "CLASSROOM", "CLASSROOM", true) ?>
      <?php spawnCheckbox("check-9", "features", "WPS (OFFICE)", "WPS (OFFICE)", true) ?>
      <?php spawnCheckbox("check-10", "features", "GOOGLE DRIVE", "GOOGLE DRIVE", true) ?>
      <?php spawnCheckbox("check-11", "features", "CLOWDWORK", "CLOWDWORK", true) ?>
   </div>

   <div class="container-input">
      <?php spawnCheckbox("check-12", "features", "RING CENTRAL", "RING CENTRAL", true) ?>
      <?php spawnCheckbox("check-13", "features", "ANYDESK", "ANYDESK", true) ?>
      <?php spawnCheckbox("check-14", "features", "LIGHTSHOT", "LIGHTSHOT", true) ?>
      <?php spawnCheckbox("check-15", "features", "VPN", "VPN", true) ?>
   </div>



</fieldset>