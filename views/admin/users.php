<main class="users-admin-controller">



   <form class="search-form">

      <fieldset class="no-fieldset container-input-flex">
         <legend>Filtro de Busqueda <i class="bi bi-filter"></i></legend>

         <label for="col" class="input-group">
            <span>Columna</span>
            <select name="col" id="col">
               <option value="name">Nombre</option>
               <option value="ad_user">Usuario de Dominio</option>
               <option value="mail">Correo</option>
               <option value="role">Rol</option>
               <option value="area">Area</option>
            </select>
         </label>
         <label for="val" class="input-group">
            <span>Valor</span>
            <input type="text" name="val" id="val">
         </label>
      </fieldset>

   </form>

   <div class="container-add-btn">
      <button class="btn view-btn add-row-btn" title="Ctrl+Shift+N"> <i class="bi bi-plus-circle"></i> Agregar un Usuario Nuevo</button>
   </div>

   <div class="table-wrapper">

      <div class="table usrs-table">
         <div class="table-header table-row">
            <div class="header">
               Nombre
            </div>
            <div class="header">
               Usuario de Dominio
            </div>
            <div class="header">
               Correo
            </div>
            <div class="header">
               Rol
            </div>
            <div class="header">
               Area
            </div>
         </div>

         <?php foreach ($usrs as $usr) { ?>
            <div class="table-row">
               <div class="cell" col="name">
                  <button cell-id="<?php echo $usr->id ?>" class="cell-btn btn view-btn">

                     <?php echo $usr->first_name . " " . $usr->last_name ?>
                     <i class="bi bi-box-arrow-up-right"></i>

                  </button>
               </div>
               <div class="cell" col="ad_user">
                  <?php echo $usr->ad_user ?>
               </div>
               <div class="cell" col="mail">
                  <?php echo $usr->mail ?>
               </div>
               <div class="cell" col="role">
                  <?php echo $usr->role ?>
               </div>
               <div class="cell" col="area">
                  <?php echo $usr->area ?>
               </div>
            </div>
         <?php } ?>
      </div>


   </div>




   <div class="modal form-usrs-view hidden">
      <button type="button" class="btn modal-close-btn"><i class="bi bi-x"></i></button>
      <form action="/admin/usrs/saver" method="POST" class="app-usrs-form">

         <div class="container-input-flex">

            <label for="first_name" class="input-group">
               <span>Nombre</span>
               <input type="text" name="first_name" id="first_name" required autocomplete="off">
            </label>

            <label for="last_name" class="input-group">
               <span>Apellido</span>
               <input type="text" name="last_name" id="last_name" required autocomplete="off">
            </label>

         </div>

         <div class="container-input-flex">
            <label for="ad_user" class="input-group">

               <span>Usuario de Dominio</span>
               <input type="text" name="ad_user" id="ad_user" required autocomplete="off">

            </label>

            <label for="mail" class="input-group">

               <span>Correo</span>
               <input type="email" name="mail" id="mail" required autocomplete="off">

            </label>
         </div>


         <label class="input-group">

            <span>Rol</span>

            <div class="container-input-flex">


               <label for="mngr-role" class="radio-label-card">
                  <input type="radio" name="role" value="mngr" id="mngr-role" required>
                  <i class="bi bi-people-fill"></i>
                  <span>MANAGER</span>
               </label>
               <label for="admin-role" class="radio-label-card">
                  <input type="radio" name="role" value="admin" id="admin-role" required>
                  <i class="bi bi-person-fill-gear"></i>
                  <span>ADMINISTRADOR</span>
               </label>


            </div>

         </label>

         <label for="area" class="input-group">
            <span>Area</span>
            <input type="text" name="area" id="area" required autocomplete="off">
         </label>


         <div class="container-actions">
            
         <button type="submit" class="btn btn-submit">Guardar Usuario <i class="bi bi-person-fill-add"></i></button>
         <button type="button" class="btn btn-red hidden">Eliminar <i class="bi bi-trash-fill"></i></button>
         </div>
      </form>



   </div>




</main>