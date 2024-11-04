<?php

require_once __DIR__ . '/../vendor/autoload.php';

// Configuración de la conexión a MongoDB
$mongoClient = new MongoDB\Client("mongodb+srv://73797358:73797358@cluster1.s0aj5.mongodb.net/?retryWrites=true&w=majority&appName=Cluster1");


// Selecciona la base de datos y la colección
$database = $mongoClient->cluster1; // Cambia 'mi_base_de_datos' por el nombre de tu base de datos
$joyasCollection = $database->mis_joyas; // Cambia 'mi_coleccion' por el nombre de tu colección

echo "";
?>





