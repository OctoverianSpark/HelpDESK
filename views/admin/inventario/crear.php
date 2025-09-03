<?php foreach ($errores as $error): ?>
    <div class="alerta error">
        <?php echo $error ?>
    </div>
<?php endforeach  ?>
<h1 class="title">Registro de Inventario</h1>

<form method="post" class="inv-form container-grid">

    <?php include "formulario.php" ?>


    <button class="btn primary-btn">Enviar <i class="bi bi-floppy2-fill"></i></button>
</form>