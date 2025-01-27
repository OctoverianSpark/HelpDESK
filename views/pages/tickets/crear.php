
<div class="modal info-modal">
    <h2 class="subtitle">Creando un Ticket</h2>

    <ul>
        <li>Selecciona el tipo de problema que presentas en tu computador</li>
        <li>Coloca una breve descripcion sobre la falla que este presenta</li>
        <li>Luego de la descripcion puedes colocar una imagen de referencia como un dato opcional a conectar</li>
        <li>Cuando se envia el ticket te llegará un correo a ti con la confirmacion de que se ha creado y un correo al departamento de A.T.I</li>
    </ul>

    <label for="close" class="close-modal">
        <p>Entendido</p>
        <input type="checkbox" id="close">
    </label>
</div>


<form method="POST" enctype="multipart/form-data">


    <h1>De que se trata tu solicitud?</h1>
    <div class="container-input-flex">
        

        <label class="radio-label-card" for="apps-radio" title="Programas del Computador">
            <input type="radio" name="categoria" id="apps-radio" value="Aplicaciones">
            <i class="bi bi-grid-fill"></i>
            <span>Aplicaciones del computador</span>
        </label>
        <label class="radio-label-card" for="computer-radio" title="">
            <input type="radio" name="categoria" id="computer-radio" value="equipo">
            <i class="bi bi-laptop-fill"></i>
            <span>Problemas fisicos</span>
        </label>
    </div>






    <label for="descripcion" class="label-input">
        <p>Describe tu solicitud</p>
        <textarea placeholder="Coloca una descripcion detallada de tu solicitud" name="descripcion" id="descripcion" required><?php echo $ticket->descripcion ?></textarea>
    </label>


    <label for="image" class="file-selector">
        <p><i class="bi bi-file-earmark-arrow-up-fill"></i>Agregar Imagen de referencia</p>
        <input type="file" name="imagen" id="image" accept="image/*">
    </label>


    <button class="btn btn-submit">Enviar</button>

</form>