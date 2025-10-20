<!DOCTYPE html>
<html lang="es">
<head>
    <title>Contenido Jurídico</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f0f0f0; padding: 20px; }
        .content { background: white; padding: 20px; border-radius: 10px; }
        .item { margin: 20px 0; padding: 15px; border: 1px solid #ddd; border-radius: 5px; }
        .actions a { margin-right: 10px; text-decoration: none; color: blue; }
        .btn { padding: 5px 10px; background: #3f35bb; color: white; text-decoration: none; border-radius: 5px; }
        .btn:hover { background: #2e268a; }
    </style>
</head>
<body>
    <h1>Contenido Jurídico</h1>
    <a href="{{ route('juridico.create') }}" class="btn">Agregar Nuevo</a>
    <a href="{{ route('dashboard') }}" class="btn">Volver al Dashboard</a>
    <a href="{{ route('logout') }}" class="btn">Cerrar Sesión</a>

    @foreach($juridicos as $juridico)
        <div class="item">
            <h3>{{ $juridico->titulo ?? 'Sin título' }}</h3>
            <p>{{ $juridico->contenido }}</p>
            <div class="actions">
                <a href="{{ route('juridico.edit', $juridico) }}">Editar</a>
                <form action="{{ route('juridico.destroy', $juridico) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('¿Eliminar?')">Eliminar</button>
                </form>
            </div>
        </div>
    @endforeach
</body>
</html>