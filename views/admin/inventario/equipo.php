<main class="main-container">
        <h1 class="title-inv"><?php echo $equipo->nombre_equipo ?></h1>

        <div class="container-user-data">
            <div class="container-data">
                <h2><?php echo "ASIGNADO A: ". $equipo->nombre . " " . $equipo->apellido ?></h2>
                <h2><?php echo "DOCUMENTO: ". $equipo->tipo_documento . " " . $equipo->documento ?></h2>
                <h2><?php echo "CORREO: ". strtoupper($equipo->correo) ?></h2>
            </div>
        </div>
        <div class="container-computer-data">
            
            <div class="container-data">
                <h2><?php echo "MARCA: ". $equipo->marca?></h2>
                <h2><?php echo "MODELO: ". $equipo->modelo?></h2>
            </div>
            <h2><?php echo "SERIAL: " . $equipo->serial?></h2>
            <h2><?php echo "COLOR: ". $equipo->color?></h2>

        </div>
        <?php if(!empty($perifericos)): ?>
                <h2 class="title-per">PERIFERICOS</h2>
                <div class="container-periferal-data">
            <?php foreach($perifericos as $periferico): ?>
                <div class="data-perifericos">
                    <h2><?php echo strtoupper($periferico->tipo) ?></h2>
                    <h2><?php echo "MARCA: ".$periferico->marca ?></h2>
                    <h2><?php echo "MODELO: ".$periferico->modelo ?></h2>
                    <h2><?php echo "COLOR: ".$periferico->color ?></h2>
                    <h2><?php echo "SERIAL: ".$periferico->serial ?></h2>
                </div>
            <?php endforeach?>
                </div>
        <?php endif ?>
        
</main>