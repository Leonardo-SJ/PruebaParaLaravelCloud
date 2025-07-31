<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(135deg, #4b0082, #8a2be2);
            font-family: Arial, sans-serif;
        }
        .background {
            position: absolute;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 800"><path fill="%23ff69b4" d="M0,400 Q720,0 1440,400 V800 H0 Z"/></svg>');
            opacity: 0.3;
        }
        .login-container {
            position: relative;
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            width: 300px;
        }
        .login-container h2 {
            margin-bottom: 20px;
            color: #4b0082;
        }
        .login-container input {
            width: 80%;
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-radius: 20px;
            background: #ff69b4;
            color: white;
        }
        .login-container input::placeholder {
            color: white;
        }
        .login-container button {
            width: 80%;
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-radius: 20px;
            background: #4b0082;
            color: white;
            cursor: pointer;
        }
        .login-container a {
            display: block;
            margin-top: 10px;
            color: #ff69b4;
            text-decoration: none;
        }
        .remember-me {
            text-align: left;
            margin: 10px 0;
            color: #4b0082;
        }
    </style>
</head>
<body>
    <div class="background"></div>
    <div class="login-container">
        <h2>Login</h2>
        <form>
            <input type="text" placeholder="Nombre de usuario" required>
            <input type="password" placeholder="Contraseña" required>
            <div class="remember-me">
                <input type="checkbox" id="remember"> <label for="remember">remember me</label>
            </div>
            <a href="#">forgot password</a>
            <button type="submit">Login</button>
        </form>
         <a href="{{ route('crear') }}">Crear nuevo usuario</a>
    </div>
</body>
</html>