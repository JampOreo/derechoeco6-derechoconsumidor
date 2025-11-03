<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consejos y Contactos</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f7ff;
            color: #333;
            line-height: 1.6;
        }
        .header {
            background: #3f35bb;
            color: white;
            padding: 20px;
            text-align: center;
        }
        .container {
            max-width: 900px;
            margin: 20px auto;
            padding: 0 15px;
        }
        .links {
            text-align: center;
            margin: 20px 0;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin: 8px;
            background: #3f35bb;
            color: white;
            text-decoration: none;
            border-radius: 20px;
            font-weight: bold;
        }
        .btn:hover {
            background: #2e268a;
        }

        /* Contenido principal */
        .content-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            padding: 25px;
            margin-bottom: 25px;
        }
        .content-card h2 {
            color: #3f35bb;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid #e0e0ff;
        }
        .content-card p {
            margin-bottom: 12px;
            font-size: 16px;
        }
        .contact-info {
            background: #f0f0ff;
            padding: 15px;
            border-radius: 10px;
            margin-top: 15px;
        }
        .contact-info strong {
            color: #3f35bb;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Consejos y Contactos</h1>
    </div>

    <div class="container">
        <div class="links">
            <a href="{{ route('dashboard') }}" class="btn">Inicio</a>
            <a href="{{ route('juridico.index') }}" class="btn">Contenido Jurídico</a>
            @auth
                @if(auth()->user()->is_admin)
                    <a href="{{ route('logout') }}" class="btn" style="background: #ff6b6b; border: none; text-decoration: none;">Cerrar Sesión</a>
                @endif
            @endauth
            @guest
                <a href="{{ route('login') }}" class="btn" style="background: #ff6b6b;">Admin Login</a>
            @endguest
        </div>

        <!-- Consejos -->
        <div class="content-card">
            <h2>Consejos para el Consumidor</h2>
            <p>
                <!-- 👇 ESPACIO PARA TEXTO DE CONSEJOS -->
                Siempre guarda tus facturas o comprobantes de compra. En caso de un problema con un producto o servicio, 
                la documentación es clave para iniciar un reclamo. Además, intenta resolver el problema directamente 
                con el proveedor antes de acudir a Defensa del Consumidor.
            </p>
            <p>
                Recuerda que tienes derecho a recibir información clara sobre el precio, características y garantía 
                de cualquier producto o servicio que adquieras.
            </p>
        </div>

        <!-- Contactos -->
        <div class="content-card">
            <h2>Contacto Oficial</h2>
            <p>
                <!-- 👇 ESPACIO PARA TEXTO DE CONTACTO -->
                La Dirección Provincial de Defensa del Consumidor en Misiones atiende en la ciudad de Posadas.
            </p>
            <div class="contact-info">
                <p><strong>Dirección:</strong> Av. Mitre 196 (esquina Pellegrini), Posadas, Misiones</p>
                <p><strong>Teléfono:</strong> (0376) 444-7533</p>
                <p><strong>Horario de atención:</strong> Lunes a viernes de 7:00 a 13:00 hs</p>
                <p><strong>Importante:</strong> No cuenta con página web propia. Para más información, visita el sitio del Gobierno de Misiones.</p>
            </div>
        </div>
    </div>
</body>
</html>