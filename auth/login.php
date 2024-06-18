<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" as="style" onload="this.rel='stylesheet'" href="https://fonts.googleapis.com/css2?display=swap&amp;family=Noto+Sans%3Awght%40400%3B500%3B700%3B900&amp;family=Work+Sans%3Awght%40400%3B500%3B700%3B900">
    <link rel="stylesheet" href="../assets/css/auth.css">
    <title>Frida | Log In</title>
</head>
<body>
    <div class="container">
        <header>
            <h2>Bienvenido de vuelta</h2>
            <p>Tu servicio de confianza Frida</p>
        </header>
        <main>
            <form action="../models/Sessions/login.php" method="post">
                <label for="email">Correo o Nick:</label>
                <input type="text" class='outlinenone' id="email" name="email" placeholder="ejemplo@frida.com o Nick" required>
                
                <label for="password">Contraseña:</label>
                <input type="password" class='outlinenone' id="password" name="password" placeholder="********" required>
                
                <div class="checkbox-container">
                    <label for="showpass">¿Quieres ver tu contraseña?</label>
                    <input type="checkbox" id="togglePassword">
                </div>
                
                <input type="submit" value="Iniciar Sesión">

                <p>¿No tienes una cuenta? <a href="register.php">Regístrate!</a></p>
            </form>
        </main>
    </div>
</body>
</html>

<script>
document.getElementById('togglePassword').addEventListener('change', function () {
    const passwordInput = document.getElementById('password');
    passwordInput.type = this.checked ? 'text' : 'password';
});
</script>
