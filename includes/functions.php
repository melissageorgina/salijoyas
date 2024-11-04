<?php

require_once __DIR__ . '/../config/database.php';

function sanitizeInput($input) {
    return htmlspecialchars(strip_tags(trim($input)));
}

function formatDate($date) {
    return $date->toDateTime()->format('Y-m-d');
}

// Crear un nuevo pedido de joya
function crearPedido($nombre, $apellido, $pedido, $material) {
    global $joyasCollection;
    $resultado = $joyasCollection->insertOne([
        'nombre' => sanitizeInput($nombre),
        'apellido' => sanitizeInput($apellido),
        'pedido' => sanitizeInput($pedido),  // Tipo de joya (arete, collar, etc.)
        'material' => sanitizeInput($material),  // Material de la joya (oro, plata, etc.)
        'fecha_pedido' => new MongoDB\BSON\UTCDateTime(),  // Fecha de ingreso del pedido
        'completado' => false
    ]);
    return $resultado->getInsertedId();
}

// Obtener todos los pedidos de joyas
function obtenerPedidos() {
    global $joyasCollection;
    return $joyasCollection->find();
}

// Obtener un pedido por su ID
function obtenerPedidoPorId($id) {
    global $joyasCollection;
    return $joyasCollection->findOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
}

// Actualizar información de un pedido
function actualizarPedido($id, $nombre, $apellido, $pedido, $material, $completado) {
    global $joyasCollection;
    $resultado = $joyasCollection->updateOne(
        ['_id' => new MongoDB\BSON\ObjectId($id)],
        ['$set' => [
            'nombre' => sanitizeInput($nombre),
            'apellido' => sanitizeInput($apellido),
            'pedido' => sanitizeInput($pedido),
            'material' => sanitizeInput($material),
            'completado' => $completado
        ]]
    );
    return $resultado->getModifiedCount();
}

// Eliminar un pedido
function eliminarPedido($id) {
    global $joyasCollection;
    $resultado = $joyasCollection->deleteOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
    return $resultado->getDeletedCount();
}
?>
