<main class="tickets-admin-dashboard">


   <div class="container-brief-cards">


      <div class="brief-card">
         <i class="bi bi-ticket-detailed-fill"></i>
         <div class="card-data">

            <span>Total de tickets</span>
            <p class="quantificate-total"></p>

         </div>
      </div>
      <div class="brief-card">
         <i class="bi bi-clock-fill"></i>
         <div class="card-data">

            <span>Tiempo promedio en asignarse</span>
            <p class="quantificate-asign-time"></p>
         </div>

      </div>
      <div class="brief-card">
         <i class="bi bi-clock-fill"></i>
         <div class="card-data">
            <span>Tiempo promedio en pendiente</span>
            <p class="quantificate-pending-time"></p>

         </div>

      </div>
      <div class="brief-card">
         <i class="bi bi-clock-fill"></i>
         <div class="card-data">
            <span>Tiempo promedio en completar</span>
            <p class="quantificate-complete-time"></p>

         </div>

      </div>

   </div>


   <div class="dashboard">

      <form class="graphics-filter-form">

         <fieldset class="container-input">

               <legend>Filtros de Informacion</legend>

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

                     <?php foreach($usrs as $usr){ ?>
                        <label for="technical-<?php echo $usr->id ?>" class="radio-label-card">
                           <input type="radio" name="tech" id="technical-<?php echo $usr->id ?>" value="<?php echo $usr->id ?>">
                           <i class="bi bi-person-fill"></i>
                           <span><?php echo $usr->first_name . " " . $usr->last_name ?></span>
                        </label>
                     <?php } ?>
                     


               </fieldset>

         </fieldset>




      </form>


      <div class="dashboard-info">

            <canvas class="chart-per-type"></canvas>

      </div>


      <div class="dashboard-info">

            <canvas class="chart-per-asign"></canvas>

      </div>


      <div class="dashboard-info">

            <canvas class="chart-per-time"></canvas>

      </div>


   </div>


</main>