<h1>Personal</h1>


<div class="container-top-bar">

  <form method="get" class="selection-form">

    <div class="container-input-flex">

      <label for="active" class="radio-label-card">
        <i class="bi bi-check"></i>
        <input type="radio" name="state" value="1" id="active" <?php echo $_GET['state'] === "1" ? 'checked' : '' ?>>
        <span>Activo</span>
      </label>

      <label for="stock" class="radio-label-card">
        <i class="bi bi-archive"></i>
        <input type="radio" name="state" value="0" id="stock" <?php echo $_GET['state'] === "0" ? 'checked' : '' ?>>
        <span>Stock</span>
      </label>

    </div>
  </form>

  <form class="search-form" method="GET">

    <div class="container-input">

      <div class="container-input-flex">

        <label for="col" class="input-group" direction="column">
          <span>Buscar por:</span>

          <select name="col" id="col">
            <option value="" disabled selected>Elige una opcion</option>
            <option value="fullname">Nombre</option>
            <option value="nat_id">Documento</option>
            <option value="job_title">Cargo</option>
          </select>
        </label>

        <label for="val" class="input-group" direction="column">
          <span>Valor</span>

          <input type="text" name="val" id="val" placeholder="Buscar..." autocomplete="off">

        </label>
      </div>
    </div>



  </form>

</div>
<div class="table-wrapper">
  <div class="table">
    <div class="table-header">
      <div class="header">Nombre</div>
      <div class="header">Correo</div>
      <div class="header">Telefono</div>
      <div class="header">Documento</div>
      <div class="header">Tipo de Contrato</div>
      <div class="header">Cargo</div>
      <div class="header">Acciones</div>
    </div>
    <?php foreach ($personal as $person): ?>
      <div class="table-row">
        <div class="cell" col='fullname'><?php echo $person->first_name . ' ' . $person->last_name; ?></div>
        <div class="cell"><?php echo $person->email; ?></div>
        <div class="cell"><?php echo $person->phone_number; ?></div>
        <div class="cell" col='nat_id'><?php echo $person->id_type . " " . $person->nat_id; ?></div>
        <div class="cell"><?php echo $person->contract_type; ?></div>
        <div class="cell" col='job_title'><?php echo $person->job_title . " DE " . $person->area; ?></div>
        <div class="cell"><a href="/admin/personal/update?id=<?php echo $person->id ?>"><i class="bi bi-pencil-fill"></i></a></div>
      </div>
    <?php endforeach; ?>
  </div>
</div>