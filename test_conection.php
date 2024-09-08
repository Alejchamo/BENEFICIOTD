<?php
// Configuración de la base de datos
$host = 'localhost';
$dbname = 'registro_db';
$username = 'root';
$password = '';

// Crear conexión a la base de datos
$conn = new mysqli($host, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
} else {
    echo "Conexión exitosa a la base de datos";
}

// Cerrar la conexión
$conn->close();
?>