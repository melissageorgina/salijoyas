<?php

require_once(__DIR__ . '../includes/functions.php');

// Manejo de eliminación de pedidos
if (isset($_GET['accion']) && $_GET['accion'] === 'eliminar' && isset($_GET['id'])) {
    $count = eliminarPedido($_GET['id']);
    $mensaje = $count > 0 ? "Pedido eliminado con éxito." : "No se pudo eliminar el pedido.";
}

// Obtener lista de pedidos
$pedidos = obtenerPedidos();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SaliJoyas - Gestión de Pedidos</title>
    <link rel="stylesheet" href="public/css/styles.css">
</head>
<body>
<div class="container">
    <h1>SaliJoyas - Gestión de Pedidos</h1>

    <!-- Mensaje de confirmación de eliminación -->
    <?php if (isset($mensaje)): ?>
        <div class="<?php echo $count > 0 ? 'success' : 'error'; ?>">
            <?php echo $mensaje; ?>
        </div>
    <?php endif; ?>

    <!-- Enlace para agregar un nuevo pedido -->
    <a href="agregar_pedido.php" class="button">Agregar un nuevo pedido</a>

    <!-- Tabla de lista de pedidos -->
    <h2>Lista de Pedidos</h2>
    <table>
        <tr>
            <th>Nombre</th>
            <th>Apellido</th>
            
           
            <th>Pedido</th>
            <th>Material</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($pedidos as $pedido): ?>
        <tr>
            <td><?php echo htmlspecialchars($pedido['nombre']); ?></td>
            <td><?php echo htmlspecialchars($pedido['apellido']); ?></td>
            
            <td><?php echo htmlspecialchars($pedido['pedido']); ?></td>
            <td><?php echo htmlspecialchars($pedido['material']); ?></td>
            <td class="actions">
                <a href="editar_pedido.php?id=<?php echo $pedido['_id']; ?>" class="button">Editar</a>
                <a href="index.php?accion=eliminar&id=<?php echo $pedido['_id']; ?>" class="button" onclick="return confirm('¿Estás seguro de que quieres eliminar este pedido?');">Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>
</body>
</html>
