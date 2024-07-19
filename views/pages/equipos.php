<main class="contenedor-perfil">



    <aside class="sidebar">
        <img src="<?php echo $_SESSION["picture"] ?>" class="profile-image" alt="">
        <?php foreach($equipos as $equipo): ?>
                <?php if(!isset($times)): ?>
                    <h2>Nombre</h2>
                    <p><?php echo s($equipo->nombre . " " . $equipo->apellido) ?></p>
                    <h2>Documento</h2>
                    <p><?php echo s($equipo->tipo_documento . " " . $equipo->documento) ?></p>
                    <h2>Correo</h2>
                    <p><?php echo s(strtoupper($equipo->correo)) ?></p>
                    <h2>Telefono</h2>
                    <p><?php echo s(strtoupper($equipo->telefono)) ?></p>
                <?php endif ?>
                <?php $times = 1 ?>
        <?php endforeach ?>

    </aside>

    <?php foreach($equipos as $equipo): ?>
        <div class="machine">
                    <h2><?php echo $equipo->tipo ?></h2>

                    <div class="title">
                        <h3>Marca</h3>
                        <p><?php echo $equipo->marca ?></p>
                    </div>
                    <div class="title">
                        <h3>Modelo</h3>
                        <p><?php echo $equipo->modelo ?></p>
                    </div>
                    <div class="title">
                        <h3>Color</h3>
                        <p><?php echo $equipo->color ?></p>
                    </div>
                    <div class="title">
                        <h3>Nombre del equipo</h3>
                        <p><?php echo $equipo->nombre_equipo ?></p>
                    </div>
                    <div class="title">
                        <h3>Serial</h3>
                        <p><?php echo $equipo->serial ?></p>
                    </div>
        </div>
    <?php endforeach ?>
    <?php foreach ($perifericos as $periferico) { ?>
        <?php foreach($periferico as $per): ?>
            <div class="<?php echo strtolower($per->tipo) ?> periferico">
                <h2><?php echo $per->tipo ?></h2>
                    <div class="title">
                        <h3>Marca</h3>
                        <p><?php echo $per->marca ?></p>
                    </div>
                    <div class="title">
                        <h3>Modelo</h3>
                        <p><?php echo $per->modelo ?></p>
                    </div>
                    <div class="title">
                        <h3>Color</h3>
                        <p><?php echo $per->color ?></p>
                    </div>
                    <div class="title">
                        <h3>Serial</h3>
                        <p><?php echo $per->serial ?></p>
                    </div>
            </div>
        <?php endforeach ?>
            
    <?php } ?>



</main>


