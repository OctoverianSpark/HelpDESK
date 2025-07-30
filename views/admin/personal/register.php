<form method="post">

  <div class="container-input-flex">

    <label for="first_name" class="input-group">
      <span>Nombre</span>
      <input type="text" name="first_name" id="first_name" required placeholder="Nombre"
        value="<?= isset($personal->first_name) ? s($personal->first_name) : '' ?>">
    </label>
    <label for="last_name" class="input-group">
      <span>Apellido</span>
      <input type="text" name="last_name" id="last_name" required placeholder="Apellido"
        value="<?= isset($personal->last_name) ? s($personal->last_name) : '' ?>">
    </label>
  </div>

  <div class="container-input-flex">

    <label for="id_type" class="input-group">
      <span>Tipo de Documento</span>
      <select name="id_type" id="id_type">
        <option value="" disabled <?= empty($personal->id_type) ? 'selected' : '' ?>>Seleccione una opcion</option>
        <option value="ppt" <?= (isset($personal->id_type) && $personal->id_type == 'ppt') ? 'selected' : '' ?>>PPT</option>
        <option value="cc" <?= (isset($personal->id_type) && $personal->id_type == 'cc') ? 'selected' : '' ?>>Cedula Colombiana</option>
        <option value="pasaporte" <?= (isset($personal->id_type) && $personal->id_type == 'pasaporte') ? 'selected' : '' ?>>Pasaporte</option>
        <option value="cv" <?= (isset($personal->id_type) && $personal->id_type == 'cv') ? 'selected' : '' ?>>Cedula Venezolana</option>
      </select>
    </label>
    <label for="nat_id" class="input-group">
      <span>Documento</span>
      <input type="text" name="nat_id" id="nat_id" required placeholder="Documento"
        value="<?= isset($personal->nat_id) ? s($personal->nat_id) : '' ?>">
    </label>
  </div>
  <div class="container-input-flex">

    <label for="phone_number" class="input-group">
      <span>Telefono</span>
      <input type="text" name="phone_number" id="phone_number" required placeholder="Telefono"
        value="<?= isset($personal->phone_number) ? s($personal->phone_number) : '' ?>">
    </label>
    <label for="email" class="input-group">
      <span>Correo</span>
      <input type="email" name="email" id="email" required placeholder="Correo"
        value="<?= isset($personal->email) ? s($personal->email) : '' ?>">
    </label>
  </div>
  <div class="container-input-flex">
    <label for="job_title" class="input-group">
      <span>Cargo</span>
      <input type="text" name="job_title" id="job_title" required placeholder="Cargo"
        value="<?= isset($personal->job_title) ? s($personal->job_title) : '' ?>">
    </label>
    <label for="area" class="input-group">
      <span>Area</span>
      <input type="text" name="area" id="area" required placeholder="Area"
        value="<?= isset($personal->area) ? s($personal->area) : '' ?>">
    </label>

    <label for="contract_type" class="input-group">
      <span>Contrato</span>
      <select name="contract_type" id="contract_type">
        <option value="" disabled <?= empty($personal->contract_type) ? 'selected' : '' ?>>Seleccione una opcion</option>
        <option value="indefinido" <?= (isset($personal->contract_type) && $personal->contract_type == 'indefinido') ? 'selected' : '' ?>>Indefinido</option>
        <option value="prestacion de servicio" <?= (isset($personal->contract_type) && $personal->contract_type == 'prestacion de servicio') ? 'selected' : '' ?>>Prestacion de servicio</option>
        <option value="aprendizaje" <?= (isset($personal->contract_type) && $personal->contract_type == 'aprendizaje') ? 'selected' : '' ?>>Aprendizaje</option>
      </select>
    </label>
  </div>

  <div class="container-input-flex">
    <label for="state" class="input-group">
      <span>Estado</span>
      <select name="state" id="state">
        <option value="" disabled <?= !isset($personal->state) ? 'selected' : '' ?>>Seleccione una opcion</option>
        <option value="1" <?= (isset($personal->state) && $personal->state == '1') ? 'selected' : '' ?>>Activo</option>
        <option value="0" <?= (isset($personal->state) && $personal->state == '0') ? 'selected' : '' ?>>Inactivo</option>
      </select>
    </label>
    <label for="location" class="input-group">
      <span>Ubicacion</span>
      <select name="location" id="location">
        <option value="" disabled <?= empty($personal->location) ? 'selected' : '' ?>>Selecciona una opcion</option>
        <option value="colombia" <?= (isset($personal->location) && $personal->location == 'colombia') ? 'selected' : '' ?>>Colombia</option>
        <option value="venezuela" <?= (isset($personal->location) && $personal->location == 'venezuela') ? 'selected' : '' ?>>Venezuela</option>
      </select>
    </label>
  </div>

  <br>

  <button type="submit" class="btn btn-submit">Cargar Datos</button>

</form>