<h1 class="title">Administrador</h1>

<form method="post" action="/admin/export" class="exports-form container-input">

    <label class="input-group">
        <span>Exportar</span>
        <select name="export" id="export-selector">
            <option value="inventario">Inventario</option>
            <option value="tickets">Tickets</option>
            <option value="mantenimientos">Mantenimientos</option>
            <option value="logs">Logs</option>
            <option value="polls">Encuestas</option>
        </select>
    </label>

    <button type="submit" class="btn btn-submit">Exportar <i class="bi bi-file-earmark-arrow-down"></i></button>
</form>