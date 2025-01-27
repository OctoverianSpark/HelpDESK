<main class="order-generator">


   <form method="get" class="selection-form">

      <fieldset class="container-input-flex no-fieldset">

         <legend>Tipo de Orden</legend>

         <label for="entrega" class="radio-label-card">
            <input type="radio" name="type" id="entrega" value="entrega" <?php echo ($_GET["type"] === "entrega") ? "checked" : "" ?>>
            <i class="bi bi-person-fill-add"></i>
            <span>Entrega</span>
         </label>

         <label for="salida" class="radio-label-card">
            <input type="radio" name="type" id="salida" value="salida" <?php echo ($_GET["type"] === "salida") ? "checked" : "" ?>>
            <i class="bi bi-house-up-fill"></i>
            <span>Salida</span>
         </label>

         <label for="recepcion" class="radio-label-card">
            <input type="radio" name="type" id="recepcion" value="recepcion" <?php echo ($_GET["type"] === "recepcion") ? "checked" : "" ?>>
            <i class="bi bi-person-fill-dash"></i>
            <span>Recepcion</span>
         </label>

      </fieldset>
      <?php if($_GET["type"] !== "salida"){?>
         <fieldset class="container-input-flex no-fieldset">
            <legend>Estancia del Usuario</legend>

            <label class="radio-label-card">
               <input type="radio" name="sede" value="avsas" <?php echo ($_GET["sede"] === "avsas")?"checked":"" ?>>
               <i class="bi bi-house-door"></i>
               <span>Colombia</span>
            </label>
            <label class="radio-label-card">
               <input type="radio" name="sede" value="avca" <?php echo ($_GET["sede"] === "avca")?"checked":"" ?>>
               <i class="bi bi-airplane-fill"></i>
               <span>Venezuela</span>
            </label>
            <label class="radio-label-card">
               <input type="radio" name="sede" value="ops" <?php echo ($_GET["sede"] === "ops")?"checked":"" ?>>
               <i class="bi bi-headphones"></i>
               <span>OPS</span>
            </label>

         </fieldset>
      <?php }?>


   </form>


   <form action="/orden/print" method="post" class="ord-form">


      <?php if($_GET["type"]){ ?>

         

         <?php include "forms/" . $_GET["type"] . ".php" ?>


         <?php foreach($_GET as $key=>$value){ ?>
            <input type="hidden" name="<?php echo $key ?>" value="<?php echo $value ?>">
         <?php } ?>
      <?php } ?>

      <button class="btn btn-submit">Generar Orden <i class="bi bi-file-earmark-post-fill"></i></button>



   </form>

</main>