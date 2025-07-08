<?php
require_once 'conexion.php';

// Nuevo cliente
if (!empty($_POST['nuevo']['nombre']) && !empty($_POST['nuevo']['apellido'])) {
    $stmt = $conn->prepare("
        INSERT INTO clientes 
        (nombre, apellido, modelo, patente, pago, telefono, direccion, estado)
        VALUES (:nombre, :apellido, :modelo, :patente, :pago, :telefono, :direccion, 'activo')
    ");
    $stmt->execute([
        ':nombre' => $_POST['nuevo']['nombre'],
        ':apellido' => $_POST['nuevo']['apellido'],
        ':modelo' => $_POST['nuevo']['modelo'],
        ':patente' => $_POST['nuevo']['patente'],
        ':pago' => $_POST['nuevo']['pago'],
        ':telefono' => $_POST['nuevo']['telefono'],
        ':direccion' => $_POST['nuevo']['direccion'],
    ]);
}

// Recorremos los datos enviados desde el formulario
foreach ($_POST['nombre'] as $id => $nombre) {
    // Preparamos la consulta de actualización
    $stmt = $conn->prepare("
        UPDATE clientes SET 
            nombre = :nombre,
            modelo = :modelo,
            patente = :patente,
            pago = :pago,
            telefono = :telefono,
            direccion = :direccion,
            estado = :estado
        WHERE id = :id
    ");

    $stmt->execute([
        ':nombre' => $_POST['nombre'][$id],
        ':modelo' => $_POST['modelo'][$id],
        ':patente' => $_POST['patente'][$id],
        ':pago' => $_POST['pago'][$id],
        ':telefono' => $_POST['telefono'][$id],
        ':direccion' => $_POST['direccion'][$id],
        ':estado' => $_POST['estado'][$id],
        ':id' => $id
    ]);
}

// Volvemos a la página desde donde vino
header("Location: " . $_SERVER['HTTP_REFERER']);
exit;
?>
