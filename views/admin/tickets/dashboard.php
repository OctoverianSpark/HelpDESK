   <h1 class="title">Panel de Tickets</h1>
   
   <div class="top-bar-filter">


      <form class="dashboard-filter container-flex">



         <fieldset class="no-fieldset container-flex">

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




         <fieldset class="no-fieldset container-flex">
            <legend>Tecnico Asignado</legend>
            <?php foreach ($usrs as $usr) { ?>
               <label for="technical-<?php echo $usr->id ?>" class="radio-btn">
                  <input type="radio" name="tech" id="technical-<?php echo $usr->id ?>" value="<?php echo $usr->id ?>">
                  <span><?php echo $usr->first_name . " " . $usr->last_name ?></span>
               </label>
            <?php } ?>


         </fieldset>





      </form>
   </div>

   <div class="container-brief-cards">

      <div class="cards-dropdown">

         <div class="brief-card drop-opener">
            <span class="avatar">

               <i class="bi bi-ticket"></i>

            </span>
            <div class="card-data">

               <span class="card-title">Tickets</span>
               <label for="tickets-data" class="open-cards">
                  <span><i class="bi bi-chevron-down"></i></span>
                  <input type="checkbox" name="open" id="tickets-data" checked>
               </label>




            </div>

         </div>

         <div class="cards-drop">
            <div>
               <br>

               <div class="drop-card">
                  <span class="avatar">

                     <i class="bi bi-ticket-perforated"></i>

                  </span>
                  <div class="card-data">
                     <span class="card-title">Total</span>
                     <span class="brief-data totalTickets"></span>
                  </div>
               </div>
               <div class="drop-card">
                  <span class="avatar">

                     <i class="bi bi-ticket-perforated"></i>

                  </span>
                  <div class="card-data">
                     <span class="card-title">Abiertos</span>
                     <span class="brief-data openTickets"></span>
                  </div>
               </div>
               <div class="drop-card">
                  <span class="avatar">

                     <i class="bi bi-ticket-perforated"></i>

                  </span>
                  <div class="card-data">
                     <span class="card-title">Pendientes</span>
                     <span class="brief-data pendingTickets"></span>
                  </div>
               </div>
               <div class="drop-card">
                  <span class="avatar">

                     <i class="bi bi-ticket-perforated"></i>

                  </span>
                  <div class="card-data">
                     <span class="card-title">Cerrados al primer contacto</span>
                     <span class="brief-data firstContactClosed"></span>
                  </div>
               </div>
               <div class="drop-card">
                  <span class="avatar">

                     <i class="bi bi-ticket-perforated"></i>

                  </span>
                  <div class="card-data">
                     <span class="card-title">Cerrados con pausas</span>
                     <span class="brief-data closedWithBreaks"></span>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="cards-dropdown">

         <div class="brief-card drop-opener">
            <span class="avatar">

               <i class="bi bi-clock"></i>

            </span>
            <div class="card-data">

               <span class="card-title">Tiempos</span>
               <label for="times" class="open-cards">
                  <span><i class="bi bi-chevron-down"></i></span>
                  <input type="checkbox" name="open" id="times" checked>
               </label>




            </div>

         </div>

         <div class="cards-drop">
            <div>
               <br>

               <div class="drop-card">
                  <span class="avatar">

                     <i class="bi bi-clock-history"></i>

                  </span>
                  <div class="card-data">
                     <span class="card-title">Tiempo en completar</span>
                     <span class="brief-data avgCompletionTime"></span>

                  </div>
               </div>
               <div class="drop-card">
                  <span class="avatar">

                     <i class="bi bi-clock-history"></i>

                  </span>
                  <div class="card-data">
                     <span class="card-title">Tiempo en pendiente</span>
                     <span class="brief-data avgPendingTime"></span>

                  </div>
               </div>
               <div class="drop-card">
                  <span class="avatar">

                     <i class="bi bi-clock-history"></i>

                  </span>
                  <div class="card-data">
                     <span class="card-title">Tiempo promedio sin asignar</span>
                     <span class="brief-data avgAsignedTime"></span>

                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="cards-dropdown">

         <div class="brief-card drop-opener">
            <span class="avatar">

               <i class="bi bi-flag-fill"></i>

            </span>
            <div class="card-data">
               <span class="card-title">Prioridades</span>
               <label for="priorities" class="open-cards">
                  <span><i class="bi bi-chevron-down"></i></span>
                  <input type="checkbox" name="open" id="priorities" checked>
               </label>

            </div>

         </div>


         <div class="cards-drop">

            <div>
               <br>

               <div class="drop-card">
                  <span class="avatar">

                     <i class="bi bi-flag-fill"></i>
                  </span>
                  <div class="card-data">
                     <span class="card-title">Alta</span>
                     <span class="brief-data highPriority"></span>
                  </div>

               </div>

               <div class="drop-card">
                  <span class="avatar">

                     <i class="bi bi-flag-fill"></i>
                  </span>
                  <div class="card-data">
                     <span class="card-title">Media</span>
                     <span class="brief-data mediumPriority"></span>
                  </div>

               </div>

               <div class="drop-card">
                  <span class="avatar">

                     <i class="bi bi-flag-fill"></i>
                  </span>
                  <div class="card-data">
                     <span class="card-title">Baja</span>
                     <span class="brief-data lowPriority"></span>
                  </div>

               </div>

            </div>
         </div>
      </div>

   </div>

   <div class="dashboard-menu">



      <fieldset class="dashboard-card tickets-dashboard-card --row-1">
         <legend>Estados</legend>
         <div class="container-flex">

            <div class="chart-board">
               <canvas id="status-chart"></canvas>

            </div>
            <div class="chart-board">
               <canvas id="priority-chart"></canvas>
            </div>
         </div>

         <div class="chart-board">

            <canvas id="category-chart"></canvas>
         </div>

      </fieldset>

      <fieldset class="dashboard-card tickets-dashboard-card --row-2">
         <legend>Promedio de tiempos y Tickets por fecha</legend>

         <div class="chart-board">
            <canvas id="ticketsByDate"></canvas>

         </div>
         <div class="chart-board">
            <canvas id="avgResolutionByDate"></canvas>
         </div>

      </fieldset>

      <fieldset class="dashboard-card tickets-dashboard-card --row-3">
         <legend>Tiempo promedio de resolucion</legend>

         <div class="chart-board">
            <canvas id="avgResolutionByTech"></canvas>
         </div>

      </fieldset>
   </div>