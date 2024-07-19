<main>

    <h1>Actualizar <?php echo (isset($_GET["type"]))?$_GET["type"]:$entrada->tipo ?></h1>
    <form method="post" enctype="multipart/form-data" class="form-entry">


        
        <?php include "formulario.php" ?>

        <input type="submit" value="Cargar" class="boton-morado-inline">

    </form>






</main>