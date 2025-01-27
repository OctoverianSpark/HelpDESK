<main class="login-page">



    <canvas class="loginCanvas">


    </canvas>


    <div class="container-bg">

        <form method="post" class="login-form">
            <h1 class="logo">HELP<span>DESK</span></h1>


            <a href="/redirect" class="btn google-btn">Iniciar sesion con Google <i class="bi bi-google"></i></a>
            <label for="username" class="input-group">
                <span>Usuario</span>
                <input type="text" name="user" id="username" placeholder="Usuario de la Computadora" required>
            </label>

            <label for="psswrd" class="input-group psswrd-group">
                <span>Contraseña</span>
                <div class="container-psswrd-input">
                    <input type="password" name="password" id="psswrd" placeholder="Contraseña" required>
                    <button class="btn pswrd-btn" type="button">

                        <i class="bi bi-eye-slash-fill"></i>

                    </button>
                </div>
            </label>



            <button class="btn login-btn">Iniciar Sesi&oacute;n</button>

        </form>

    </div>



</main>