<?php

namespace App\Http\Controllers\Controladores;

use App\Models\Usuario;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use App\Http\Resources\UserResource;

class UsuarioController extends Controller
{
    // Métodos existentes para la aplicación web
    public function index()
    {
        return view('welcome');
    }

    public function showLogin()
    {
        return view('Login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'nombre_usuario' => 'required|string',
            'contrasena' => 'required|string',
        ]);

        if (Auth::attempt(['nombre_usuario' => $request->nombre_usuario, 'contrasena' => $request->contrasena])) {
            return redirect()->intended('dashboard');
        }

        return back()->withErrors(['nombre_usuario' => 'Credenciales incorrectas']);
    }

    public function showCrear()
    {
        return view('Crear');
    }


 // Nuevo Resource (crearemos más adelante)



    public function store(Request $request)
    {
try {
        $validatedData = $request->validate([
            'nombre_usuario' => 'required|string|max:50|unique:usuarios,nombre_usuario',
            'correo_electronico' => 'required|email|max:100|unique:usuarios,correo_electronico',
            'numero_telefono' => 'required|string|max:20',
            'fecha_nacimiento' => 'required|date',
            'contrasena' => 'required|string|min:6',
            'rol' => 'nullable|string|max:50|in:usuario,admin',
        ], [
            'nombre_usuario.required' => 'El nombre de usuario es obligatorio.',
            'nombre_usuario.unique' => 'El nombre de usuario ya está en uso.',
            'correo_electronico.required' => 'El correo electrónico es obligatorio.',
            'correo_electronico.email' => 'El correo electrónico debe ser válido.',
            'correo_electronico.unique' => 'El correo electrónico ya está en uso.',
            'numero_telefono.required' => 'El número de teléfono es obligatorio.',
            'fecha_nacimiento.required' => 'La fecha de nacimiento es obligatoria.',
            'fecha_nacimiento.date' => 'La fecha de nacimiento debe ser una fecha válida.',
            'contrasena.required' => 'La contraseña es obligatoria.',
            'contrasena.min' => 'La contraseña debe tener al menos 6 caracteres.',
            'rol.in' => 'El rol debe ser "usuario" o "admin".',
        ]);

        $usuario = Usuario::create([
            'nombre_usuario' => $validatedData['nombre_usuario'],
            'correo_electronico' => $validatedData['correo_electronico'],
            'numero_telefono' => $validatedData['numero_telefono'],
            'fecha_nacimiento' => $validatedData['fecha_nacimiento'],
            'contrasena' => bcrypt($validatedData['contrasena']),
            'rol' => $validatedData['rol'] ?? 'usuario',
        ]);

        if ($request->expectsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Usuario creado exitosamente',
                'data' => $usuario,
            ], 201);
        }

        return redirect()->route('crear')->with('success', 'Usuario creado exitosamente.');
    } catch (ValidationException $e) {
        if ($request->expectsJson()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Errores de validación',
                'errors' => $e->errors(),
            ], 422);
        }
        return redirect()->route('crear')->withErrors($e->errors())->withInput();
    } catch (QueryException $e) {
        \Log::error('Error al crear usuario: ' . $e->getMessage());
        if ($request->expectsJson()) {
            return response()->json([
                'status' => 'error',
                'message' => 'No se pudo crear el usuario debido a un error en la base de datos.',
            ], 500);
        }
        return redirect()->route('crear')->with('error', 'No se pudo crear el usuario.');
    } catch (\Exception $e) {
        \Log::error('Error inesperado al crear usuario: ' . $e->getMessage());
        if ($request->expectsJson()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error inesperado al crear el usuario.',
            ], 500);
        }
        return redirect()->route('crear')->with('error', 'Error inesperado al crear el usuario.');
    }
    }


    public function list()
    {
        $usuarios = Usuario::paginate(10);
        return view('Usuarios', compact('usuarios'));
    }

    public function destroy($id)
    {
        try {
            $usuario = Usuario::findOrFail($id);
            $usuario->delete();

            if (request()->expectsJson()) {
                return response()->json(['message' => 'Usuario eliminado exitosamente'], 200);
            }
            return redirect()->route('usuarios')->with('success', 'Usuario eliminado exitosamente.');
        } catch (\Exception $e) {
            \Log::error('Error al eliminar usuario: ' . $e->getMessage());
            if (request()->expectsJson()) {
                return response()->json(['error' => 'No se pudo eliminar el usuario'], 500);
            }
            return redirect()->route('usuarios')->with('error', 'No se pudo eliminar el usuario: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $usuario = Usuario::findOrFail($id);
            return view('Editar', compact('usuario'));
        } catch (\Exception $e) {
            \Log::error('Error al cargar el usuario para edición: ' . $e->getMessage());
            return redirect()->route('usuarios')->with('error', 'No se pudo cargar el usuario para edición.');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $usuario = Usuario::findOrFail($id);

            $validatedData = $request->validate([
                'nombre_usuario' => 'required|string|max:50|unique:usuarios,nombre_usuario,' . $id,
                'correo_electronico' => 'required|email|max:100|unique:usuarios,correo_electronico,' . $id,
                'numero_telefono' => 'required|string|max:20',
                'fecha_nacimiento' => 'required|date',
                'contrasena' => 'nullable|string|min:6',
                'rol' => 'nullable|string|max:50',
            ]);

            $usuario->update([
                'nombre_usuario' => $request->input('nombre_usuario'),
                'correo_electronico' => $request->input('correo_electronico'),
                'numero_telefono' => $request->input('numero_telefono'),
                'fecha_nacimiento' => $request->input('fecha_nacimiento'),
                'rol' => $request->input('rol', $usuario->rol),
                'contrasena' => $request->input('contrasena') ? bcrypt($request->input('contrasena')) : $usuario->contrasena,
            ]);

            if ($request->expectsJson()) {
                return response()->json(['message' => 'Usuario actualizado exitosamente', 'usuario' => $usuario], 200);
            }
            return redirect()->route('usuarios')->with('success', 'Usuario actualizado exitosamente.');
        } catch (QueryException $e) {
            \Log::error('Error al actualizar usuario: ' . $e->getMessage());
            if ($request->expectsJson()) {
                return response()->json(['error' => 'No se pudo actualizar el usuario'], 500);
            }
            return redirect()->route('usuarios')->with('error', 'No se pudo actualizar el usuario: ' . $e->getMessage());
        }
    }

    // Nuevos métodos para la API
    public function apiLogin(Request $request)
    {
        $credentials = $request->validate([
            'nombre_usuario' => 'required|string',
            'contrasena' => 'required|string',
        ]);

        if (Auth::attempt(['nombre_usuario' => $request->nombre_usuario, 'contrasena' => $request->contrasena])) {
            $user = Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json(['token' => $token, 'user' => $user], 200);
        }

        return response()->json(['error' => 'Credenciales incorrectas'], 401);
    }

    public function apiList(Request $request)
    {
        $usuarios = Usuario::paginate(10);
        return response()->json($usuarios, 200);
    }

    public function apiShow($id)
    {
        try {
            $usuario = Usuario::findOrFail($id);
            return response()->json($usuario, 200);
        } catch (\Exception $e) {
            \Log::error('Error al obtener usuario: ' . $e->getMessage());
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }
    }
}