



<main class="order-printable">
    
    <header class="container-order-title">
        
        <h1 class="orders-title">CONSTANCIA DE ORDEN DE <?php echo strtoupper($orden->tipo) ?> <span>ASISTENTE VIRTUAL S.A.S</span>
        <span class="references">NUMERO DE CONSECUTIVO #<?php echo $orden->id ?></span>
        <span class="references">TELEFONO 3146308945</span>
        <span class="references">KR 101A #152A-74</span>
        <span class="references">N.I.T 901572281-5</span>
        <?php if($orden->tipo === "salida"){ ?>
            <h2 class="orders-subtitle">ORDEN CON VIGENCIA HASTA <span><?php echo $orden->fecha_retorno ?></span></h2>
        <?php } ?>
        </h1>
    
    </header>
    
    <div class="container-order">
    
    
    
        <p class="reference-text">
            Ref. <?php echo ucwords($orden->tipo) ?> de Equipamiento
        </p>
    
        <p class="text-order">
            
            Por medio de la presente, La empresa <span>ASISTENTE VIRTUAL S.A.S.</span> autoriza al Usuario(a) <span id="username"><?php echo $orden->nombre ?></span> portador del documento <span> <?php echo $usuario->tipo_documento . " " . $usuario->documento ?> </span> el prestamo del equipo con el nombre <span> <?php echo $orden->equipo ?> </span> y los perifericos que lo acompañan <span>(ANEXO DE EQUIPOS EN LA SIGUIENTE PAGINA)</span>,  estos equipos seran despachados por el <span>DEPARTAMENTO DE GESTIONES INFORMATICAS</span> y aprobado por la <span>DEPARTAMENTO DE COORDINACION Y LOGISTICA</span> para gestionar sus traslado dentro y fuera del pais para realizar sus actividades y retornar la siguiente semana con el equipo desde el momento en que esta orden entro en vigencia
    
        </p>
    
    
    </div>
    
    <div class="firmas">
    
    
        <div class="container-firma">
            <p class="text-order"><span>Usuario del Equipo</span></p>
            <source srcset="/build/img/firma.webp" type="image/webp">
            <img src="" alt="Firma" id="firma-empleado">
            <div class="barra-firma"></div>
                <p class="text-order"><span>Jean Paul Rodriguez Zerpa</span></p>
        </div>
        <div class="container-firma">
        <p class="text-order"><span>Jeandry de Jesus Rodriguez Zerpa</span></p>
            <picture>
                <source srcset="/build/img/firma.webp" type="image/webp">
                <img src="/build/img/firma.png" alt="Firma">
            </picture>
            <p class="text-order"><span>CEO de Asistente Virtual</span></p>
        </div>
    </div>
    
<div class="computer-data">


    <h1 class="orders-title">DATOS DEL COMPUTADOR</h1>

    <div class="container-equipo-info">
        <div class="container-data-value">
            <h3 class="title">TIPO</h3>
            <p class="name"><?php echo $equipo->tipo ?></p>
        </div>
        <div class="container-data-value">
            <h3 class="title">MARCA</h3>
            <p class="name"><?php echo $equipo->marca ?></p>
        </div>
        <div class="container-data-value">
            <h3 class="title">MODELO</h3>
            <p class="name"><?php echo $equipo->modelo ?></p>
        </div>
        <div class="container-data-value">
            <h3 class="title">COLOR</h3>
            <p class="name"><?php echo $equipo->color ?></p>
        </div>
        <div class="container-data-value">
            <h3 class="title">NOMBRE EQUIPO</h3>
            <p class="name"><?php echo $equipo->nombre_equipo ?></p>
        </div>
        <div class="container-data-value">
            <h3 class="title">SERIAL</h3>
            <p class="name"><?php echo $equipo->serial ?></p>
        </div>
    </div>
    


    <?php if(!empty($perifericos)){ ?>
        <h1 class="orders-title">DATOS DE LOS PERIFERICOS ADJUNTOS AL COMPUTADOR</h1>
        <div class="container-equipo-info">

                <h3 class="title">TIPO</h3>
                <h3 class="title">MARCA</h3>
                <h3 class="title">MODELO</h3>
                <h3 class="title">COLOR</h3>
                
                <?php foreach($perifericos as $periferico){ ?>
                    <p class="name"><?php echo $periferico->tipo ?></p>
                    <p class="name"><?php echo $periferico->marca ?></p>
                    <p class="name"><?php echo $periferico->modelo ?></p>
                    <p class="name"><?php echo $periferico->color ?></p>
                <?php } ?>
        </div>
    
    <?php } ?>

    <p class="text-order">
        Al firmar este documento el usuario manifiesta su compromiso con <span>ASISTENTE VIRTUAL</span> de cuidar y devolver dichos activos descritos en la epigrafe propiedad de la empresa en <span>buen estado fisico y de funcionamiento</span> dando garantia de que si el equipo llega a sufrir <span>daños o perdida parcial o total</span> respondera a la empresa por los equipos suministrados
    </p>
</div>
    
    
</main>
    


<script>
    
    if (window.opener) {
            document.querySelector("#firma-empleado").src = window.opener.obtenerImagen();

            console.log("Hola")
    }
</script>