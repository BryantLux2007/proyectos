<?php
// Configuración de la conexión a la base de datos
$servername = "localhost"; // Cambia esto si tu servidor es diferente
$username = "root";        // Tu nombre de usuario de la base de datos
$password = "";            // Tu contraseña de la base de datos
$db = "registro_usuarios"; // Nombre de la base de datos

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $db);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Verificar si el formulario fue enviado y declarar variables
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger los datos del formulario
    $user = $_POST['username'];
    $email = $_POST['email'];
    $fullname = $_POST['fullname'];
    $pass = $_POST['password'];

    // Cifrar la contraseña antes de guardarla
    $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

    // Consulta SQL para insertar los datos "verdes mysql" "azules variables codigo"
    $sql = "INSERT INTO usuarios (username, email, fullname, password) VALUES ('$user', '$email', '$fullname', '$hashed_password')";

    if ($conn->query($sql) === TRUE) {
        echo "Registro exitoso. ¡Bienvenido, $user!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Cerrar la conexión
$conn->close();
?>
