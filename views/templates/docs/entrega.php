<div class="container-doc-header">

   <div class="container-img">

      <img src="/build/img/LOGO.png" alt="A" class="img-title">
   </div>
   <h1>GESTI&Oacute;N AUTOMATIZACI&Oacute;N, TECNOLOG&Iacute;A, E INFORMATICA <br> ORDEN DE ENTREGA DE EQUIPOS <br> INFORMATICOS</h1>
   <div class="metadata">

      <p><b>C&oacute;digo:</b> GATI-FT-01</p>
      <p><b>Versi&oacute;n:</b> 01</p>
      <p><b>Fecha: </b><?php echo date("d / m / Y") ?></p>
      <p><b>P&aacute;gina:</b>1 de 2</p>

   </div>
</div>



<div class="container-doc-body">

   <div class="container-main-data">

      <div class="container-data">
         <p>Fecha de Emisi&oacute;n: <?php echo date("d / m / Y") ?></p>
         <p>Empresa: Asistente Virtual</p>
         <p>Cargo: <?php echo ucwords(strtolower($usr->job_title)) ?> </p>
      </div>
      <div class="container-data">
         <p>C&oacute;digo: <?php echo $order->order_id ?></p>
         <p>Empleado: <?php echo ucwords(strtolower("$usr->first_name $usr->last_name")) ?></p>
         <p>Departamento: <?php echo ucwords(strtolower($usr->area)) ?></p>

      </div>

   </div>




   <p>Mediante el presente documento, Asistente Virtual se realiza la asignación de los siguientes equipos y accesorios informáticos descritos en el punto número 2 de este documento al usuario(a) <?php echo ucwords(strtolower("$usr->nombre $usr->apellido")) ?> con el número de identificación <?php echo "$usr->tipo_documento $usr->documento" ?>, esto con el fin de realizar sus labores asignadas en la empresa. El Departamento de Automatización, Tecnología e Informática realizará el despacho de los equipos y accesorios en las instalaciones de la empresa y el usuario se compromete a utilizar los equipos exclusivamente para fines laborales y a cuidarlos de acuerdo con las normas establecidas en el reglamento interno de la empresa. El usuario se compromete a cuidar y devolver estos activos, propiedad de la empresa, en buen estado físico y de funcionamiento, tal y como fueron entregados. </p>




</div>

<h2><b>1. CHECK LIST DE ENTREGA DE EQUIPO</b></h2>
<p>A continuaci&oacute;n, se describen los items que deben tener instalados y configurados y el estado en que est&aacute; siendo entregado el computador: </p>
<div class="container-doc-checks">


   <?php 
      
      foreach ($ftrs as $ftr) {
         spawnCheckbox("","",$ftr,true,true);
      }
   
   ?>

</div>

<div class="container-doc-header">

   <div class="container-img">

      <img src="/build/img/LOGO.png" alt="A" class="img-title">
   </div>
   <h1>GESTI&Oacute;N AUTOMATIZACI&Oacute;N, TECNOLOG&Iacute;A, E INFORMATICA <br> ORDEN DE ENTREGA DE EQUIPOS <br> INFORMATICOS</h1>
   <div class="metadata">

      <p><b>C&oacute;digo:</b> GATI-FT-01</p>
      <p><b>Versi&oacute;n:</b> 01</p>
      <p><b>Fecha: </b> <?php echo date("d / m / Y") ?></p>
      <p><b>P&aacute;gina:</b>2 de 2</p>

   </div>
</div>
<h2><b>2. DATOS DEL COMPUTADOR Y ACCESORIOS INFORMATICOS</b></h2>



<div class="doc-table">

   <div class="table-row table-header">

      <div class="header cell-no">N&deg;</div>
      <div class="header">ITEM</div>
      <div class="header">MARCA</div>
      <div class="header">MODELO</div>
      <div class="header">SERIAL</div>
      <div class="header">NOMBRE</div>
      <div class="header">OBSERVACIONES</div>

   </div>
   <div class="table-row">
      <div class="cell cell-no">1</div>
      <div class="cell"><?php echo $eq->tipo ?></div>
      <div class="cell"><?php echo $eq->marca ?></div>
      <div class="cell"><?php echo $eq->modelo ?></div>
      <div class="cell"><?php echo $eq->serial ?></div>
      <div class="cell"><?php echo $eq->nombre_equipo ?></div>
      <div class="cell">
         <input type="text">
      </div>
   </div>

   <?php

   $i = 2;
   foreach ($pers as $per) {
   ?>

      <div class="table-row">
         <div class="cell cell-no"><?php echo $i++ ?></div>
         <div class="cell"><?php echo strtoupper($per->tipo) ?></div>
         <div class="cell"><?php echo strtoupper($per->marca) ?></div>
         <div class="cell"><?php echo strtoupper($per->modelo) ?></div>
         <div class="cell"><?php echo strtoupper($per->serial) ?></div>
         <div class="cell">N / A </div>
         <div class="cell">
            <input type="text">
         </div>
      </div>
   <?php } ?>


</div>


<h2><b>3. RESPONSABILIDAD DEL EMPLEADO</b></h2>

<p>Al firmar este documento, el usuario manifiesta su compromiso con la empresa de cuidar y devolver los activos descritos en este anexo en buen estado físico y funcional. Además, garantiza que, en caso de que el equipo sufra daños o pérdidas, ya sean parciales o totales, asumirá la responsabilidad ante la empresa por los equipos mencionados.</p>


