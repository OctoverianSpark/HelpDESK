<h1 class="title">Encuesta de Sastisfaccion</h1>



<form method="POST" class="satisfaction-form">



   <label for="area" class="input-group">
      <span>Area</span>
      <select name="area" id="area">
         <option value="operations">Operaciones</option>
         <option value="desc">DESC</option>
         <option value="supervision">Supervision</option>
         <option value="administracion">Administracion</option>
         <option value="talento humano">Talento Humano</option>
         <option value="gerencia">Gerencia</option>
      </select>


   </label>


   <label for="tickets" class="input-group">
      <span>Numero de tickets realizados</span>
      <input type="number" name="tick_num" id="id">
   </label>

   <div class="indv-tests">

      <?php
      $i = 0;

      foreach ($techs as $tech) {
         if (strtolower($tech->ad_user) === "alexander.p") continue;

      ?>

         <div class="indv-test">


            <h2 class="subtitle"><?php echo ucwords(strtolower("$tech->first_name $tech->last_name")) ?></h2>
            <div class="container-question">

               <p>Has recibido atencion de <?php echo ucwords(strtolower("$tech->first_name $tech->last_name")) ?>?</p>
               <div class="container-flex">
                  <label for="yes-ticket-<?php echo $tech->id ?>" class="yes-no-radio yes-radio">
                     <input type="radio" name="individual[made-ticket][<?php echo $tech->id ?>]" id="yes-ticket-<?php echo $tech->id ?>" value="si">
                     <span><i class="bi bi-check"></i>Si</span>

                  </label>
                  <label for="no-ticket-<?php echo $tech->id ?>" class="yes-no-radio no-radio">
                     <input type="radio" name="individual[made-ticket][<?php echo $tech->id ?>]" id="no-ticket-<?php echo $tech->id ?>" value="no">
                     <span><i class="bi bi-x"></i> No</span>

                  </label>
               </div>
            </div>

            <div class="container-ranges">
               <div class="container-info">

                  <h3>Tiempo de Respuesta</h3>
                  <div class="range-wth-title">
                     <span class="value">Elige una Calificacion</span>
                     <input type="range" name="individual[response][<?php echo $tech->id ?>]" min="1" max="5" value="3" disabled>
                  </div>


               </div>
               <div class="container-info">

                  <h3>Calidad del servicio</h3>
                  <div class="range-wth-title">
                     <span class="value">Elige una Calificacion</span>
                     <input type="range" name="individual[quality][<?php echo $tech->id ?>]"  min="1" max="5" value="3" disabled>
                  </div>


               </div>
               <div class="container-info">

                  <h3>Amabilidad y profesionalismo</h3>
                  <div class="range-wth-title">
                     <span class="value">Elige una Calificacion</span>
                     <input type="range" name="individual[amability][<?php echo $tech->id ?>]"  min="1" max="5" value="3" disabled>
                  </div>


               </div>
            </div>


         </div>



      <?php
      } ?>
   </div>


   <div class="general-test">
      <h3>¿Recibió una solución efectiva a sus tickets?</h3>
      <div class="container-flex">
         <label for="yes-attention" class="yes-no-radio yes-radio">
            <input type="radio" name="general[effective-atention]" id="yes-attention" value="si">
            <span><i class="bi bi-check"></i>Si</span>

         </label>
         <label for="no-attention" class="yes-no-radio no-radio">
            <input type="radio" name="general[effective-atention]" id="no-attention" value="no">
            <span><i class="bi bi-x"></i> No</span>

         </label>
      </div>
      <h3>¿Le brindaron una explicación clara sobre la solución aplicada?</h3>
      <div class="container-flex">
         <label for="yes-explain" class="yes-no-radio yes-radio">
            <input type="radio" name="general[effective-explain]" id="yes-explain" value="si">
            <span><i class="bi bi-check"></i>Si</span>

         </label>
         <label for="no-explain" class="yes-no-radio no-radio">
            <input type="radio" name="general[effective-explain]" id="no-explain" value="no">
            <span><i class="bi bi-x"></i> No</span>

         </label>
      </div>



      <div class="container-info">

         <h3>¿Cómo calificaría la facilidad para comunicarse con el equipo de informática?</h3>
         <div class="range-wth-title">
            <span class="value">Elige una Calificacion</span>
            <input type="range" name="general[response_time]" id="response-time" min="1" max="5" value="1">
         </div>

      </div>

   </div>



   <label for="comments" class="label-input">
      
      <p>Sugerencias y comentarios</p>
      
      <textarea name="suggestions" id="comments"></textarea>
   </label>


   

   <button type="submit" class="btn btn-submit btn-purple">Enviar Encuesta</button>



</form>