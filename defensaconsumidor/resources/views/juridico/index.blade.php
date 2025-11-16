<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contenido Jurídico</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #3f35bb;
            --primary-dark: #2e268a;
            --bg-light: #f0f0f0;
            --card-bg: #ffffff;
            --border: #e0e0e0;
            --text: #1a1a1a;
            --text-muted: #555;
            --action: blue;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: var(--bg-light);
            color: var(--text);
            line-height: 1.6;
            padding: 24px;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
        }

        header {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: flex-start;
            gap: 16px;
            padding-bottom: 24px;
            border-bottom: 1px solid var(--border);
            margin-bottom: 32px;
        }

        header h1 {
            font-weight: 700;
            font-size: 2.2rem;
            color: var(--text);
            letter-spacing: -0.5px;
        }

        .btn-group {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 10px 20px;
            background: var(--primary);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 1rem;
            transition: background 0.2s ease, transform 0.15s ease;
            box-shadow: 0 2px 6px rgba(63, 53, 187, 0.2);
        }

        .btn:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
        }

        .btn:active {
            transform: translateY(0);
        }

        .juridico-list {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .item {
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.03);
            transition: box-shadow 0.25s ease;
        }

        .item:hover {
            box-shadow: 0 6px 16px rgba(0,0,0,0.08);
        }

        .item h3 {
            font-size: 1.4rem;
            font-weight: 700;
            margin-bottom: 14px;
            color: var(--text);
        }

        .item p {
            color: var(--text-muted);
            font-size: 1rem;
            margin-bottom: 20px;
            white-space: pre-wrap;
            line-height: 1.7;
        }

        .actions {
            display: flex;
            gap: 16px;
            align-items: center;
            flex-wrap: wrap;
        }

        .actions a, .delete-btn {
            font-weight: 600;
            font-size: 0.95rem;
            color: var(--action);
            text-decoration: none;
            padding: 6px 10px;
            border-radius: 6px;
            transition: background 0.2s ease;
        }

        .actions a:hover,
        .delete-btn:hover {
            background: rgba(0,0,255,0.05);
            text-decoration: underline;
        }

        .delete-form {
            margin: 0;
            padding: 0;
            display: inline;
        }

        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: var(--text-muted);
            font-style: italic;
            border: 1px dashed var(--border);
            border-radius: 12px;
            background: #fafafa;
        }

        @media (max-width: 600px) {
            header h1 {
                font-size: 1.8rem;
            }
            .btn {
                padding: 8px 16px;
                font-size: 0.95rem;
            }
            .item {
                padding: 18px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Contenido Jurídico</h1>
            <div class="btn-group">
                <a href="{{ route('juridico.create') }}" class="btn">+ Agregar Nuevo</a>
                <a href="{{ route('dashboard') }}" class="btn">Dashboard</a>
                <a href="{{ route('logout') }}" class="btn">Cerrar Sesión</a>
            </div>
        </header>

        <main class="juridico-list">
            @forelse($juridicos as $juridico)
                <article class="item">
                    <h3>{{ $juridico->titulo ?? 'Sin título' }}</h3>
                    <p>{{ $juridico->contenido }}</p>
                    <div class="actions">
                        <a href="{{ route('juridico.edit', $juridico) }}">Editar</a>
                        <form action="{{ route('juridico.destroy', $juridico) }}" method="POST" class="delete-form" onsubmit="return confirm('¿Eliminar este contenido jurídico? Esta acción no se puede deshacer.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-btn">Eliminar</button>
                        </form>
                    </div>
                </article>
            @empty
                <div class="empty-state">
                    <p>No hay documentos jurídicos registrados aún.</p>
                </div>
            @endforelse
        </main>
    </div>
</body>
</html>