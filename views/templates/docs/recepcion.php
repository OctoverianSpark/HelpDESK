<div class="container-doc-header">

   <div class="container-img">

      <img src="/build/img/LOGO.png" alt="A" class="img-title">
   </div>
   <h1>GESTI&Oacute;N AUTOMATIZACI&Oacute;N, TECNOLOG&Iacute;A, E INFORMATICA <br> ORDEN DE RECEPCI&Oacute;N DE EQUIPOS <br> INFORMATICOS</h1>
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
         <p>Fecha de Emisi&oacute;n: <?php echo date("d / m / Y", strtotime($order->emitted_date)) ?></p>
         <p>Empresa: Asistente Virtual <?php echo $_POST["sede"] != "avca"?"S.A.S.":"C.A." ?></p>
         <p>Cargo: <?php echo ucwords(strtolower($usr->cargo)) ?> </p>
      </div>
      <div class="container-data">
         <p>C&oacute;digo: <?php echo $order->order_id ?></p>
         <p>Empleado: <?php echo ucwords(strtolower("$usr->nombre $usr->apellido")) ?></p>
         <p>Departamento: <?php echo ucwords(strtolower($usr->area)) ?></p>

      </div>

   </div>




   <p>
      Mediante el presente documento, Asistente Virtual <?php echo $_POST["sede"] != "avca"?"S.A.S.":"C.A." ?> confirma la recepción de los equipos y accesorios informáticos descritos en el punto 2 al usuario(a) <?php echo ucwords(strtolower("$usr->nombre $usr->apellido")) ?>, identificado con <?php echo $usr->tipo_documento . " " . $usr->documento ?>. Esto se debe a la finalización de su relación laboral con la empresa.
   </p>
   <p>
      El Departamento de Automatización, Tecnología e Informática se encargará de la recolección de los equipos y accesorios en las instalaciones de la empresa. El técnico, junto con el usuario, se compromete a verificar que tanto el equipo como los accesos y credenciales asignados estén en correcto funcionamiento y orden.
   </p>




</div>

<h2><b>1. CHECK LIST DE RECEPCI&Oacute;N DE EQUIPO</b></h2>
<p>
   A continuación, se describen los ítems que debe tener el usuario para realizar la entrega:
</p>

<div class="container-doc-checks">
   <div class="checks-1">
      <label for="client-access" class="checkbox-label">
         <input type="checkbox" id="client-access" checked>
         <span>ACCESOS Y CREDENCIALES DEL CLIENTE</span>
      </label>
      <label for="corporate-email" class="checkbox-label">
         <input type="checkbox" id="corporate-email" checked>
         <span>CORREO CORPORATIVO</span>
      </label>
      <label for="tools-list" class="checkbox-label">
         <input type="checkbox" id="tools-list" checked>
         <span>LISTADO DE HERRAMIENTAS UTILIZO CON EL CLIENTE</span>
      </label>
      <label for="optimal-computer" class="checkbox-label">
         <input type="checkbox" id="optimal-computer" checked>
         <span>FUNCIONAMIENTO ÓPTIMO DEL COMPUTADOR</span>
      </label>
      <label for="optimal-headset" class="checkbox-label">
         <input type="checkbox" id="optimal-headset" checked>
         <span>FUNCIONAMIENTO ÓPTIMO DE DIADEMAS</span>
      </label>
      <label for="optimal-mouse" class="checkbox-label">
         <input type="checkbox" id="optimal-mouse" checked>
         <span>FUNCIONAMIENTO ÓPTIMO DE MOUSE</span>
      </label>
      <label for="optimal-charger" class="checkbox-label">
         <input type="checkbox" id="optimal-charger" checked>
         <span>FUNCIONAMIENTO ÓPTIMO DE CARGADOR</span>
      </label>
   </div>


</div>

<div class="container-doc-header">

   <div class="container-img">

      <img src="/build/img/LOGO.png" alt="A" class="img-title">
   </div>
   <h1>GESTI&Oacute;N AUTOMATIZACI&Oacute;N, TECNOLOG&Iacute;A, E INFORMATICA <br> ORDEN DE RECEPCION DE EQUIPOS <br> INFORMATICOS</h1>
   <div class="metadata">

      <p><b>C&oacute;digo: </b> GATI-FT-01</p>
      <p><b>Versi&oacute;n: </b> 01</p>
      <p><b>Fecha: </b> <?php echo date("d / m / Y") ?></p>
      <p><b>P&aacute;gina: </b>2 de 2</p>

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
   foreach ($pers as $key => $value) {
   ?>

      <div class="table-row">
         <div class="cell cell-no"><?php echo $i++ ?></div>
         <div class="cell"><?php echo str_replace("-", " ", strtoupper($key)) ?></div>
         <div class="cell"><?php echo strtoupper($pers[$key]["marca"]) ?></div>
         <div class="cell"><?php echo strtoupper($pers[$key]["modelo"]) ?></div>
         <div class="cell"><?php echo strtoupper($pers[$key]["serial"]) ?></div>
         <div class="cell">N / A </div>
         <div class="cell">
            <input type="text">
         </div>
      </div>
   <?php } ?>


</div>


<h2><b>3. RESPONSABILIDAD DEL EMPLEADO</b></h2>

<p>
   Al firmar este documento, el firmante certifica que los equipos y accesorios se encuentran en perfecto estado físico y funcional. Asimismo, se compromete a responder por cualquier daño o pérdida que sufran los mismos.
</p>




<div class="container-signs">



   <div class="user-sign">



      <h4>Firma del Usuario</h4>


      <canvas class="sign-canvas">

      </canvas>



      <p><b>Nombre: </b><span><?php echo ucwords(strtolower($usr->nombre . " " . $usr->apellido)) ?></span></p>
      <p><b>Identificaci&oacute;n: </b> <span><?php echo $usr->tipo_documento . " " . $usr->documento ?></span></p>
      <p><b>Tel&eacute;fono:</b> <span><?php echo $usr->telefono ?></span></p>
      <p><b>Correo electr&oacute;nico: </b><span><?php echo $usr->correo ?></span></p>
      <p><b>Fecha:</b> <?php echo date("d / m / Y") ?></p>

   </div>

   <div class="admin-sign">



      <h4>Firma del representante de la Empresa</h4>

      <img src="/build/img/firma.png" alt="">



      <p><b>Nombre: </b><span>Jeandry de Jesus Rodriguez Zerpa</span></p>
      <p><b>Identificaci&oacute;n: </b> <span>CC 1034313186</span></p>
      <p><b>Fecha:</b> <?php echo date("d / m / Y") ?></p>

   </div>











</div>