<div class="doc-order">

  <!-- =========================
       HEADER PÁGINA 1
       ========================= -->
  <div class="container-doc-header header-page-1">

    <div class="container-img">
      <img src="/build/img/LOGO.png" alt="Logo" class="img-title">
    </div>

    <h1>
      GESTIÓN AUTOMATIZACIÓN, TECNOLOGÍA, E INFORMÁTICA <br>
      ORDEN DE SALIDA DE EQUIPOS <br>
      INFORMÁTICOS
    </h1>

    <div class="metadata">
      <p><b>Código:</b> GATI-FT-03</p>
      <p><b>Versión:</b> 01</p>
      <p><b>Fecha:</b> <?php echo date("d / m / Y") ?></p>
      <p><b>Página:</b> 1 de 2</p>
    </div>

  </div>

  <!-- =========================
       CUERPO PÁGINA 1
       ========================= -->
  <div class="container-doc-body">

    <div class="container-data">
      <p><b>Código:</b> <?php echo s($order->order_id) ?></p>
    </div>

    <div class="container-main-data">

      <div class="container-data">
        <p><b>Fecha de Emisión:</b> <?php echo s(date("d / m / Y", strtotime($order->emitted_date))) ?></p>
        <p><b>Empresa:</b> Asistente Virtual S. A. S.</p>
        <p><b>Cargo:</b> <?php echo ucwords(strtolower(s($usr->job_title))) ?></p>
      </div>

      <div class="container-data">
        <p><b>Fecha de Retorno:</b>
          <?php
            echo (strtolower($order->return_date) === "no return")
              ? "Sin Retorno"
              : date("d / m / Y", strtotime($order->return_date));
          ?>
        </p>
        <p><b>Empleado:</b> <?php echo ucwords(strtolower(s($usr->first_name . " " . $usr->last_name))) ?></p>
        <p><b>Departamento:</b> <?php echo ucwords(strtolower(s($usr->area))) ?></p>
      </div>

    </div>

    <p>
      Mediante el presente documento, Asistente Virtual autoriza el préstamo, salida y traslado de los siguientes
      equipos y accesorios informáticos descritos en el punto 1 de este documento al usuario(a)
      <?php echo ucwords(strtolower(s($usr->first_name . " " . $usr->last_name))) ?>
      por un período de
      <?php
        echo (strtolower($order->return_date) === "no return")
          ? "tiempo indefinido"
          : calculateDays($order->emitted_date, $order->return_date) . " día(s)";
      ?>.
    </p>

    <p>
      El Departamento de Automatización, Tecnología e Informática realizará el despacho de los equipos y accesorios
      en las instalaciones de la empresa y el usuario se compromete a utilizarlos exclusivamente para fines laborales,
      cuidarlos y devolverlos en buen estado físico y funcional.
    </p>

  </div>

  <h2>1. DATOS DEL COMPUTADOR Y ACCESORIOS INFORMÁTICOS</h2>
  

  <!-- =========================
       TABLA (PÁGINA 1)
       ========================= -->
  <div class="doc-table">

    <div class="table-row table-header">
      <div class="header cell-no">N°</div>
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
      <div class="cell"><input type="text"></div>
    </div>

    <?php $i = 2; ?>
    <?php foreach ($pers as $per) { ?>
      <div class="table-row">
        <div class="cell cell-no"><?php echo $i++ ?></div>
        <div class="cell"><?php echo strtoupper($per->tipo) ?></div>
        <div class="cell"><?php echo strtoupper($per->marca) ?></div>
        <div class="cell"><?php echo strtoupper($per->modelo) ?></div>
        <div class="cell"><?php echo strtoupper($per->serial) ?></div>
        <div class="cell">N / A</div>
        <div class="cell"><input type="text"></div>
      </div>
    <?php } ?>

  </div>

  <!-- =========================
       SALTO DE PÁGINA
       ========================= -->
  <div class="page-break"></div>

  <!-- =========================
       PÁGINA 2
       ========================= -->
  <div class="page page-2">


    <!-- =========================
         HEADER INFERIOR PÁGINA 2
         ========================= -->
    <div class="container-doc-header header-page-2">

      <div class="container-img">
        <img src="/build/img/LOGO.png" alt="Logo">
      </div>

      <h1>
        GESTIÓN AUTOMATIZACIÓN, TECNOLOGÍA, E INFORMÁTICA <br>
        ORDEN DE SALIDA DE EQUIPOS <br>
        INFORMÁTICOS
      </h1>

      <div class="metadata">
        <p><b>Código:</b> GATI-FT-03</p>
        <p><b>Versión:</b> 01</p>
        <p><b>Fecha:</b> <?php echo date("d / m / Y") ?></p>
        <p><b>Página:</b> 2 de 2</p>
      </div>

    </div>

    
    <div class="page-content">

      <h2>2. RESPONSABILIDAD DEL EMPLEADO</h2>

      <p>
        Al firmar este documento, el usuario manifiesta su compromiso con la empresa de cuidar y devolver los activos
        descritos en este anexo en buen estado físico y funcional.
      </p>

      <p>
        Además, garantiza que, en caso de que el equipo sufra daños o pérdidas, asumirá la responsabilidad ante la
        empresa por los equipos mencionados.
      </p>

    </div>

  </div>

</div>
