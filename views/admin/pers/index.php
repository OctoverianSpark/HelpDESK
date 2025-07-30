<h1 class="title">Perifericos</h1>


<div class="container-topbar">

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
  <div class="table">
    <div class="table-header">
      <div class="header">ID</div>
      <div class="header">Fecha de Modificacion</div>
      <div class="header">Tipo</div>
      <div class="header">Asignado a</div>
      <div class="header">Marca</div>
      <div class="header">Modelo</div>
      <div class="header">Color</div>
      <div class="header">Serial</div>
      <?php if($_GET['state'] === '1'){ ?>
        <div class="header">Fecha de Asignacion</div>
        <?php }?>
    </div>
    <?php foreach ($pers as $per): ?>
      <div class="table-row">
        <div class="cell"><a href="/admin/pers/update?id=<?php echo $per->id ?>"><?php echo s($per->id); ?></a></div>
        <div class="cell" col='serial'><?php echo s($per->mod_date); ?></div>
        <div class="cell" col='tipo'><?php echo s($per->tipo); ?></div>
        <div class="cell" col='nombre'><?php echo s($per->getAsignedName()); ?></div>
        <div class="cell" col='marca'><?php echo s($per->marca); ?></div>
        <div class="cell" col='modelo'><?php echo s($per->modelo); ?></div>
        <div class="cell" col='color'><?php echo s($per->color); ?></div>
        <div class="cell" col='serial'><?php echo s($per->serial); ?></div>
        <?php if($_GET['state'] === '1'){ ?>
          <div class="header"><?php echo s($per->asign_date) ?></div>

        <?php }?>
      </div>
    <?php endforeach; ?>
  </div>
</div>