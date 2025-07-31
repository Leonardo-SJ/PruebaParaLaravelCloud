<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
            background: linear-gradient(135deg, #4b0082, #8a2be2);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .edit-container {
            background: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 90%;
            max-width: 500px;
            margin-top: 20px;
            backdrop-filter: blur(10px);
        }
        .edit-container label {
            display: block;
            text-align: left;
            margin-bottom: 5px;
            color: #4b0082;
        }
        .edit-container input, .edit-container select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }
        .edit-container button {
            padding: 12px 24px;
            border: none;
            border-radius: 25px;
            background: linear-gradient(135deg, #4b0082, #6a0dad);
            color: white;
            cursor: pointer;
            font-size: 0.9em;
            font-weight: 500;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(75, 0, 130, 0.3);
        }
        .edit-container button:hover {
            background: linear-gradient(135deg, #ff69b4, #ff1493);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 105, 180, 0.4);
        }
    </style>
</head>
<body>
    <div class="edit-container">
        <h2>Editar Usuario</h2>
        @if (session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="error">{{ session('error') }}</div>
        @endif
        <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div>
                <label for="nombre_usuario">Nombre de Usuario:</label>
                <input type="text" name="nombre_usuario" id="nombre_usuario" value="{{ old('nombre_usuario', $usuario->nombre_usuario) }}" required>
            </div>
            <div>
                <label for="correo_electronico">Correo Electrónico:</label>
                <input type="email" name="correo_electronico" id="correo_electronico" value="{{ old('correo_electronico', $usuario->correo_electronico) }}" required>
            </div>
            <div>
                <label for="numero_telefono">Número de Teléfono:</label>
                <input type="text" name="numero_telefono" id="numero_telefono" value="{{ old('numero_telefono', $usuario->numero_telefono) }}" required>
            </div>
            <div>
                <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" value="{{ old('fecha_nacimiento', $usuario->fecha_nacimiento ? $usuario->fecha_nacimiento->format('Y-m-d') : '') }}" required>
            </div>
            <div>
                <label for="contrasena">Contraseña (dejar en blanco para no cambiar):</label>
                <input type="password" name="contrasena" id="contrasena">
            </div>
            <div>
                <label for="rol">Rol:</label>
                <select name="rol" id="rol">
                    <option value="usuario" {{ old('rol', $usuario->rol) == 'usuario' ? 'selected' : '' }}>Usuario</option>
                    <option value="administrador" {{ old('rol', $usuario->rol) == 'administrador' ? 'selected' : '' }}>Administrador</option>
                    <option value="editor" {{ old('rol', $usuario->rol) == 'editor' ? 'selected' : '' }}>Editor</option>
                </select>
            </div>
            <button type="submit">Actualizar Usuario</button>
        </form>
        <a href="{{ route('usuarios') }}" style="margin-top: 15px; display: inline-block;">Volver a la lista</a>
    </div>
</body>
</html>
