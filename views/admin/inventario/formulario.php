    <div class="container-data">
        <fieldset class="user-data">

            <legend>Datos del Usuario</legend>

            <div class="container-input">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="inventario[nombre]" value="<?php echo s($inventario->nombre) ?>">
            </div>
            <div class="container-input">
                <label for="apellido">Apellido</label>
                <input type="text" id="apellido" name="inventario[apellido]" value="<?php echo s($inventario->apellido) ?>">
            </div>
            <div class="container-input">
                <label for="tipo_documento">Tipo de Documento</label>
                <select type="text" id="tipo_documento" name="inventario[tipo_documento]">
                    <option value="ppt" <?php echo ($inventario->tipo_documento==="ppt") ? "selected":""?>>Permiso de Proteccion Temporal</option>
                    <option value="cc" <?php echo ($inventario->tipo_documento=="cc") ? "selected":""?>>Cedula Colombiana</option>
                    <option value="pasaporte" <?php echo ($inventario->tipo_documento =="pasaporte") ? "selected":""?>>Pasaporte</option>
                    <option value="cv" <?php echo ($inventario->tipo_documento=="cv") ? "selected":""?>>Cedula Venezolana</option>
                    <option value="ce" <?php echo ($inventario->tipo_documento=="ce") ? "selected":""?>>Cedula Extranjería</option>
                </select>
            </div>
            <div class="container-input">
                <label for="documento">Documento</label>
                <input type="text" id="documento" name="inventario[documento]" value="<?php echo s($inventario->documento) ?>">
            </div>
            <div class="container-input">
                <label for="telefono">Telefono</label>
                <input type="text" id="telefono" name="inventario[telefono]" value="<?php echo s($inventario->telefono) ?>">
            </div>

            <div class="container-input">
                <label for="correo">Correo del Asistente</label>
                <input type="email" id="correo" name="inventario[correo]" value="<?php echo s($inventario->correo) ?>">
            </div>

        </fieldset>

        <fieldset class="computer-data">

            <legend>Datos del Computador</legend>
            
            
            <p>Tipo de Equipo</p>
            <div class="container-input radio">
                <div class="container-radio-input">
                    <label for="radioPC">PC</label>
                    <input type="radio" id="radioPC" name="inventario[tipo]" value="pc" <?php echo ($inventario->tipo == "pc") ? "checked" :"" ?> >
                </div>
                <div class="container-radio-input">
                    <label for="radioLaptop">Laptop</label>
                    <input type="radio" id="radioLaptop" name="inventario[tipo]" value="laptop" <?php echo ($inventario->tipo == "laptop") ? "checked" :""?> >
                </div>
            </div>
            <div class="container-input">
                <label for="nombre-equipo">Nombre del equipo</label>
                <input type="text" id="nombre-equipo" name="inventario[nombre_equipo]" value="<?php echo s($inventario->nombre_equipo) ?>">
            </div>
            <div class="container-input">
                <label for="marca">Marca</label>
                <input type="text" id="marca" name="inventario[marca]" value="<?php echo s($inventario->marca) ?>">
            </div>
            <div class="container-input">
                <label for="modelo">Modelo</label>
                <input type="text" id="modelo" name="inventario[modelo]" value="<?php echo s($inventario->modelo) ?>">
            </div>
            <div class="container-input">
                <label for="color">Color</label>
                <input type="text" id="color" name="inventario[color]" value="<?php echo s($inventario->color) ?>">
            </div>
            <div class="container-input">
                <label for="serial">Serial</label>
                <input type="text" id="serial" name="inventario[serial]" value="<?php echo s($inventario->serial) ?>">
            </div>
            <div class="container-input">
                <label for="anydesk">Anydesk</label>
                <input type="text" id="anydesk" name="inventario[anydesk]" value="<?php echo s($inventario->anydesk) ?>">
            </div>
            <div class="container-input">
                <label for="password_anydesk">Contraseña de Anydesk</label>
                <input type="text" id="password_anydesk" name="inventario[password_anydesk]" value="<?php echo s($inventario->password_anydesk) ?>">
            </div>
            <div class="container-input">
                <label for="usuarioPC">Usuario del Dominio</label>
                <input type="text" id="usuarioPC" name="inventario[usuarioPC]" value="<?php echo s($inventario->usuarioPC) ?>">
            </div>

            <div class="container-input">
                <label for="propietario">Propietario</label>
                <select type="text" id="propietario" name="inventario[propietario]">
                    <option value="AVSAS" <?php echo($inventario->propietario==="AVSAS") ? "selected" : ""?>>AVSAS</option>
                    <option value="Rentadvisor" <?php echo($inventario->propietario==="Rentadvisor") ? "selected":""?>>Rentadvisor</option>
                    <option value="Lacloud" <?php echo($inventario->propietario==="Lacloud") ? "selected" : ""?>>Lacloud</option>
                </select>
            </div>
            <div class="container-input">
                <label for="sede">Sede</label>
                <select type="text" id="sede">
                    <option value="AVSAS"<?php if($inventario->sede === "AVSAS") ?> >AVSAS</option>
                    <option value="AVCA"<?php if($inventario->sede === "AVCA") ?> >AVCA</option>
                </select>
            </div>

        </fieldset>
    </div>
    <div class="container-periferals">
        <div class="add-remove">
            <button type="button" class="boton-morado-inline" id="addButton">Añadir Periferico <i class='bx bxs-plus-circle' ></i></button>
            <button type="button" class="boton-rojo-inline" id="removeButton">Remover Periferico <i class='bx bxs-minus-circle' ></i></button>
        </div>
        <?php if(!empty($perifericos)){ ?>
                <?php $counts = 0?>
                <?php foreach($perifericos as $periferico): ?>
                <fieldset id="fieldset-periferico" >
                    <legend>Datos del Periferico</legend>
                    <div class="container-input">
                        <label for="tipo_periferico">Tipo de Periferico</label>
                        <select name="perifericos[<?php echo $counts ?>][tipo]" id="tipo_periferico">
                            <option value="MONITOR" <?php echo ($periferico->tipo === "monitor") ? "selected": "" ?>>Monitor</option>
                            <option value="MOUSE" <?php echo ($periferico->tipo === "mouse") ? "selected": "" ?>>Mouse</option>
                            <option value="TECLADO" <?php echo ($periferico->tipo === "teclado") ? "selected": "" ?>>Teclado</option>
                            <option value="DIADEMAS" <?php echo ($periferico->tipo === "diademas") ? "selected": "" ?>>Diademas</option>
                        </select>
                    </div>

                    <div class="container-input">
                        <label for="marca_periferico">Marca</label>
                        <input type="text" id="marca_periferico" name="perifericos[<?php echo $counts ?>][marca]" value="<?php echo s($periferico->marca) ?>">
                    </div>
                    
                    <div class="container-input">
                        <label for="modelo_periferico">Modelo</label>
                        <input type="text" id="modelo_periferico" name="perifericos[<?php echo $counts ?>][modelo]" value="<?php echo s($periferico->modelo) ?>">
                    </div>
                    <div class="container-input">
                        <label for="color_periferico">Color</label>
                        <input type="text" id="color_periferico" name="perifericos[<?php echo $counts ?>][color]" value="<?php echo s($periferico->color) ?>">
                    </div>
                    <div class="container-input">
                        <label for="serial_periferico">Serial</label>
                        <input type="text" id="serial_periferico" name="perifericos[<?php echo $counts ?>][serial]" value="<?php echo s($periferico->serial) ?>">
                    </div>
                    <input id="input-hidden" type="hidden" name="perifericos[<?php echo $counts ?>][id]" value="<?php echo $periferico->id ?>">

                </fieldset>
            <?php $counts++ ?>
            <?php endforeach ?>
        <?php }?>
            
            <fieldset style="display:none;" id="fieldset-tmplate" >
                <legend>Datos del Periferico</legend>
                <div class="container-input">
                    <label for="tipo_periferico">Tipo de Periferico</label>
                    <select  id="tipo_periferico">
                        <option value="MONITOR">Monitor</option>
                        <option value="MOUSE">Mouse</option>
                        <option value="TECLADO">Teclado</option>
                        <option value="DIADEMAS">Diademas</option>
                    </select>
                </div>

                <div class="container-input">
                    <label for="marca_periferico">Marca</label>
                    <input type="text" id="marca_periferico" >
                </div>
                
                <div class="container-input">
                    <label for="modelo_periferico">Modelo</label>
                    <input type="text" id="modelo_periferico" >
                </div>
                <div class="container-input">
                    <label for="color_periferico">Color</label>
                    <input type="text" id="color_periferico" >
                </div>
                <div class="container-input">
                    <label for="serial_periferico">Serial</label>
                    <input type="text" id="serial_periferico">
                </div>

            </fieldset>
    </div>



