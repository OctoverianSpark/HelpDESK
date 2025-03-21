<h1 class="title"> Encuestas </h1>


<div class="table-wrapper">


   <div class="table">


      <div class="table-header">
         <div class="header">Encuestado</div>
         <div class="header">Fecha de Encuesta</div>
         <div class="header">Tiempo de Respuesta</div>
         <div class="header">Explicacion Efectiva</div>
         <div class="header">Atencion Efectiva</div>
         <div class="header">Comentarios</div>

      </div>

      <?php foreach($polls as $poll){ ?>


            <div class="table-row">
               <div class="cell"><?php echo strtoupper( $poll->name) ?></div>
               <div class="cell"><?php echo date("d / m / Y",strtotime($poll->date)) ?></div>
               <div class="cell"><?php echo $poll->general_test["response_time"] ?></div>
               <div class="cell"><?php echo strtoupper($poll->general_test["effective-explain"]) ?></div>
               <div class="cell"><?php echo strtoupper($poll->general_test["effective-atention"]) ?></div>
               <div class="cell"><?php echo $poll->suggestions ?></div>
            </div>

      <?php } ?>

   </div>
</div>