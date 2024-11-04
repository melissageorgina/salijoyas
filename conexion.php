<?php
// Cargar las dependencias de Composer
require 'vendor/autoload.php'; // Asegúrate de que el archivo autoload.php esté en la carpeta vendor

// Configurar la cadena de conexión (reemplazar los datos)
$mongoClient = new MongoDB\Client("mongodb+srv://73797358:73797358@cluster1.mongodb.net/<bdname>?retryWrites=true&w=majority");

// Seleccionar la base de datos
$db = $mongoClient->selectDatabase('cluster1'); // Cambia 'mi_base_de_datos' por el nombre real de tu base de datos

// Seleccionar la colección
$collection = $db->selectCollection('mis_joyas'); // Cambia 'mis_joyas' por el nombre real de tu colección

// Insertar un documento
$insertResult = $collection->insertOne([
    'nombre' => 'Juan',
    'email' => 'juan@example.com'
]);

// Mostrar el ID del documento insertado
echo "Documento insertado con ID: " . $insertResult->getInsertedId();
?>
