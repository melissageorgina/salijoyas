<?php
require_once __DIR__ . '/includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = crearPedido($_POST['nombre'], $_POST['apellido'], $_POST['telefono'], $_POST['pedido'], $_POST['material']);
    if ($id) {
        header("Location: index.php?mensaje=Pedido creado con éxito");
        exit;
    } else {
        $error = "No se pudo crear el pedido.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Nuevo Pedido</title>
    <link rel="stylesheet" href="public/css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Agregar Nuevo Pedido</h1>

        <?php if (isset($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="POST">
            <label>Nombre: <input type="text" name="nombre" required></label>
            <label>Apellido: <input type="text" name="apellido" required></label>
            <label>Teléfono: <input type="text" name="telefono" required></label>
            <label>Tipo de Pedido (arete, collar, etc.): <input type="text" name="pedido" required></label>
            <label>Material (oro, plata, etc.): <input type="text" name="material" required></label>
            <input type="submit" value="Crear Pedido">
        </form>

        <a href="index.php" class="button">Volver a la lista de pedidos</a>
    </div>
</body>
</html>
