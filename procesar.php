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

// Recoger datos del formulario
$nombres = $_POST['nombre'] ?? '';
$apellidos = $_POST['apellido'] ?? '';
$correo = $_POST['correo'] ?? '';
$password = $_POST['password'] ?? '';
$confirm_password = $_POST['confirm_password'] ?? '';
$tipo_usuario = $_POST['tipo_usuario'] ?? '';

// Validar contraseñas
if ($password !== $confirm_password) {
    echo json_encode(["message" => "Las contraseñas no coinciden."]);
    exit();
}

// Hashing la contraseña
$hashed_password = password_hash($password, PASSWORD_BCRYPT);

// Preparar la consulta SQL
$sql = "INSERT INTO usuarios (Nombre, Apellido, Correo, Password, tipo_usuario)
        VALUES (?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $nombres, $apellidos, $correo, $hashed_password, $tipo_usuario);

// Ejecutar la consulta
if ($stmt->execute()) {
    if (isset($_SERVER['HTTP_USER_AGENT']) && strpos($_SERVER['HTTP_USER_AGENT'], 'PostmanRuntime') !== false) {
        // Si es Postman, devuelve JSON
        echo json_encode(["message" => "Usuario registrado exitosamente"]);
    } else {
        // Si es navegador, redirigir a exito.html
        header("Location: exito.html");
        exit();
    }
} else {
    echo json_encode(["message" => "Error: " . $stmt->error]);
}

// Cerrar la conexión
$stmt->close();
$conn->close();
?>
