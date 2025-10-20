<!DOCTYPE html>
<html lang="es">
<head>
    <title>Editar Contenido Jurídico</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f0f0f0; padding: 20px; }
        form { max-width: 600px; margin: 0 auto; background: white; padding: 20px; border-radius: 10px; }
        input, textarea { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ccc; border-radius: 5px; }
        button { padding: 10px 20px; background: #3f35bb; color: white; border: none; border-radius: 5px; cursor: pointer; }
        button:hover { background: #2e268a; }
    </style>
</head>
<body>
    <h1>Editar Contenido Jurídico</h1>
    <form method="POST" action="{{ route('juridico.update', $juridico) }}">
        @csrf
        @method('PUT')
        <input type="text" name="titulo" value="{{ $juridico->titulo }}" placeholder="Título (opcional)">
        <textarea name="contenido" rows="10" placeholder="Contenido jurídico" required>{{ $juridico->contenido }}</textarea>
        <button type="submit">Actualizar</button>
    </form>
    <br>
    <a href="{{ route('juridico.index') }}">Volver</a>
</body>
</html>