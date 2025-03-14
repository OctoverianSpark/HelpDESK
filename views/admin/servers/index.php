<h1 class="title">Administrar Servidores</h1>

<div class="container-actions">
   <button class="btn create-srvr-btn btn-purple">Añadir Servidor</button>
   <button class="btn create-srvr-usr-btn btn-purple">Añadir Usuario</button>
</div>



<div class="servers">
   <?php foreach ($servers as $server) { ?>
      <?php

      $label = '';


      if ($server->users_in_use < ($server->user_limit / 2)) $label = "green-label";
      if ($server->users_in_use == ($server->user_limit / 2)) $label = "yellow-label";
      if ($server->users_in_use > ($server->user_limit / 2)) $label = "red-label";

      ?>
      <details class="server-info <?php echo $label ?>">
         <summary>
            <svg class="icono" width="16" height="16" viewBox="0 0 24 24" fill="none"
               stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
               <polyline points="6 9 12 15 18 9"></polyline>
            </svg>
            <?php echo strtoupper($server->agent) ?>
         </summary>
         <div class="data">
            <div class="container-flex">

               <button data-id="<?php echo $server->id ?>" class="cell-btn btn update-srv-btn"><i class="bi bi-pencil-fill"></i></button>
               <button data-id="<?php echo $server->id ?>" class="cell-btn btn delete-srv-btn"><i class="bi bi-trash-fill"></i></button>
            </div>
            <p>IP: <?php echo $server->ip ?></p>
            <p>Usuarios: <span><?php echo $server->user_limit ?></span></p>
            <p>Usuarios en uso: <span><?php echo $server->users_in_use ?></span></p>
            <p>Fecha de Mantenimiento: <span><?php echo $server->maintenance_start ?></span></p>
            <p>Mantenimiento: <span><?php echo $server->cost ?> $</span></p>
         </div>

         <hr>
         <div class="users">

            <?php foreach ($server->users as $user) { ?>
               <button data-id="<?php echo $user->id ?>" class="usr-btn"><?php echo $user->username ?></button>
            <?php } ?>
         </div>
      </details>

   <?php } ?>



</div>




<div class="hidden modal user-detail-modal">

   <div class="container-actions">
      <button data-id='' class="update-usr-btn btn cell-btn"><i class="bi bi-pencil-fill"></i></button>
      <button data-id='' class="cell-btn btn delete-usr-btn"><i class="bi bi-trash-fill"></i></button>

   </div>

   <p>Servidor: <span id="server"></span></p>
   <p>Usuario: <span id="username"></span></p>
   <p>Contraseña: <span id="password"></span></p>
   <p>Creado: <span id="created_at"></span></p>
   <p>Actualizado: <span id="updated_at"></span></p>
   <p>Asignado a: <span id="asigned_to"></span></p>



   <button class="btn btn-purple download-rdp">Descargar RDP <i class="bi bi-download"></i></button>



</div>



<div class="modal create-server-modal hidden">


   <form class="srvr-form">

      <input type="hidden" name="id" value="">

      <label for="ip" class="input-group">
         <span>Direccion IP</span>
         <input type="text" name="ip" id="ip">
      </label>

      <label for="agent" class="input-group">
         <span>Agente</span>
         <input type="text" name="agent" id="agent">
      </label>

      <label for="maintenance" class="input-group">
         <span>Periodicidad de mantenimiento</span>
         <select name="maintenance" id="maintenance">
            <option value="mensual">Mensual</option>
            <option value="bimestral">Bimestral</option>
            <option value="trimestral">Trimestral</option>
         </select>
      </label>

      <label for="maintenance_start" class="input-group">
         <span>Inicio de Mantenimiento</span>
         <input type="number" min="1" max="31" name="maintenance_start" id="maintenance_start">
      </label>

      <label for="user_limit" class="input-group">
         <span>Cantidad de Usuarios en uso</span>
         <input type="number" name="user_limit" id="user_limit">
      </label>

      <label for="users_in_use" class="input-group">
         <span>Cantidad de Usuarios en uso</span>
         <input type="number" name="users_in_use" id="users_in_use">
      </label>

      <label for="cost" class="input-group">
         <span>Costo de mantenimiento</span>
         <input type="number" name="cost" id="cost">
      </label>


      <button type="submit" class="btn btn-purple btn-submit">Cargar Informacion</button>

   </form>


</div>


<div class="modal create-user-modal">

   <form class="usr-form">

      <input type="hidden" name="id" value="">

      <label for="server" class="input-group">
         <span>Servidor</span>
         <select name="server_id" id="server">
            <?php foreach ($servers as $server) { ?>

               <option value="<?php echo $server->id ?>"><?php echo strtoupper($server->agent) ?></option>

            <?php } ?>
         </select>
      </label>

      <label for="username" class="input-group">
         <span>Nombre de Usuario</span>
         <input type="text" name="username" id="username">
      </label>
      <label for="password" class="input-group">
         <span>Contraseña</span>
         <input type="text" name="password" id="password">
      </label>
      <label for="asigned_to" class="input-group">
         <span>Persona Asignada</span>
         <input type="text" name="asigned_to" id="asigned_to">
      </label>



      <button type="submit" class="btn btn-submit btn-purple">Cargar Informacion</button>



   </form>

</div>