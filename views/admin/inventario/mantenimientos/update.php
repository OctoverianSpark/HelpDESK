<h1 class="title">Actualizar Mantenimiento</h1>




<form method="post" class="container-grid">

  <label for="computer" class="input-group">
    <span>Computador</span>
    <select name="computer" id="computer">
      <?php foreach ($computers as $computer) { ?>
        <option value="<?php echo $computer->id ?>" <?php echo $computer->id === $maintenance->computer ? 'selected' : '' ?>><?php echo $computer->nombre_equipo ?>: <?php echo $computer->nombre ?></option>
      <?php } ?>
    </select>
  </label>


  <label for="latest" class="input-group">
    <span>Mantenimiento Previo</span>
    <input type="date" name="latest" id="latest" value="<?php echo $maintenance->latest ?>">
  </label>

  <label for="next" class="input-group">
    <span>Siguiente Mantenimiento</span>
    <input type="date" name="next" id="next" value="<?php echo $maintenance->next ?>">
  </label>

  <label for="tech" class="input-group">
    <span>Tecnico</span>
    <select name="tech" id="tech">
      <?php foreach ($techs as $tech) { ?>
        <option value="<?php echo "$tech->first_name $tech->last_name" ?>" <?php echo "$tech->first_name $tech->last_name" === $maintenance->tech ? 'selected' : '' ?>><?php echo "$tech->first_name $tech->last_name"; ?></option>
      <?php } ?>
    </select>
  </label>


  <button type="submit" class="primary-btn btn">Cargar Mantenimiento</button>
</form>