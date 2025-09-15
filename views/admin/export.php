<h1 class="title">Administrador</h1>

<form method="post" action="/admin/export" class="exports-form container-grid">

    <label class="input-group">
        <span>Exportar</span>
        <select name="export">
            <option value="inventario">Inventario</option>
            <option value="tickets">Tickets</option>
            <option value="mantenimientos">Mantenimientos</option>
            <option value="logs">Logs</option>
            <option value="personal">Personal</option>
            <option value="agent_tickets">Tickets de Agente</option>
        </select>
    </label>

    <button type="submit" class="btn primary-btn">Exportar <i class="bi bi-file-earmark-arrow-down"></i></button>
</form>