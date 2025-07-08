<?php
require_once 'conexion.php';

// Buscar por filtro
$filtro = $_GET['filtro'] ?? '';
$valor = $_GET['valor'] ?? '';

$query = "SELECT * FROM clientes WHERE estado = 'inactivo'";
$params = [];

if (!empty($filtro) && !empty($valor)) {
    $query .= " AND $filtro LIKE ?";
    $params[] = "%$valor%";
}

$stmt = $conn->prepare($query);
$stmt->execute($params);
$clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Clientes Inactivos</title>
<link rel="stylesheet" href="css/estilos.css">
</head>
<body>

<?php include 'sidebar.php'; ?>

<div class="contenido">
    <h1>Clientes Inactivos</h1>

    <form method="GET" action="inactivos.php">
        <label for="filtro">Buscar por:</label>
        <select name="filtro" id="filtro">
            <option value="nombre" <?= $filtro=='nombre' ? 'selected' : '' ?>>Nombre</option>
            <option value="patente" <?= $filtro=='patente' ? 'selected' : '' ?>>Patente</option>
            <option value="modelo" <?= $filtro=='modelo' ? 'selected' : '' ?>>Modelo</option>
        </select>
        <input type="text" name="valor" placeholder="Buscar..." value="<?= htmlspecialchars($valor) ?>" required>
        <button type="submit">Buscar</button>
    </form>

    <form method="POST" action="guardar.php">
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Modelo</th>
                <th>Patente</th>
                <th>Pago</th>
                <th>Teléfono</th>
                <th>Dirección</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
        <?php if (count($clientes) > 0): ?>
            <?php foreach ($clientes as $c): ?>
                <tr>
                    <td><input name="nombre[<?= $c['id'] ?>]" value="<?= htmlspecialchars($c['nombre']) ?>"></td>
                    <td><input name="modelo[<?= $c['id'] ?>]" value="<?= htmlspecialchars($c['modelo']) ?>"></td>
                    <td><input name="patente[<?= $c['id'] ?>]" value="<?= htmlspecialchars($c['patente']) ?>"></td>
                    <td>
                        <select name="pago[<?= $c['id'] ?>]">
                            <option value="1" <?= $c['pago'] ? 'selected' : '' ?>>Sí</option>
                            <option value="0" <?= !$c['pago'] ? 'selected' : '' ?>>No</option>
                        </select>
                    </td>
                    <td><input name="telefono[<?= $c['id'] ?>]" value="<?= htmlspecialchars($c['telefono']) ?>"></td>
                    <td><input name="direccion[<?= $c['id'] ?>]" value="<?= htmlspecialchars($c['direccion']) ?>"></td>
                    <td>
                        <select name="estado[<?= $c['id'] ?>]">
                            <option value="activo" <?= $c['estado']=='activo'?'selected':'' ?>>Activo</option>
                            <option value="inactivo" <?= $c['estado']=='inactivo'?'selected':'' ?>>Inactivo</option>
                        </select>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="7">No se encontraron clientes inactivos.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>

    <button type="submit">Guardar cambios</button>
    </form>

</div>

</body>
</html>
