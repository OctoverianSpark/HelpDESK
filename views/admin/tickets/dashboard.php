<main class="tickets-admin-dashboard">



   <div class="top-bar-filter">


      <form class="graphics-filter-form container-input-flex">



         <fieldset class="no-fieldset container-input-flex">

            <legend>Desde / Hasta</legend>

            <label for="from" class="input-group">
               <span>Desde</span>
               <input type="date" name="from" id="from">
            </label>
            <label for="to" class="input-group">
               <span>Hasta</span>
               <input type="date" name="to" id="to">
            </label>

         </fieldset>




         <fieldset class="no-fieldset container-input-flex">
            <legend>Tecnico Asignado</legend>
            <?php foreach ($usrs as $usr) { ?>
               <label for="technical-<?php echo $usr->id ?>" class="radio-label">
                  <input type="radio" name="tech" id="technical-<?php echo $usr->id ?>" value="<?php echo $usr->id ?>">
                  <span><?php echo $usr->first_name . " " . $usr->last_name ?></span>
               </label>
            <?php } ?>


         </fieldset>





      </form>
   </div>

   <div class="container-brief-cards">


      <div class="brief-card">
         <span class="avatar">

            <i class="bi bi-ticket-detailed"></i>

         </span>
         <div class="card-data">

            <span class="card-title">Total de tickets</span>
            <span class="quantificate-total card-result"></span>

         </div>
      </div>
      <div class="brief-card">
         <span class="avatar">

            <i class="bi bi-clock"></i>

         </span>
         <div class="card-data">

            <span class="card-title">Tiempo de asignacion</span>
            <span class="quantificate-asign-time card-result"></span>
         </div>

      </div>
      <div class="brief-card">
         <span class="avatar">

            <i class="bi bi-clock"></i>

         </span>
         <div class="card-data">
            <span class="card-title">Tiempo de suspension</span>
            <span class="quantificate-pending-time card-result"></span>

         </div>

      </div>
      <div class="brief-card">
         <span class="avatar">

            <i class="bi bi-clock"></i>

         </span>
         <div class="card-data">
            <span class="card-title">Tiempo de completacion</span>
            <span class="quantificate-complete-time card-result"></span>

         </div>

      </div>

   </div>



   <div class="dashboard">


      <div class="dashboard-info">

         <canvas class="chart-per-type"></canvas>

      </div>


      <div class="dashboard-info bar-chart">

         <canvas class="chart-per-asign"></canvas>

      </div>

      <div class="dashboard-info line-chart">
         <canvas class="chart-per-time"></canvas>
      </div>

   </div>






</main>