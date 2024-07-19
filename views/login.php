<main>


    <?php $mensaje = mostrarError($_GET["error"]);
    if ($mensaje){ ?>
        <div class="alerta error">
            <?php echo $mensaje ?>
        </div>
    <?php } ?>

    <h1>Inicia Sesión para acceder</h1>
    <div class="container-login">
        
        <form method="POST" class="inicio-sesion">
            <fieldset>
                <a href="/redirect" class="boton-google-inline"><i class='bx bxl-google'></i> Continuar con Google</a>
                <div class="divider-from-login">
                </div>

                <legend>Coloca aqui tu usuario y contraseña</legend>

                <label for="user">Usuario del Computador</label>
                <input type="text" id="user" name="login[user]">
                <label for="password">Contraseña de tu computador</label>
                <input type="password" name="login[password]" id="password">
                <input type="submit" value="Iniciar Sesion" class="boton-morado-block">
            </fieldset>
            

        </form>
    </div>





</main>