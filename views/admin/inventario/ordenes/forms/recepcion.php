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
   <input type="date" name="emitted-date" id="emission-date" required>
</label>