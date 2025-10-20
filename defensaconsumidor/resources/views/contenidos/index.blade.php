<!DOCTYPE html>
<html lang="es">
<head>
    <title>Contactos y Consejos</title>
    <style>
        body { font-family: Arial, sans-serif; background: #dcd6f7; padding: 20px; }
        .header { background: #3f35bb; color: white; padding: 20px; text-align: center; border-radius: 0 0 20px 20px; }
        .container { max-width: 800px; margin: 20px auto; background: white; padding: 20px; border-radius: 10px; }
        .btn { display: inline-block; padding: 10px 20px; margin: 10px; background: #3f35bb; color: white; border-radius: 20px; text-decoration: none; }
        .btn:hover { background: #2e268a; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Defensa al Consumidor</h1>
    </div>

    <div class="container">
        <p>{{ $texto }}</p>
        <a href="{{ route('dashboard') }}" class="btn">Volver al Dashboard</a>
    </div>
</body>
</html>