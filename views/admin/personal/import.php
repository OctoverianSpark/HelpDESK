<h1 class="title">Importar personal desde Excel</h1>

<p>
    El archivo debe tener los encabezados en la primera fila (se ignoran) y las columnas en este orden:
    <strong>Nombre, Apellido, Tipo de Documento, Documento, Telefono, Correo, Cargo, Area, Contrato, Estado, Ubicacion</strong>.
</p>

<p>
    <a href="/admin/personal/import/template" class="btn primary-btn">Descargar plantilla <i class="bi bi-download"></i></a>
</p>

<?php if ($resultado): ?>
    <?php if ($resultado['ok']): ?>
        <div class="alerta exito">
            Importacion completada: <?= (int) $resultado['creados'] ?> creado(s), <?= (int) $resultado['actualizados'] ?> actualizado(s) (se empareja por Documento).
        </div>
        <?php if (!empty($resultado['errores'])): ?>
            <div class="alerta error">
                <p>Filas con error:</p>
                <ul>
                    <?php foreach ($resultado['errores'] as $error): ?>
                        <li><?= s($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
    <?php else: ?>
        <div class="alerta error">
            No se pudo leer el archivo: <?= s($resultado['error']) ?>
        </div>
    <?php endif; ?>
<?php endif; ?>

<form method="post" enctype="multipart/form-data" class="container-flex">
    <label for="archivo" class="input-group">
        <span>Archivo Excel (.xlsx)</span>
        <input type="file" name="archivo" id="archivo" accept=".xlsx,.xls" required>
    </label>

    <button type="submit" class="btn primary-btn">Importar <i class="bi bi-upload"></i></button>
</form>
