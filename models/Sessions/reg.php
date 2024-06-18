<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include("../../database/config/main.php");

    // Capturar y depurar los valores iniciales
    $raw_nick = $_POST['nick'];
    $raw_nombre = $_POST['nombre'];
    $raw_correo = $_POST['correo'];
    $raw_password = $_POST['password'];

    // Verificar si las variables originales no están vacías
    if (empty($raw_nick) || empty($raw_nombre) || empty($raw_correo) || empty($raw_password)) {
        error_log("Campos vacíos detectados: nick='$raw_nick', nombre='$raw_nombre', correo='$raw_correo', password='$raw_password'");
        header("Location:  ../../Auth/register.php?error=empty_fields");
        exit();
    }

    // Aplicar el hash MD5 a las entradas
    $nick = md5($raw_nick);
    $nombre = $raw_nombre;
    $correo = md5($raw_correo);
    $password = md5($raw_password);

    // Verificar si las variables hash no están vacías
    if (!empty($nick) && !empty($nombre) && !empty($correo) && !empty($password)) {
        // Preparar la consulta SQL
        $sql = "INSERT INTO accounts (nick, nombre, correo, pass, fechareg, Status) VALUES ('$nick', '$nombre', '$correo', '$password', NOW(), 'active')";

        if ($conn->query($sql) === TRUE) {
            $_SESSION['user_id'] = $conn->insert_id;
            $_SESSION['user_email'] = $correo;
            $_SESSION['nick'] = $nick;

            header("Location:  ../../Auth/login.php");
            exit();
        } else {
            // Log error message
            error_log("Error en la ejecución de la consulta: " . $conn->error);
            header("Location:  ../../Auth/register.php?error=insert_failed");
            exit();
        }

        $conn->close();
    } else {
        error_log("Campos hash vacíos: nick='$nick', nombre='$nombre', correo='$correo', password='$password'");
        header("Location:  ../../Auth/register.php?error=empty_fields");
        exit();
    }
} else {
    header("Location:  ../../Auth/register.php?error=invalid_request");
    exit();
}
?>
