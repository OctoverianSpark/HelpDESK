

<?php foreach($errores as $error): ?>
    <div class="alerta error">
        <?php echo $error ?>
    </div>
<?php endforeach  ?>

<main>

    <form method="post" class="formulario-inventario">
        
        <?php include "formulario.php" ?>
        
        <input type="submit" value="Enviar" class="boton-morado-inline">
    </form>
</main>