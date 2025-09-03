<h1>Crear</h1>



<form action="" method="post" class="container-grid">





  <h1>De que se trata tu solicitud?</h1>



  <label for="usuario" class="input-group">
    <select name="usuario" id="usuario">
      <?php
      foreach ($employees as $employee) {  ?>
        <option value="<?php echo $employee->first_name . ' ' . $employee->last_name ?>"><?php echo $employee->first_name . ' ' . $employee->last_name  ?></option>
      <?php } ?>
    </select>
  </label>

  <div class="container-flex">


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






  <label for="descripcion" class="input-group">
    <p>Describe tu solicitud</p>
    <textarea placeholder="Coloca una descripcion detallada de tu solicitud" name="descripcion" id="descripcion" required><?php echo $ticket->descripcion ?></textarea>
  </label>


  <label for="image" class="file-selector">
    <p><i class="bi bi-file-earmark-arrow-up-fill"></i>Agregar Imagen de referencia</p>
    <input type="file" name="imagen" id="image" accept="image/*">
  </label>


  <button class="btn primary-btn">Enviar</button>
</form>