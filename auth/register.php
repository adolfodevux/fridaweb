<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
      rel="stylesheet"
      as="style"
      onload="this.rel='stylesheet'"
      href="https://fonts.googleapis.com/css2?display=swap&amp;family=Noto+Sans%3Awght%40400%3B500%3B700%3B900&amp;family=Work+Sans%3Awght%40400%3B500%3B700%3B900"
    />
    <link rel="stylesheet" href="../assets/css/auth.css">
    <title>Frida | Sin Up</title>
</head>
<body>
    <div class="container">
        <header>
            <h2>Crea tu cuenta de Frida Service</h2>
            <p>Tu servicio de confiansa Frida</p>
        </header>
        <main>
            <form action="../models/Sessions/reg.php" method="post">
            <label for="nick">Nombre para mostrar:</label>
                <input type="text" name="nick" placeholder="Nick" required>
                <label for="nombre">Nombre Completo</label>
                <input type="text" name="nombre" placeholder="Nombre" required>   
                <label for="correo">Correo:</label>
                <input type="email" name="correo" placeholder="Correo" required>
                
                <label for="pass">Contraseña:</label>
                <input type="password" name="password" placeholder="Password" required>
                
                <div class="checkbox-container">
                <label for="showpass">Quieres ver tu contraseña?</label>
                    <input type="checkbox" id="togglePassword">

                </div>
                
                <input type="submit" value="Crear cuenta">

                <p>¿Ya tienes una cuenta?  <a href="login.php">Iniciar sesión!</a></p>
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