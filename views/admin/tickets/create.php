<h1>Crear</h1>



<form action="" method="post">


  <fieldset class="selector-wrapper no-fieldset">
    <legend>Solicitado por: </legend>

    <label class="label-search-input" for="usr-search">
      <div class="search">
        <i class="bi bi-search"></i>
        <input type="text" id="usr-search" placeholder="Busca al usuario..." class="filter" autocomplete="off" required>
      </div>
    </label>
    <ul class="options">

      <?php foreach ($employees as $employee) { ?>
        <label for="employee-option-<?php echo $employee->id ?>" class="option">
          <input type="radio" name="usuario" value="<?php echo $employee->first_name . ' ' . $employee->last_name ?>" id="employee-option-<?php echo $employee->id ?>" <?php echo ($employee->id == $inv->user_id) ? "checked" : "" ?>>
          <span><?php echo "$employee->first_name $employee->last_name" ?></span>
        </label>
      <?php } ?>

    </ul>


  </fieldset>


  <h1>De que se trata tu solicitud?</h1>
  <div class="container-input-flex">


    <label class="radio-label-card" for="apps-radio" title="Programas del Computador">
      <input type="radio" name="categoria" id="apps-radio" value="Aplicaciones">
      <i class="bi bi-grid-fill"></i>
      <span>Aplicaciones del computador</span>
    </label>
    <label class="radio-label-card" for="computer-radio" title="">
      <input type="radio" name="categoria" id="computer-radio" value="equipo">
      <i class="bi bi-laptop-fill"></i>
      <span>Problemas fisicos</span>
    </label>
  </div>






  <label for="descripcion" class="label-input">
    <p>Describe tu solicitud</p>
    <textarea placeholder="Coloca una descripcion detallada de tu solicitud" name="descripcion" id="descripcion" required><?php echo $ticket->descripcion ?></textarea>
  </label>


  <label for="image" class="file-selector">
    <p><i class="bi bi-file-earmark-arrow-up-fill"></i>Agregar Imagen de referencia</p>
    <input type="file" name="imagen" id="image" accept="image/*">
  </label>


  <button class="btn btn-submit">Enviar</button>
</form>