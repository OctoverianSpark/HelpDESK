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
         <p>Fecha de Emisi&oacute;n: <?php echo date("d / m / Y",strtotime($order->emitted_date))?></p>
         <p>Empresa: Asistente Virtual</p>
         <p>Cargo: <?php echo ucwords(strtolower($usr->cargo)) ?> </p>
      </div>
      <div class="container-data">
         <p>C&oacute;digo: <?php echo $order->order_id ?></p>
         <p>Empleado: <?php echo ucwords(strtolower("$usr->nombre $usr->apellido")) ?></p>
         <p>Departamento: <?php echo ucwords(strtolower($usr->area)) ?></p>

      </div>

   </div>




   <p>Mediante el presente documento, Asistente Virtual <?php echo ($_POST["sede"] === "avsas" || $_POST["sede"] === "ops")?"S.A.S":"C.A" ?> se realiza la asignación de los siguientes equipos y accesorios informáticos descritos en el punto número 2 de este documento al usuario(a) <?php echo ucwords(strtolower("$usr->nombre $usr->apellido")) ?> con el número de identificación <?php echo "$usr->tipo_documento $usr->documento" ?>, esto con el fin de realizar sus labores asignadas en la empresa. El Departamento de Automatización, Tecnología e Informática realizará el despacho de los equipos y accesorios en las instalaciones de la empresa y el usuario se compromete a utilizar los equipos exclusivamente para fines laborales y a cuidarlos de acuerdo con las normas establecidas en el reglamento interno de la empresa. El usuario se compromete a cuidar y devolver estos activos, propiedad de la empresa, en buen estado físico y de funcionamiento, tal y como fueron entregados. </p>




</div>

<h2><b>1. CHECK LIST DE ENTREGA DE EQUIPO</b></h2>
<p>A continuaci&oacute;n, se describen los items que deben tener instalados y configurados y el estado en que est&aacute; siendo entregado el computador: </p>
<div class="container-doc-checks">

   <div class="checks-1">
      <label for="wps" class="checkbox-label">
         <input type="checkbox" id="wps" checked>
         <span>WPS (OFFICE)</span>
      </label>

      <label for="chrome-policies" class="checkbox-label">
         <input type="checkbox" id="chrome-policies" checked>
         <span>NAVEGADOR (CHROME) Y POLÍTICAS DE GOOGLE CHROME</span>
      </label>
      <label for="anydesk" class="checkbox-label">
         <input type="checkbox" id="anydesk" checked>
         <span>ANYDESK</span>
      </label>
      <label for="corporate-email" class="checkbox-label">
         <input type="checkbox" id="corporate-email" checked>
         <span>CORREO CORPORATIVO</span>
      </label>
      <label for="assistant-email" class="checkbox-label">
         <input type="checkbox" id="assistant-email" checked>
         <span>CORREO ASISTENTE VIRTUAL</span>
      </label>
      <label for="foxit" class="checkbox-label">
         <input type="checkbox" id="foxit" checked>
         <span>FOXIT READER (PDF)</span>
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


   </div>
   <div class="checks-2">

      <label for="vpn" class="checkbox-label">
         <input type="checkbox" id="vpn" checked>
         <span>VPN</span>
      </label>

      <label for="ring-central" class="checkbox-label">
         <input type="checkbox" id="ring-central" checked>
         <span>RING CENTRAL</span>
      </label>

      <label for="clowdwork" class="checkbox-label">
         <input type="checkbox" id="clowdwork" checked>
         <span>CLOWDWORK</span>
      </label>

      <label for="google-drive" class="checkbox-label">
         <input type="checkbox" id="google-drive" checked>
         <span>GOOGLE DRIVE</span>
      </label>

      <label for="lightshot" class="checkbox-label">
         <input type="checkbox" id="lightshot" checked>
         <span>LIGHTSHOT</span>
      </label>

      <label for="classroom" class="checkbox-label">
         <input type="checkbox" id="classroom" checked>
         <span>CLASSROOM</span>
      </label>

      <label for="terms-manual" class="checkbox-label">
         <input type="checkbox" id="terms-manual" checked>
         <span>MANUAL DE TÉRMINOS Y CONDICIONES DE USO DEL COMPUTADOR</span>
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
      foreach ($pers as $key => $value) { 
   ?>
      
      <div class="table-row">
         <div class="cell cell-no"><?php echo $i++ ?></div>
         <div class="cell"><?php echo strtoupper($key) ?></div>
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

<p>Al firmar este documento, el usuario manifiesta su compromiso con la empresa de cuidar y devolver los activos descritos en este anexo en buen estado físico y funcional. Además, garantiza que, en caso de que el equipo sufra daños o pérdidas, ya sean parciales o totales, asumirá la responsabilidad ante la empresa por los equipos mencionados.</p>




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