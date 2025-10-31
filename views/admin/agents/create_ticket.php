<h1 class="title">Ticket de Agente</h1>




<form method="POST" class="container-grid">


  <label for="agent_id" class="input-group">

    <span>Agente</span>

    <select name="agent_id" id="agent_id">
      <?php foreach ($agents as $agent) { ?>


        <option value="<?php echo $agent->id ?>" <?php echo $agent->id === $ticket->agent_id ? 'selected' : ''   ?>><?php echo $agent->name ?></option>


      <?php } ?>
    </select>



  </label>



  <div class="container-grid">


    <label class="input-group" for="subcat" title="Programas del Computador">
      <span>Asunto</span>
      <input type="text" name="subcategoria" id="subcat" value="<?php echo $ticket->subcategoria ?>" />
    </label>
  </div>




  <label for="tech_id" class="input-group">

    <span>Tecnico</span>

    <select name="tecnico_id" id="tech_id">
      <?php foreach ($techs as $tech) { ?>


        <option value="<?php echo $tech->id ?>" <?php echo $tech->id === $ticket->tecnico_id ? 'selected' : '' ?>><?php echo $tech->first_name . ' ' . $tech->last_name ?></option>


      <?php } ?>
    </select>



  </label>




  <label for="estado" class="input-group">

    <span>Estado</span>

    <select name="estado" id="estado">

      <option value="sin asignar" selected>Sin Asignar</option>
      <?php if ($ticket) { ?>
        <option value="en proceso">En Proceso</option>

        <option value="pendiente" <?php echo strtolower($ticket->estado) === 'sin asignar' ? 'disabled' : '' ?>>Pendiente</option>
        <option value="completado" <?php echo strtolower($ticket->estado) === 'sin asignar' ? 'disabled' : '' ?>>Completado</option>
      <?php } ?>
    </select>



  </label>





  <label for="descripcion" class="input-group">
    <span>Describe tu solicitud</span>
    <textarea placeholder="Coloca una descripcion detallada de tu solicitud" name="descripcion" id="descripcion" required><?php echo $ticket->descripcion ?></textarea>
  </label>

  <label for="solucion" class="input-group">
    <span>Comentario </span>
    <textarea name="solucion" id="solucion" required><?php echo $ticket->solucion ?></textarea>
  </label>


  <button class="btn primary-btn">Enviar</button>




</form>