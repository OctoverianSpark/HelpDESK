    <h1 class="title">Hola <?php echo ucfirst($_SESSION["name"]) ?></h1>

    <div class="card-container">

        <div class="card">
            <div class="banner-image banner-novelties">
                <img srcset="build/img/novelties.jpg" alt="" type="image/jpg">
                <h2>Novedades</h2>
            </div>
            <?php foreach ($novedades as $novedad) { ?>

                <div class="content">
                    <h2><?php echo $novedad->titulo ?></h2>
                    <p><?php echo $novedad->contenido ?></p>
                </div>

            <?php } ?>
        </div>
        <div class="card">
            <div class="banner-image banner-recomendations">
                <img src="build/img/recomendations.jpeg" alt="">
                <h2>Recomendaciones</h2>

            </div>
            <?php foreach ($recomendaciones as $recomendacion) { ?>

                <div class="content">
                    <h2><?php echo $recomendacion->titulo ?></h2>
                    <p><?php echo $novedad->contenido ?></p>
                </div>

            <?php } ?>
        </div>

    </div>