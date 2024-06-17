<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include("../../database/config/main.php");

    $nick = md5($_POST['nick']);
    $nombre = $_POST['nombre'];
    $correo = md5($_POST['correo']);
    $password = md5($_POST['password']);

    if (!empty($nick) && !empty($nombre) && !empty($correo) && !empty($password)) {
        $stmt = $conn->prepare("INSERT INTO accounts (nick, nombre, correo, pass, fechareg, Status) VALUES (?, ?, ?, ?, NOW(), 'active')");
        $stmt->bind_param("ssss", $nick, $nombre, $correo, $password);

        if ($stmt->execute()) {
            $_SESSION['user_id'] = $conn->insert_id;
            $_SESSION['user_email'] = $correo;
            $_SESSION['nick'] = $nick;

            header("Location:  ../../Auth/login.php");
            exit();
        } else {
            header("Location:  ../../Auth/register.php");
            exit();
        }
        $stmt->close();
        $conn->close();
    } else {
        header("Location:  ../../Auth/register.php");
        exit();
    }
} else {
    header("Location:  ../../Auth/register.php");
    exit();
}
?>
