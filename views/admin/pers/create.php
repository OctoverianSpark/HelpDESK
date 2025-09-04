<form method="post" class="container-grid">
  <input type="hidden" name="perifericos[<?php echo $i - 1 ?>][id]" value="<?php echo $per->id ?>">
  <div class="container-flex">
    <label for="mouse-<?php echo $i; ?>" class="radio-label-card">
      <input name="tipo" id="mouse-<?php echo $i; ?>" type="radio" value="mouse" <?php echo ($per->tipo == "MOUSE") ? "checked" : ""; ?>>
      <i class="bi bi-mouse-fill"></i>
      <span>Mouse</span>
    </label>
    <label for="teclado-<?php echo $i; ?>" class="radio-label-card">
      <input name="tipo" id="teclado-<?php echo $i; ?>" type="radio" value="teclado" <?php echo ($per->tipo == "TECLADO") ? "checked" : ""; ?>>
      <i class="bi bi-keyboard-fill"></i>
      <span>Teclado</span>
    </label>
    <label for="audifono-<?php echo $i; ?>" class="radio-label-card">
      <input name="tipo" id="audifono-<?php echo $i; ?>" type="radio" value="diademas" <?php echo ($per->tipo == "DIADEMAS") ? "checked" : ""; ?>>
      <i class="bi bi-headphones"></i>
      <span>Audifonos</span>
    </label>
    <label for="monitor-<?php echo $i; ?>" class="radio-label-card">
      <input name="tipo" id="monitor-<?php echo $i; ?>" type="radio" value="monitor" <?php echo ($per->tipo == "MONITOR") ? "checked" : ""; ?>>
      <i class="bi bi-display"></i>
      <span>Monitor</span>
    </label>
    <label for="adaptador-<?php echo $i; ?>" class="radio-label-card">
      <input name="tipo" id="adaptador-<?php echo $i; ?>" type="radio" value="adaptador" <?php echo ($per->tipo == "ADAPTADOR") ? "checked" : ""; ?>>
      <i class="bi bi-usb-symbol"></i>
      <span>Adaptador</span>
    </label>
    <label for="camara-<?php echo $i; ?>" class="radio-label-card">
      <input name="perifericos[<?php echo $i - 1; ?>][tipo]" id="camara-<?php echo $i; ?>" type="radio" value="camara" <?php echo ($per->tipo == "CAMARA") ? "checked" : ""; ?>>
      <i class="bi bi-webcam-fill"></i>
      <span>Camara</span>
    </label>
  </div>
  <div class="container-flex">

    <label for="marca" class="input-group">
      <span>Marca</span>
      <input id="marca" type="text" placeholder="GENIUS,LENOVO, SAMSUNG...." name="marca" value="<?php echo $per->marca; ?>">
    </label>
    <label for="modelo" class="input-group">
      <span>Modelo</span>
      <input id="modelo" type="text" placeholder="SMU, DX-120, S2412..." name="modelo" value="<?php echo $per->modelo; ?>">
    </label>
  </div>
  <div class="container-flex">

    <label for="color" class="input-group">
      <span>Color</span>
      <input id="color" type="text" placeholder="NEGRO,ROJO , AZUL ,etc..." name="color" value="<?php echo $per->color; ?>">
    </label>
    <label for="serial" class="input-group">
      <span>Serial</span>
      <input id="serial" type="text" placeholder="EJ: BK2SD994KJS..." name="serial" value="<?php echo $per->serial; ?>">
    </label>
  </div>
  <label for="user_id" class="input-group">
    <span>Usuario</span>
    <select name="user_id" id="user_id">
      <?php foreach ($users as $user) { ?>
        <option <?php echo $user->id === $per->user_id ? 'selected' : '' ?> value="<?php echo $user->id ?>"><?php echo $user->first_name . ' ' . $user->last_name ?></option>
      <?php } ?>
    </select>
  </label>

  <br>

  <button type="submit" class="btn primary-btn">Guardar Periferico</button>




</form>