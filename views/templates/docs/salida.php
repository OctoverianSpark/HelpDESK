<div class="container-doc-header orden-salida">

   <div class="container-img">

      <img src="/build/img/LOGO.png" alt="A" class="img-title">
   </div>
   <h1>GESTI&Oacute;N AUTOMATIZACI&Oacute;N, TECNOLOG&Iacute;A, E INFORMATICA <br> ORDEN DE SALIDA DE EQUIPOS <br> INFORMATICOS</h1>
   <div class="metadata">

      <p><b>C&oacute;digo: </b> GATI-FT-03</p>
      <p><b>Versi&oacute;n: </b> 01</p>
      <p><b>Fecha: </b><?php echo date("d / m / Y") ?></p>
      <p><b>P&aacute;gina: </b>1 de 2</p>

   </div>
</div>



<div class="container-doc-body">

   <div class="container-data">
      <p>C&oacute;digo: <?php echo s($order->order_id) ?></p>
   </div>

   <div class="container-main-data">


      <div class="container-data">
         <p>Fecha de Emisi&oacute;n: <?php echo s(date("d / m / Y", strtotime($order->emitted_date))) ?></p>
         <p>Empresa: Asistente Virtual S. A. S.</p>
         <p>Cargo:<?php echo ucwords(strtolower(s($usr->cargo))) ?> </p>
      </div>
      <div class="container-data">
         <p>Fecha de Retorno: <?php echo (strtolower($order->return_date) === "no return")?"Sin Retorno":date("d / m / Y", strtotime($order->return_date)) ?></p>
         <p>Empleado: <?php echo ucwords(strtolower(s($usr->nombre . " " . $usr->apellido))) ?> </p>
         <p>Departamento: <?php echo ucwords(strtolower(s($usr->area))) ?> </p>

      </div>

   </div>




   <p>
      Mediante el presente documento, Asistente Virtual S.A.S. autoriza el préstamo, salida y traslado de los siguientes equipos y accesorios informáticos descritos en el punto 1 de este documento al usuario(a) <?php echo ucwords(strtolower(s($usr->nombre . " " . $usr->apellido))) ?> por un período de <?php echo (strtolower($order->return_date) === "no return")?"tiempo indefinido":calculateDays($order->emitted_date,$order->return_date). " dia/s" ?>.
   </p>
   
   <p>
      El Departamento de Automatización, Tecnología e Informática realizará el despacho de los equipos y accesorios en las instalaciones de la empresa y el usuario se compromete a utilizar los equipos exclusivamente para fines laborales y a cuidarlos de acuerdo con las normas establecidas. El Usuario se compromete a cuidar y devolver estos activos, propiedad de la empresa, en buen estado físico y de funcionamiento, tal y como fueron entregados y en caso de sufrir pérdida, daño, robo o mal funcionamiento este debe verificar de manera inmediata. Al finalizar el periodo de trabajo remoto en el domicilio pautado, el usuario deberá trasladar los equipos y accesorios informáticos anteriormente mencionados en las mismas condiciones en que fueron entregados, para retomar sus actividades en las instalaciones de la empresa.
   </p>



</div>
<h2><b>1. DATOS DEL COMPUTADOR Y ACCESORIOS INFORMATICOS</b></h2>



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




</div>



<div class="container-doc-header">

   <div class="container-img">

      <img src="/build/img/LOGO.png" alt="A" class="img-title">
   </div>
   <h1>GESTI&Oacute;N AUTOMATIZACI&Oacute;N, TECNOLOG&Iacute;A, E INFORMATICA <br> ORDEN DE SALIDA DE EQUIPOS <br> INFORMATICOS</h1>
   <div class="metadata">

      <p><b>C&oacute;digo: </b> GATI-FT-03</p>
      <p><b>Versi&oacute;n: </b> 01</p>
      <p><b>Fecha: </b><?php echo date("d / m / Y") ?></p>
      <p><b>P&aacute;gina: </b>2 de 2</p>

   </div>
</div>


<h2><b>2. RESPONSABILIDAD DEL EMPLEADO</b></h2>

<p>
   Al firmar este documento, el usuario manifiesta su compromiso con la empresa de cuidar y devolver los activos descritos en este anexo en buen estado físico y funcional.
   Además, garantiza que, en caso de que el equipo sufra daños o pérdidas, ya sean parciales o totales, asumirá la responsabilidad ante la empresa por los equipos mencionados.
</p>

