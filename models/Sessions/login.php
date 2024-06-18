<?php
if ($_POST) {
    include "../../database/config/main.php";

    // Capturar y sanitizar los datos de entrada
    $usuario = $conn->real_escape_string($_POST['email']);
    $contrasenia = $_POST['password'];

    try {
        // Consulta preparada para evitar inyección SQL
        $stmt = $conn->prepare("SELECT * FROM accounts WHERE correo = ? OR nick = ?");
        $stmt->bind_param("ss", $usuario, $usuario);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();

            // Verificar la contraseña utilizando password_verify
            if (password_verify($contrasenia, $row['pass'])) {
                session_start();  // Iniciar la sesión aquí

                if ($row['Status'] == 'active') {
                    $_SESSION['usuario'] = $row['correo'];
                    $_SESSION['nombre'] = $row['nick'];
                    $_SESSION['id'] = $row['idusuario'];

                    // Redirigir siempre a esta página después de iniciar sesión correctamente
                    header("Location: ../../../index.php");
                    exit();
                } else {
                    header("Location: ../views/logeo.php?error=1"); // Usuario inactivo
                    exit();
                }
            } else {
                header("Location: ../views/logeo.php?error=2"); // Usuario o contraseña incorrectos
                exit();
            }
        } else {
            header("Location: ../views/logeo.php?error=2"); // Usuario o contraseña incorrectos
            exit();
        }
    } catch (Exception $e) {
        // Captura cualquier excepción y redirige a logeo.php con el error
        header("Location: ../views/logeo.php?error=4&msg=" . urlencode($e->getMessage()));
        exit();
    } finally {
        $stmt->close();
        $conn->close();
    }
}
?>
