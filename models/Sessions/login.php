<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include("../../database/config/main.php");

    $identifier = $_POST['email']; 
    $password = md5($_POST['password']);

    if (!empty($identifier) && !empty($password)) {
        $stmt = $conn->prepare("SELECT * FROM accounts WHERE correo = ? OR nick = ?");
        $stmt->bind_param("ss", $identifier, $identifier);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            if ($password === $user['pass']) {
                $_SESSION['user_id'] = $user['idusuario'];
                $_SESSION['user_email'] = $user['correo'];
                $_SESSION['nick'] = $user['nick'];

                header("Location: ../../../");
                exit();
            } else {
                header("Location: ../../Auth/login.php");
                exit();
            }
        } else {
            header("Location: ../../Auth/login.php");
            exit();
        }
        $stmt->close();
        $conn->close();
    } else {
        header("Location: ../../Auth/login.php");
        exit();
    }
} else {
    header("Location: ../../Auth/login.php");
    exit();
}
?>
