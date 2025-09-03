<h1 class="title">Perifericos</h1>


<div class="container-topbar">

  <form method="get" class="per-type-form">

    <div class="container-flex">

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

    <div class="container-grid">

      <div class="container-flex">

        <label for="col" class="input-group" direction="column">
          <span>Buscar por:</span>

          <select name="col" id="col">
            <option value="" disabled selected>Elige una opcion</option>
            <option value="nombre">Nombre del Usuario</option>
            <option value="marca">Marca</option>
            <option value="modelo">Modelo</option>
            <option value="color">Color</option>
            <option value="serial">Serial</option>
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
  <div class="table table-per-admin">
    <div class="table-row table-header">
      <div class="header">ID</div>
      <div class="header">Fecha de Modificacion</div>
      <div class="header">Tipo</div>
      <div class="header">Asignado a</div>
      <div class="header">Marca</div>
      <div class="header">Modelo</div>
      <div class="header">Color</div>
      <div class="header">Serial</div>
      <div class="header">Fecha de Asignacion</div>
    </div>
  </div>
</div>

<div id="pagination"></div>