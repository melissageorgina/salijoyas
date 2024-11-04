<?php
require_once __DIR__ . '/includes/functions.php';

// Verificación de ID de pedido
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

// Obtener el pedido por ID
$pedido = obtenerPedidoPorId($_GET['id']);
if (!$pedido) {
    header("Location: index.php?mensaje=Pedido no encontrado");
    exit;
}

// Verificación de envío de formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'] ?? '';
    $apellido = $_POST['apellido'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $tipoPedido = $_POST['tipoPedido'] ?? '';  // Corregir la variable
    $material = $_POST['material'] ?? '';
    $completado = isset($_POST['completado']); // Verifica si está marcado

    // Actualizar pedido
    $actualizado = actualizarPedido($_GET['id'], $nombre, $apellido, $tipoPedido, $material, $completado); // Corregir la variable

    if ($actualizado) {
        header("Location: index.php?mensaje=Pedido actualizado");
        exit;
    } else {
        $error = "No se pudo actualizar el pedido.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Pedido</title>
    <link rel="stylesheet" href="public/css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Editar Pedido</h1>
        
        <!-- Mensaje de error si ocurre -->
        <?php if (isset($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>

        <!-- Formulario de edición de pedido -->
        <form method="POST">
            <label>Nombre:
                <input type="text" name="nombre" value="<?php echo htmlspecialchars($pedido['nombre'] ?? ''); ?>" required>
            </label>
            <label>Apellido:
                <input type="text" name="apellido" value="<?php echo htmlspecialchars($pedido['apellido'] ?? ''); ?>" required>
            </label>
            <label>Teléfono:
                <input type="text" name="telefono" value="<?php echo htmlspecialchars($pedido['telefono'] ?? ''); ?>" required>
            </label>
            <label>Tipo de Pedido (arete, collar, etc.):
                <input type="text" name="tipoPedido" value="<?php echo htmlspecialchars($pedido['pedido'] ?? ''); ?>" required>
            </label>
            <label>Material (oro, plata, etc.):
                <input type="text" name="material" value="<?php echo htmlspecialchars($pedido['material'] ?? ''); ?>" required>
            </label>
            <label>Completado:
                <input type="checkbox" name="completado" <?php echo !empty($pedido['completado']) ? 'checked' : ''; ?>>
            </label>
            <input type="submit" value="Actualizar Pedido">
        </form>
        
        <a href="index.php" class="button">Volver a la lista de pedidos</a>
    </div>
</body>
</html>
