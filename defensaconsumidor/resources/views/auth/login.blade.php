<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login - Admin</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f0f0f0; padding: 20px; }
        .login-box { max-width: 400px; margin: 50px auto; padding: 20px; background: white; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        input { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ccc; border-radius: 5px; }
        button { width: 100%; padding: 10px; background: #3f35bb; color: white; border: none; border-radius: 5px; cursor: pointer; }
        button:hover { background: #2e268a; }
        .error { color: red; }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Login Admin</h2>
        @if(session('success'))
            <div style="color: green;">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="error">{{ $errors->first() }}</div>
        @endif
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <input type="email" name="email" placeholder="Email" value="admin@example.com" required>
            <input type="password" name="password" placeholder="Contraseña" value="password" required>
            <button type="submit">Iniciar Sesión</button>
        </form>
        <br>
        <a href="{{ route('dashboard') }}">Volver al dashboard</a>
    </div>
</body>
</html>