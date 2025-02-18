<main class="doc-order">

   <div class="modal data-form hidden">

      <form method="post" class="sign-form">
         <input type="hidden" name="order_id" value="<?php echo $order->id ?>">
         <label for="sign" class="canvas-group">
            <h2>Coloca tu firma</h2>
            <canvas class="sign-canvas-replica" width="1200px" height="400px"></canvas>

            <div class="container-input-flex">

               <input type="text" name="sign" id="sign" placeholder="Firmar como: <?php echo ucwords(strtolower($_SESSION["name"])) ?>" autocomplete="off" required>
               <button type="submit" class="btn btn-send">Firmar <i class="bi bi-feather"></i></button>
            </div>
         </label>


      </form>

   </div>

   <?php include __DIR__ . "\\..\\..\\templates\\docs\\" . $type . ".php" ?>


   <div class="container-signs">



      <div class="user-sign">



         <h4>Firma del Usuario</h4>

         <button type="button" class="sign-button" id="sign-button">

            Firma aqui <i class="bi bi-arrow-down"></i>

         </button>


         <p><b>Nombre: </b><span><?php echo ucwords(strtolower($usr->nombre . " " . $usr->apellido)) ?></span></p>
         <p><b>Identificaci&oacute;n: </b> <span><?php echo $usr->tipo_documento . " " . $usr->documento ?></span></p>
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
</main>