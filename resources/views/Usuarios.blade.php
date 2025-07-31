<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuarios</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
            background: linear-gradient(135deg, #5f6061ff, #385569ff);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .background {
            position: absolute;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 800"><path fill="%238792a3" d="M0,400 Q720,0 1440,400 V800 H0 Z"/></svg>');
            opacity: 0.3;
        }
        .users-container {
            position: relative;
            background: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 90%;
            max-width: 900px;
            margin-top: 20px;
            backdrop-filter: blur(10px);
        }
        
        /* Botón Crear Usuario en esquina superior izquierda */
        .create-user-btn-top {
            position: absolute;
            top: 20px;
            left: 20px;
            background: linear-gradient(135deg, #22c55e, #16a34a) !important;
            color: white !important;
            padding: 12px 20px !important;
            border-radius: 25px !important;
            text-decoration: none !important;
            font-weight: 600 !important;
            font-size: 0.9em !important;
            box-shadow: 0 4px 15px rgba(34, 197, 94, 0.3) !important;
            transition: all 0.3s ease !important;
            margin: 0 !important;
            display: flex !important;
            align-items: center !important;
            gap: 8px !important;
        }
        
        .create-user-btn-top:hover {
            background: linear-gradient(135deg, #16a34a, #15803d) !important;
            transform: translateY(-2px) !important;
            box-shadow: 0 6px 20px rgba(34, 197, 94, 0.4) !important;
        }
        
        .create-user-btn-top svg {
            width: 18px;
            height: 18px;
        }
        
        .users-container h2 {
            margin-bottom: 30px;
            color: #050009ff;
            font-size: 2rem;
            font-weight: 600;
        }
        .users-container table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            overflow: hidden;
        }
        .users-container table th, 
        .users-container table td {
            padding: 15px 12px;
            border: none;
            text-align: left;
            font-size: 0.9em;
        }
        .users-container table th {
            background: linear-gradient(135deg, #202b55ff, #081e5aff);
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 0.8em;
        }
        .users-container table td {
            background: #fff;
            border-bottom: 1px solid #f0f0f0;
        }
        .users-container table tbody tr:hover td {
            background: #f8f9ff;
        }
        .users-container table tbody tr:last-child td {
            border-bottom: none;
        }
        
        /* Botones de acción pequeños (Eliminar y Editar) */
        .action-btn {
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            width: 36px !important;
            height: 36px !important;
            padding: 0 !important;
            margin: 0 4px !important;
            border: none !important;
            border-radius: 8px !important;
            cursor: pointer !important;
            font-size: 0.8em !important;
            transition: all 0.3s ease !important;
            text-decoration: none !important;
        }
        
        .action-btn svg {
            width: 18px !important;
            height: 18px !important;
        }
        
        .action-btn.delete {
            background: linear-gradient(135deg, #ff4444, #cc0000) !important;
            color: white !important;
            box-shadow: 0 2px 8px rgba(255, 68, 68, 0.3) !important;
        }
        
        .action-btn.delete:hover {
            background: linear-gradient(135deg, #cc0000, #990000) !important;
            transform: translateY(-2px) !important;
            box-shadow: 0 4px 12px rgba(255, 68, 68, 0.4) !important;
        }
        
        .action-btn.edit {
            background: linear-gradient(135deg, #3b82f6, #1e40af) !important;
            color: white !important;
            box-shadow: 0 2px 8px rgba(59, 130, 246, 0.3) !important;
        }
        
        .action-btn.edit:hover {
            background: linear-gradient(135deg, #1e40af, #1e3a8a) !important;
            transform: translateY(-2px) !important;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4) !important;
        }
        
        /* Botones generales */
        .users-container a, 
        .users-container button {
            display: inline-block;
            margin: 8px 5px;
            padding: 12px 24px;
            border: none;
            border-radius: 25px;
            background: linear-gradient(135deg, #001e82ff, #0d42adff);
            color: white;
            text-decoration: none;
            cursor: pointer;
            font-size: 0.9em;
            font-weight: 500;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(75, 0, 130, 0.3);
        }
        
        .users-container a:hover, 
        .users-container button:hover {
            background: linear-gradient(135deg, #214d55ff, #03333dff);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 105, 180, 0.4);
        }
        
        /* Paginación Mejorada */
        .pagination-wrapper {
            margin: 40px 0 20px 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
        }
        
        .pagination-info {
            color: #666;
            font-size: 0.9em;
            font-weight: 500;
        }
        
        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            gap: 8px;
            padding: 15px;
            background: rgba(255, 255, 255, 0.6);
            border-radius: 50px;
            backdrop-filter: blur(10px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }
        
        .pagination a, 
        .pagination span {
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 44px;
            height: 44px;
            padding: 0 16px;
            border-radius: 22px;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.9em;
            transition: all 0.3s cubic-bezier(0.4, 0.0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }
        
        .pagination a {
            background: rgba(75, 0, 130, 0.1);
            color: #4b0082;
            border: 2px solid transparent;
        }
        
        .pagination a:hover {
            background: linear-gradient(135deg, #014054ff, #023049ff);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(75, 0, 130, 0.3);
        }
        
        .pagination .active {
            background: linear-gradient(135deg, #334595ff, #020b1bff) !important;
            color: white !important;
            font-weight: 600;
            box-shadow: 0 6px 20px rgba(3, 38, 88, 0.55);
            transform: scale(1.05);
        }
        
        .pagination .disabled {
            background: rgba(0, 0, 0, 0.05) !important;
            color: #ccc !important;
            pointer-events: none;
            opacity: 0.5;
        }
        
        /* Botones de navegación especiales */
        .pagination .nav-btn {
            background: linear-gradient(135deg, #02285cff, #232b58ff);
            color: white;
            font-weight: 600;
            min-width: 60px;
            box-shadow: 0 4px 15px rgba(75, 0, 130, 0.3);
        }
        
        .pagination .nav-btn:hover {
            background: linear-gradient(135deg, #2b4b95ff, #1a2260ff);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(6, 48, 122, 0.4);
        }
        
        .pagination .nav-btn.disabled {
            background: rgba(0, 0, 0, 0.1) !important;
            color: #999 !important;
            box-shadow: none !important;
        }
        
        /* Separador de páginas */
        .pagination .separator {
            color: #999;
            font-weight: 600;
            padding: 0 8px;
            background: none !important;
            cursor: default;
            min-width: auto;
        }
        
        .error {
            color: #ff4444;
            font-size: 0.9em;
            background: rgba(255, 68, 68, 0.1);
            padding: 12px 20px;
            border-radius: 8px;
            border-left: 4px solid #ff4444;
            margin: 15px 0;
        }
        .success {
            color: #22c55e;
            font-size: 0.9em;
            background: rgba(34, 197, 94, 0.1);
            padding: 12px 20px;
            border-radius: 8px;
            border-left: 4px solid #22c55e;
            margin: 15px 0;
        }
        
        @media (max-width: 768px) {
            .users-container {
                padding: 60px 20px 20px 20px;
                margin: 10px;
                width: calc(100% - 20px);
            }
            
            .create-user-btn-top {
                top: 15px !important;
                left: 15px !important;
                padding: 8px 16px !important;
                font-size: 0.8em !important;
            }
            
            .create-user-btn-top svg {
                width: 16px;
                height: 16px;
            }
            
            .users-container table {
                font-size: 0.8em;
            }
            
            .action-btn {
                width: 32px !important;
                height: 32px !important;
                margin: 0 2px !important;
            }
            
            .action-btn svg {
                width: 16px !important;
                height: 16px !important;
            }
            
            .pagination {
                padding: 10px;
                border-radius: 25px;
            }
            
            .pagination a, 
            .pagination span {
                min-width: 36px;
                height: 36px;
                font-size: 0.8em;
                padding: 0 12px;
            }
            
            .pagination .nav-btn {
                min-width: 50px;
                font-size: 0.75em;
            }
            
            .pagination-info {
                font-size: 0.8em;
                text-align: center;
            }
        }
        
        @media (max-width: 600px) {
            .users-container table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }
            
            .users-container table th, 
            .users-container table td {
                min-width: 120px;
                padding: 10px 8px;
            }
            
            .pagination {
                gap: 4px;
            }
            
            .pagination a, 
            .pagination span {
                min-width: 32px;
                height: 32px;
                font-size: 0.75em;
                padding: 0 8px;
            }
        }
    </style>
</head>
<body>
    <div class="background"></div>
    <div class="users-container">
        <!-- Botón Crear Usuario en esquina superior izquierda -->
        <a href="{{ route('crear') }}" class="create-user-btn-top">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 32 32">
                <path fill="currentColor" d="M14 4c-3.854 0-7 3.146-7 7c0 2.41 1.23 4.552 3.094 5.813C6.527 18.343 4 21.88 4 26h2c0-4.43 3.57-8 8-8c1.376 0 2.654.358 3.78.97A8 8 0 0 0 16 24c0 4.406 3.594 8 8 8s8-3.594 8-8s-3.594-8-8-8a7.98 7.98 0 0 0-4.688 1.53c-.442-.277-.92-.51-1.406-.718A7.02 7.02 0 0 0 21 11c0-3.854-3.146-7-7-7m0 2c2.773 0 5 2.227 5 5s-2.227 5-5 5s-5-2.227-5-5s2.227-5 5-5m10 12c3.326 0 6 2.674 6 6s-2.674 6-6 6s-6-2.674-6-6s2.674-6 6-6m-1 2v3h-3v2h3v3h2v-3h3v-2h-3v-3z"/>
            </svg>
            Crear
        </a>
        
        <h2>Lista de Usuarios</h2>
        @if (session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="error">{{ session('error') }}</div>
        @endif
        @if ($usuarios->isEmpty())
            <p style="color: #666; font-size: 1.1em; margin: 40px 0;">No hay usuarios registrados.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre de Usuario</th>
                        <th>Correo Electrónico</th>
                        <th>Número de Teléfono</th>
                        <th>Fecha de Nacimiento</th>
                        <th>Fecha de Registro</th>
                        <th>Rol</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($usuarios as $usuario)
                        <tr>
                            <td>{{ $usuario->id }}</td>
                            <td>{{ $usuario->nombre_usuario }}</td>
                            <td>{{ $usuario->correo_electronico }}</td>
                            <td>{{ $usuario->numero_telefono ?? 'N/A' }}</td>
                            <td>{{ $usuario->fecha_nacimiento ? $usuario->fecha_nacimiento->format('d/m/Y') : 'N/A' }}</td>
                            <td>{{ $usuario->fecha_registro ? $usuario->fecha_registro->format('d/m/Y H:i') : 'N/A' }}</td>
                            <td>{{ $usuario->rol }}</td>
                            <td>
                                <div style="display: flex; align-items: center; gap: 4px;">
                                    <a href="{{ route('usuarios.edit', $usuario->id) }}" class="action-btn edit" title="Editar usuario">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                                            <path fill="currentColor" d="m19.3 8.925l-4.25-4.2l1.4-1.4q.575-.575 1.413-.575t1.412.575l1.4 1.4q.575.575.6 1.388t-.6 1.387L19.3 8.925ZM17.85 10.4L7.25 21H3v-4.25l10.6-10.6l4.25 4.25Z"/>
                                        </svg>
                                    </a>
                                    <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" style="display:inline; margin: 0;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="action-btn delete" title="Eliminar usuario" onclick="return confirm('¿Estás seguro de que quieres eliminar a {{ $usuario->nombre_usuario }}?')">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                                                <path fill="currentColor" d="M7 21q-.825 0-1.412-.587T5 19V6H4V4h5V3h6v1h5v2h-1v13q0 .825-.587 1.413T17 21zm2-4h2V8H9zm4 0h2V8h-2z"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
            <!-- Paginación Mejorada -->
            <div class="pagination-wrapper">
                <div class="pagination-info">
                    Mostrando {{ $usuarios->firstItem() }} - {{ $usuarios->lastItem() }} de {{ $usuarios->total() }} usuarios
                </div>
                <div class="pagination">
                    <!-- Botón anterior -->
                    @if ($usuarios->onFirstPage())
                        <span class="nav-btn disabled">‹ Anterior</span>
                    @else
                        <a href="{{ $usuarios->previousPageUrl() }}" class="nav-btn">‹ Anterior</a>
                    @endif
                    
                    <!-- Números de página -->
                    @foreach ($usuarios->getUrlRange(1, $usuarios->lastPage()) as $page => $url)
                        @if ($page == $usuarios->currentPage())
                            <span class="active">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}">{{ $page }}</a>
                        @endif
                        
                        <!-- Separador para muchas páginas -->
                        @if ($page < $usuarios->lastPage() && $page < 3 && $usuarios->lastPage() > 5 && $usuarios->currentPage() < 3)
                            @if ($page == 2)
                                <span class="separator">...</span>
                            @endif
                        @endif
                    @endforeach
                    
                    <!-- Botón siguiente -->
                    @if ($usuarios->hasMorePages())
                        <a href="{{ $usuarios->nextPageUrl() }}" class="nav-btn">Siguiente ›</a>
                    @else
                        <span class="nav-btn disabled">Siguiente ›</span>
                    @endif
                </div>
            </div>
        @endif
        
        <!-- Botón al final -->
        <div style="margin-top: 30px;">
            <a href="{{ route('home') }}">Volver al inicio</a>
        </div>
    </div>
</body>
</html>