<form method="post">
  <input type="hidden" name="perifericos[<?php echo $i - 1 ?>][id]" value="<?php echo $per->id ?>">
  <div class="container-input-flex">
    <label for="mouse-<?php echo $i; ?>" class="radio-label-card">
      <input name="perifericos[<?php echo $i - 1; ?>][tipo]" id="mouse-<?php echo $i; ?>" type="radio" value="mouse" <?php echo ($per->tipo == "MOUSE") ? "checked" : ""; ?>>
      <i class="bi bi-mouse-fill"></i>
      <span>Mouse</span>
    </label>
    <label for="teclado-<?php echo $i; ?>" class="radio-label-card">
      <input name="perifericos[<?php echo $i - 1; ?>][tipo]" id="teclado-<?php echo $i; ?>" type="radio" value="teclado" <?php echo ($per->tipo == "TECLADO") ? "checked" : ""; ?>>
      <i class="bi bi-keyboard-fill"></i>
      <span>Teclado</span>
    </label>
    <label for="audifono-<?php echo $i; ?>" class="radio-label-card">
      <input name="perifericos[<?php echo $i - 1; ?>][tipo]" id="audifono-<?php echo $i; ?>" type="radio" value="diademas" <?php echo ($per->tipo == "DIADEMAS") ? "checked" : ""; ?>>
      <i class="bi bi-headphones"></i>
      <span>Audifonos</span>
    </label>
    <label for="monitor-<?php echo $i; ?>" class="radio-label-card">
      <input name="perifericos[<?php echo $i - 1; ?>][tipo]" id="monitor-<?php echo $i; ?>" type="radio" value="monitor" <?php echo ($per->tipo == "MONITOR") ? "checked" : ""; ?>>
      <i class="bi bi-display"></i>
      <span>Monitor</span>
    </label>
    <label for="adaptador-<?php echo $i; ?>" class="radio-label-card">
      <input name="perifericos[<?php echo $i - 1; ?>][tipo]" id="adaptador-<?php echo $i; ?>" type="radio" value="adaptador" <?php echo ($per->tipo == "ADAPTADOR") ? "checked" : ""; ?>>
      <i class="bi bi-usb-symbol"></i>
      <span>Adaptador</span>
    </label>
    <label for="camara-<?php echo $i; ?>" class="radio-label-card">
      <input name="perifericos[<?php echo $i - 1; ?>][tipo]" id="camara-<?php echo $i; ?>" type="radio" value="camara" <?php echo ($per->tipo == "CAMARA") ? "checked" : ""; ?>>
      <i class="bi bi-webcam-fill"></i>
      <span>Camara</span>
    </label>
  </div>
  <div class="container-input-flex">

    <label for="marca" class="input-group">
      <span>Marca</span>
      <input id="marca" type="text" placeholder="GENIUS,LENOVO, SAMSUNG...." name="marca" value="<?php echo $per->marca; ?>">
    </label>
    <label for="modelo" class="input-group">
      <span>Modelo</span>
      <input id="modelo" type="text" placeholder="SMU, DX-120, S2412..." name="modelo" value="<?php echo $per->modelo; ?>">
    </label>
  </div>
  <div class="container-input-flex">

    <label for="color" class="input-group">
      <span>Color</span>
      <input id="color" type="text" placeholder="NEGRO,ROJO , AZUL ,etc..." name="color" value="<?php echo $per->color; ?>">
    </label>
    <label for="serial" class="input-group">
      <span>Serial</span>
      <input id="serial" type="text" placeholder="EJ: BK2SD994KJS..." name="serial" value="<?php echo $per->serial; ?>">
    </label>
  </div>


  <fieldset class="selector-wrapper no-fieldset">
    <legend>Usuario del equipo</legend>

    <label class="label-search-input" for="search">
      <div class="search">
        <i class="bi bi-search"></i>
        <input type="text" id="search" placeholder="Busca al usuario..." class="filter" value="<?php echo $per->getAsignedName() ?>" autocomplete="off">
      </div>
    </label>
    <ul class="options">
      <?php foreach ($users as $usr) { ?>
        <label for="option-<?php echo $usr->id ?>" class="option">
          <input type="radio" name="user_id" value="<?php echo $usr->id ?>" id="option-<?php echo $usr->id ?>" <?php echo ($usr->id == $inv->user_id) ? "checked" : "" ?>>
          <span><?php echo "$usr->first_name $usr->last_name" ?></span>
        </label>
      <?php } ?>

    </ul>


  </fieldset>

  <br>

  <button type="submit" class="btn btn-submit">Guardar Periferico</button>




</form>