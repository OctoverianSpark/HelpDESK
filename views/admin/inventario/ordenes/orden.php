
<div class="container-orden">
            <h2>Orden de <?php echo (is_null($_GET["type"])) ? $orden->tipo : $_GET["type"] ?></h2>

            <h3 class="letter-black spaced-2 little-subtitle">Referencia de <?php echo $_GET["type"] ?> de Equipamiento</h3>
            
            <?php if( ucwords($_GET["type"]??$orden->tipo) === "Entrega"){ ?>
                
                <p class="description-1">Por medio de la presente acta, se hace entrega de los siguientes equipos y accesorios:</p>
            <?php }else if( ucwords($_GET["type"]??$orden->tipo) === "Salida"){ ?>
                
                <p class="description-1">Por medio de la presente, La empresa ASISTENTE VIRTUAL S.A.S. autoriza al  Usuario(a) <span><?php echo ($_GET["nombre"] === "same")? $equipo->nombre . " " . $equipo->apellido : $_GET["nombre"] ?></span> el prestamo de los siguientes equipos informaticos que seran despachados por el DEPARTAMENTO DE GESTIONES INFORMATICAS y aprobado por la <span>GERENCIA DE ADMINISTRACION Y TALENTO HUMANO</span>  para gestionar sus traslado dentro y fuera del pais para desempeñar actividades:</p>
                
            <?php }else if( ucwords($_GET["type"]??$orden->tipo) === "Recepcion"){ ?>
                
                <p class="description-1">Por medio de la presente acta, se hace recepcion de la siguiente equipos y accesorios:</p>

            <?php } ?>


            <h3>Datos del Equipo con el nombre <span><?php echo $equipo->nombre_equipo ?></span></h3>
            <table class="tabla-ordenes">
                <thead>
                    <th scope="col">Tipo de Equipo</th>
                    <th scope="col">Marca</th>
                    <th scope="col">Modelo</th>
                    <th scope="col">Color</th>
                    <th scope="col">Serial</th>




                </thead>
                <tbody>
                    <tr>
                        <th scope="row"><?php echo $equipo->tipo ?></th>
                        <td><?php echo $equipo->marca ?></td>
                        <td><?php echo $equipo->modelo ?></td>
                        <td><?php echo $equipo->color ?></td>
                        <td><?php echo $equipo->serial ?></td>
                    <tr>
                    <?php foreach($perifericos as $periferico): ?>
                        <tr>
                            <th scope="row"><?php echo $periferico->tipo ?></th>
                            <td><?php echo $periferico->marca ?></td>
                            <td><?php echo $periferico->modelo ?></td>
                            <td><?php echo $periferico->color ?></td>
                            <td><?php echo $periferico->serial ?></td>
                        </tr>
                    <?php endforeach ?>
                    
                </tbody>
            </table>
            <?php if( ucwords($_GET["type"]??$orden->tipo) === "Salida"){ ?>
                <p class = "description-2">El colaborador <span><?php echo ($_GET["nombre"] === "same")? $equipo->nombre . " " . $equipo->apellido : $_GET["nombre"] ?></span> confirma que ha recibido del <span>DEPARTAMENTO DE INFORMATICA DE LA EMPRESA ASISTENTE VIRTUAL S.A.S</span> equipos informaticos descritos en este epigrafe , con los cuales realizará sus actividades y funciones laborales dentro y fuera del pais, por lo cual me comprometo a cuidar y devolver dichos activos  propiedad de esta empresa en buen estado fisico y de funcioneamiento tal como se me han sido entregados, dando garantia de que  si el equipo llega a sufrir daño o perdida parcial o total respondere ante la empresa por los equipos suministrados.</p>
            <?php }else if( ucwords($_GET["type"]??$orden->tipo) === "Entrega"){ ?>
                <p class = "description-2">El colaborador <span><?php echo ($_GET["nombre"] === "same")? $equipo->nombre . " " . $equipo->apellido : $_GET["nombre"] ?></span> confirma que ha recibido del <span>DEPARTAMENTO DE INFORMATICA DE LA EMPRESA ASISTENTE VIRTUAL S.A.S</span> equipos informaticos descritos en este epigrafe , con los cuales realizará sus actividades y funciones laborales dentro y fuera del pais, por lo cual me comprometo a cuidar y devolver dichos activos  propiedad de esta empresa en buen estado fisico y de funcioneamiento tal como se me han sido entregados, dando garantia de que  si el equipo llega a sufrir daño o perdida parcial o total respondere ante la empresa por los equipos suministrados.</p>




            <?php }else if( ucwords($_GET["type"]??$orden->tipo) === "Recepcion"){ ?>
                <p class = "description-2">El colaborador <span><?php echo ($_GET["nombre"] === "same")? $equipo->nombre . " " . $equipo->apellido : $_GET["nombre"] ?></span> devuelve a la empresa <span>ASISTENTE VIRTUAL S.A.S</span>, dentro de la fecha establecida,  equipo y accesorios pertenecientes a la empresa para ejecutar las actividades establecidas en el proceso de prestacion de servicio.  dando garantia de que si el equipo llega a sufrir daño o perdida parcial o total el usuario prestador del servicio al cual se le asigno el equipo respondera ante la empresa por los equipos suministrados. En consecuencia, autoriza expresamente a la empresa mediante este documento a descontarme de salarios ,liquidación de prestaciones sociales u honorarios profesionales, los valores de los equipos cuando en cualquiera de los casos anteriores no sea devuelta a la empresa, por daños provocados o mal uso de los mismos.</p>
            <?php }?>

            
</div>
    <form method="post" class="firma-orden">
        <div class="container-input-sign">
            <input type="checkbox" name="accepted" id="accept">
            <label for="accept">Al dar click en esta casilla aceptas los terminos que fueron descritos en la orden arriba</label for="accept">
        </div>
        <div class="container-input-sign">
            <label for="nameSign">Firma con tu nombre: <?php echo ($_GET["nombre"] === "same")? $equipo->nombre . " " . $equipo->apellido : $_GET["nombre"]?? $orden->nombre ?></label>
            <input type="text" id="nameSign" name="nameSign" disabled>
        </div>
        <input class="boton-morado-inline" type="submit" value="Firmar">
    </form>