<div class="cont                                                      `ainer-grid">
  <h1 class="title">Crear PQRS</h1>



  <form method="post" class="container-grid grid-center">
    <div class="container-flex">

      <label for="name" class="input-group">
        <span>Nombre</span>
        <select name="name" id="name">
          <?php foreach ($clients as $client) { ?>
            <option value="<?php echo $client->name; ?>"><?php echo $client->name; ?></option>
          <?php } ?>
        </select>
      </label>


      <label for="type" class="input-group">
        <span>Tipo</span>
        <select name="type" id="type">
          <option value="Red">Red</option>
          <option value="Aplicaciones">Aplicaciones</option>
          <option value="Equipo">Equipo</option>
          <option value="Otros">Otros</option>
        </select>
      </label>
    </div>
    <label for="subject" class="input-group">
      <span>Asunto</span>
      <input type="text" name="subject" id="subject" required>
    </label>

    <div class="container-flex">

      <label for="area_notification" class="input-group">
        <span>Área de Notificación</span>
        <select name="area_notification" id="area_notification">
          <option value="">--Seleccione--</option>
          <option value="gerencia">Gerencia</option>
          <option value="desc">DESC</option>
          <option value="supervision">Supervision</option>
          <option value="coordinacion">Coordinacion</option>
          <option value="administracion">Administracion</option>
          <option value="gestion integral">Gestion Integral</option>
          <option value="talento humano">Talento Humano</option>
          <option value="mercadeo">Mercadeo</option>
          <option value="dimag">DIMAG</option>
          <option value="licencias y certificaciones">Licencias y Certificaciones</option>
          <option value="ventas">Ventas</option>
        </select>
      </label>
    </div>


    <div class="container-flex">
      <label for="origin" class="input-group">
        <span>Fuente de la solicitud</span>
        <select name="origin" id="origin">
          <option value="respondio">Respondio</option>
          <option value="meet">Meet</option>
          <option value="correo">Correo</option>
          <option value="google chat">Google Chat</option>
        </select>
      </label>

      <label for="state" class="input-group">
        <span>Estado</span>
        <select name="state" id="state">
          <option value="nuevo">Sin Asignar</option>
          <option value="en proceso">En Proceso</option>
          <option value="completado">Completado</option>
        </select>
      </label>


    </div>

    <label for="tech_id" class="input-group">
      <span>Tecnico asignado</span>
      <select name="tech_id" id="tech_id">
        <option value="">--Seleccione--</option>
        <?php foreach ($techs as $tech) { ?>
          <option value="<?php echo $tech->id; ?>"><?php echo $tech->first_name . ' ' . $tech->last_name; ?></option>
        <?php } ?>
      </select>
    </label>


    <button type="submit" class="btn primary-btn">Cargar PQRS</button>
  </form>



</div>