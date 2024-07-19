

<?php if (!is_null($tickets)) : ?>
            <h1><?php echo s($tickets->subcategoria) ?></h1>
            <div class="destacada">
                <img src="/referencias/<?php echo $tickets->imagen ?>" width="200" alt="Sin">
            </div>
            <div class="container">
                <div class="container-info">
                    <p>Descripcion:<?php echo "\n".s($tickets->descripcion) ?></p>
                    <p>Categoria: <?php echo s($tickets->categoria) ?></p>
                </div>
                <div class="container-tecnical">
                    <p>Estado de Ticket: <?php echo s(ucfirst($tickets->estado)) ?></p>
                    <p>Tecnico asignado: <?php echo s($tickets->tecnico) ?></p>
                </div>
            </div>
        <?php else:?>

            <h1>Ticket Inexistente</h1>
            <picture>
                <source srcset="build/img/sorryButNot.webp" type="image/webp">
                <img src="build/img/sorryButNot.png" alt="Error">
            </picture>
<?php endif?>