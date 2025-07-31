<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear cuenta</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            /* Alinea en la parte superior como Editar Usuario */
            align-items: flex-start;
            min-height: 100vh;
            background: linear-gradient(135deg, #3a325fff, #162a7aff);
            /* Usa la misma fuente que Editar Usuario */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Mantendremos este background si lo quieres, aunque Editar Usuario no lo tiene */
        .background {
    position: absolute;
    width: 100%;
    height: 100%;
    /* Degradado de un gris azulado claro a uno más oscuro */
    background: linear-gradient(to bottom, #6e7884ff, #121314ff);
    opacity: 0.3;
    /* Asegura que el contenedor de registro esté por encima */
    z-index: -1;
        }

        .register-container {
            /* Copiado de .edit-container */
            background: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 90%;
            max-width: 500px;
            margin-top: 20px; /* Igual que Editar Usuario */
            backdrop-filter: blur(10px);
            position: relative; /* Necesario si usas z-index para el background */
        }

        .register-container h2 {
            margin-bottom: 20px;
            color: #07026eff;
        }

        /* Estilos para los labels (nuevos en Crear cuenta para coincidir con Editar Usuario) */
        .register-container label {
            display: block;
            text-align: left;
            margin-bottom: 5px;
            color: #0e034cff;
        }

        /* Estilos para los inputs, adaptados de Editar Usuario */
        .register-container input {
            width: 100%; /* Ocupa todo el ancho */
            padding: 10px;
            margin-bottom: 15px; /* Espaciado uniforme */
            border: 1px solid #ddd;
            border-radius: 5px; /* Bordes menos redondeados */
            box-sizing: border-box; /* Incluye padding y border en el width */
            color: #333; /* Color de texto predeterminado */
            background: #fff; /* Fondo blanco */
        }

        .register-container input::placeholder {
            color: #999; /* Placeholder más sutil */
        }

        /* Estilos para el botón, adaptados de Editar Usuario */
        .register-container button {
            padding: 12px 24px;
            border: none;
            border-radius: 25px; /* Bordes más redondeados para el botón */
            background: linear-gradient(135deg, #070082ff, #100dadff);
            color: white;
            cursor: pointer;
            font-size: 0.9em;
            font-weight: 500;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(75, 0, 130, 0.3);
            width: auto; /* Para que el padding defina el ancho, no un porcentaje fijo */
            display: block; /* Para que ocupe su propia línea */
            margin: 10px auto; /* Centrar el botón */
        }

        .register-container button:hover {
            background: linear-gradient(135deg, #334295ff, #020478ff);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 105, 180, 0.4);
        }

        .register-container a {
            display: block;
            margin-top: 15px; /* Más espaciado */
            color: #03034bff; /* Color de enlace principal */
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .register-container a:hover {
            color: #ff69b4; /* Color al pasar el ratón */
        }

        .error {
            color: red;
            font-size: 0.9em;
            text-align: left; /* Alinea los errores a la izquierda */
            margin-bottom: 10px;
        }

        .success {
            color: green;
            font-size: 0.9em;
            text-align: center;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="background"></div>
    <div class="register-container">
        <h2>Crear cuenta</h2>

        @if (session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="error">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ route('crear') }}">
            @csrf

            <div>
                <label for="nombre">Nombre de usuario:</label>
                <input type="text" name="nombre" id="nombre" placeholder="Introduce tu nombre de usuario" value="{{ old('nombre') }}" required>
                @error('nombre')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="correo_electronico">Correo electrónico:</label>
                <input type="email" name="correo_electronico" id="correo_electronico" placeholder="Introduce tu correo electrónico" value="{{ old('correo_electronico') }}" required>
                @error('correo_electronico')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="numero_telefono">Número de teléfono:</label>
                <input type="text" name="numero_telefono" id="numero_telefono" placeholder="Introduce tu número de teléfono" value="{{ old('numero_telefono') }}" required>
                @error('numero_telefono')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="fecha_nacimiento">Fecha de nacimiento:</label>
                <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}" required>
                @error('fecha_nacimiento')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="contrasena">Contraseña:</label>
                <input type="password" name="contrasena" id="contrasena" placeholder="Crea tu contraseña" required>
                @error('contrasena')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit">Crear cuenta</button>
        </form>


    </div>
</body>
</html>