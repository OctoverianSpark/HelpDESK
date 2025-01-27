

<?php foreach($errores as $error): ?>
    <div class="alerta error">
        <?php echo $error ?>
    </div>
<?php endforeach  ?>

<main>

    <form method="post" class="inv-form">
        
        <?php include "formulario.php" ?>
        
        <button class="btn btn-submit">Enviar <i class="bi bi-floppy2-fill"></i></button>
    </form>
</main>