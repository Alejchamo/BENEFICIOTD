<?php
// Configuración de la base de datos
$host = 'localhost';
$dbname = 'registro_db';
$username = 'root'; // Cambia esto según tu configuración de MySQL
$password = ''; // Cambia esto según tu configuración de MySQL

// Crear conexión a la base de datos
$conn = new mysqli($host, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta para obtener usuarios
$sql = "SELECT Nombre, Apellido, Correo, tipo_usuario FROM usuarios";
$result = $conn->query($sql);

// Verificar si hay resultados y mostrar los datos
if ($result->num_rows > 0) {
    // Mostrar los datos de cada fila
    while ($row = $result->fetch_assoc()) {
        echo "Nombre: " . htmlspecialchars($row['Nombre']) . " - ";
        echo "Apellido: " . htmlspecialchars($row['Apellido']) . " - ";
        echo "Correo: " . htmlspecialchars($row['Correo']) . " - ";
        echo "Tipo de Usuario: " . htmlspecialchars($row['tipo_usuario']) . "<br>";
    }
} else {
    echo "No hay usuarios registrados";
}

// Cerrar la conexión
$conn->close();
?>
