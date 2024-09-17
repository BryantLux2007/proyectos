<?php
session_start(); // Iniciar sesión para manejar sesiones

// Datos de conexión a la base de datos
$host = "localhost"; // Host de la base de datos
$dbname = "nombre_base_datos"; // Nombre de la base de datos
$username = "root"; // Usuario de la base de datos
$password = ""; // Contraseña de la base de datos

// Crear la conexión
$conn = new mysqli($host, $username, $password, $dbname);

// Comprobar si la conexión fue exitosa
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Verificar si los datos fueron enviados desde el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escapar y validar los datos ingresados
    $username_email = $conn->real_escape_string($_POST['username_email']);
    $password = $_POST['password']; // Contraseña sin escapar porque será verificada más adelante

    // Consulta para verificar si el nombre de usuario o correo existe
    $sql = "SELECT * FROM usuarios WHERE nombre_usuario = ? OR correo = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username_email, $username_email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificar si se encontró el usuario
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verificar si la contraseña ingresada coincide con la almacenada
        if (password_verify($password, $user['contrasena'])) {
            // Inicio de sesión exitoso: guardar información del usuario en la sesión
            $_SESSION['usuario_id'] = $user['id'];
            $_SESSION['nombre_usuario'] = $user['nombre_usuario'];
            echo "Inicio de sesión exitoso. Bienvenido, " . $_SESSION['nombre_usuario'];
            // Aquí puedes redirigir al usuario a la página principal u otra página
            // header("Location: pagina_principal.php");
            exit();
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "No se encontró una cuenta con ese nombre de usuario o correo.";
    }

    // Cerrar la consulta y conexión
    $stmt->close();
}

$conn->close();
?>
