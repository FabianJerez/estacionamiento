<?php
require_once 'conexion.php';

$estado = $_POST['estado'] ?? 'activo';
$formato = $_POST['formato'] ?? 'csv';

// Consultamos clientes según estado
$stmt = $conn->prepare("SELECT * FROM clientes WHERE estado = ?");
$stmt->execute([$estado]);
$clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!$clientes) {
    die("No hay clientes para exportar.");
}

// CSV
if ($formato === 'csv') {
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=clientes_' . $estado . '_' . date('Y-m') . '.csv');

    $output = fopen('php://output', 'w');
    fputcsv($output, ['Nombre', 'Apellido', 'Modelo', 'Patente', 'Pago', 'Teléfono', 'Dirección']);

    foreach ($clientes as $c) {
        fputcsv($output, [
            $c['nombre'],
            $c['apellido'],
            $c['modelo'],
            $c['patente'],
            '', // Pago vacío
            $c['telefono'],
            $c['direccion']
        ]);
    }
    fclose($output);
    exit;
}

// Word
if ($formato === 'word') {
    header("Content-type: application/vnd.ms-word");
    header("Content-Disposition: attachment;Filename=clientes_" . $estado . "_" . date('Y-m') . ".doc");

    echo "<html><body>";
    echo "<h2>Clientes " . ucfirst($estado) . " - " . date('F Y') . "</h2>";
    echo "<table border='1' cellpadding='5' cellspacing='0'>";
    echo "<tr><th>Nombre</th><th>Apellido</th><th>Modelo</th><th>Patente</th><th>Pago</th><th>Teléfono</th><th>Dirección</th></tr>";

    foreach ($clientes as $c) {
        echo "<tr>
            <td>{$c['nombre']}</td>
            <td>{$c['apellido']}</td>
            <td>{$c['modelo']}</td>
            <td>{$c['patente']}</td>
            <td></td> <!-- Pago vacío -->
            <td>{$c['telefono']}</td>
            <td>{$c['direccion']}</td>
        </tr>";
    }
    echo "</table></body></html>";
    exit;
}

// Imprimir
if ($formato === 'imprimir') {
    echo "<html><head><title>Imprimir clientes</title></head><body>";
    echo "<h2>Clientes " . ucfirst($estado) . " - " . date('F Y') . "</h2>";
    echo "<table border='1' cellpadding='5' cellspacing='0'>";
    echo "<tr><th>Nombre</th><th>Apellido</th><th>Modelo</th><th>Patente</th><th>Pago</th><th>Teléfono</th><th>Dirección</th></tr>";

    foreach ($clientes as $c) {
        echo "<tr>
            <td>{$c['nombre']}</td>
            <td>{$c['apellido']}</td>
            <td>{$c['modelo']}</td>
            <td>{$c['patente']}</td>
            <td></td> <!-- Pago vacío -->
            <td>{$c['telefono']}</td>
            <td>{$c['direccion']}</td>
        </tr>";
    }

    echo "</table><script>window.print()</script></body></html>";
    exit;
}

echo "Formato no soportado.";

