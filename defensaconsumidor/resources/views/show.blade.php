<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $titulo ?? 'Contenido Jurídico' }}</title>
    <style>
        /* Reset básico */
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: #f9fafc;
            color: #1f2937;
            line-height: 1.6;
            padding: 20px;
        }

        .container {
            display: flex;
            max-width: 1200px;
            margin: 0 auto;
            gap: 32px;
        }

        /* Sumario (Tabla de contenidos) */
        .toc {
            width: 280px;
            background: white;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            position: sticky;
            top: 24px;
            align-self: flex-start;
            max-height: calc(100vh - 60px);
            overflow-y: auto;
        }

        .toc-header {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 16px;
            color: #3f35bb;
            padding-bottom: 8px;
            border-bottom: 2px solid #eef1ff;
        }

        .toc-list {
            list-style: none;
        }

        .toc-list li {
            margin-bottom: 10px;
        }

        .toc-list a {
            text-decoration: none;
            color: #374151;
            font-size: 0.95rem;
            display: block;
            padding: 4px 0;
            transition: color 0.2s;
        }

        .toc-list a:hover {
            color: #3f35bb;
        }

        .toc-h3 {
            padding-left: 16px;
            font-size: 0.9rem;
            opacity: 0.85;
        }

        /* Contenido principal */
        .main-content {
            flex: 1;
            background: white;
            padding: 32px;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.06);
        }

        .main-content h1 {
            font-size: 2rem;
            margin-bottom: 24px;
            color: #1e293b;
            line-height: 1.3;
        }

        .main-content h2 {
            font-size: 1.5rem;
            margin: 32px 0 20px;
            padding-bottom: 8px;
            border-bottom: 1px solid #f1f3f9;
            scroll-margin-top: 70px;
        }

        .main-content h3 {
            font-size: 1.25rem;
            margin: 28px 0 16px;
            scroll-margin-top: 70px;
        }

        .main-content p {
            margin-bottom: 18px;
            color: #334155;
        }

        /* Acciones (editar, volver, etc.) */
        .actions {
            margin-top: 32px;
            padding-top: 24px;
            border-top: 1px solid #f1f3f9;
        }

        .btn {
            display: inline-block;
            padding: 8px 16px;
            margin-right: 10px;
            margin-bottom: 8px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.95rem;
        }

        .btn-primary {
            background: #3f35bb;
            color: white;
        }

        .btn-primary:hover {
            background: #2e268a;
        }

        .btn-danger {
            background: #ff6b6b;
            color: white;
        }

        .btn-danger:hover {
            background: #e05a5a;
        }

        /* Mobile */
        @media (max-width: 950px) {
            .container {
                flex-direction: column;
            }
            .toc {
                position: static;
                width: 100%;
                max-height: none;
                margin-bottom: 24px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Sumario (se generará con JS) -->
        <aside class="toc" id="toc" style="display: none;">
            <div class="toc-header">Sumario</div>
            <ul class="toc-list" id="toc-list">
                <!-- Se llenará dinámicamente -->
            </ul>
        </aside>

        <!-- Contenido -->
        <main class="main-content">
            <h1>{{ $titulo ?? 'Título del contenido' }}</h1>
            <div id="contenido-principal">
                <!-- Aquí va el contenido con <h2>, <h3>, <p>, etc. -->
                {!! $contenido ?? '<p>Contenido no disponible.</p>' !!}
            </div>

            <div class="actions">
                <!-- Rutas para editar, volver, eliminar — reemplazá según tus rutas -->
                <a href="#" class="btn btn-primary">Editar</a>
                <a href="#" class="btn btn-primary">Volver</a>
                <button type="button" class="btn btn-danger" onclick="confirm('¿Eliminar?')">
                    Eliminar
                </button>
            </div>
        </main>
    </div>

    <!-- Script para generar el sumario automáticamente -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const content = document.getElementById('contenido-principal');
            const toc = document.getElementById('toc');
            const tocList = document.getElementById('toc-list');
            
            // Buscar todos los encabezados h2 y h3
            const headings = content.querySelectorAll('h2, h3');
            
            if (headings.length === 0) {
                toc.style.display = 'none';
                return;
            }
            
            toc.style.display = 'block';
            
            headings.forEach((heading) => {
                // Asegurar que tenga un ID (requerido para el anclaje)
                if (!heading.id) {
                    // Generar ID limpio desde el texto
                    heading.id = heading.textContent
                        .toLowerCase()
                        .replace(/[^a-z0-9\s-]/g, '')
                        .replace(/\s+/g, '-')
                        .replace(/-+/g, '-');
                }
                
                // Crear ítem del sumario
                const li = document.createElement('li');
                const link = document.createElement('a');
                link.href = '#' + heading.id;
                link.textContent = heading.textContent;
                link.classList.add('toc-' + heading.tagName.toLowerCase());
                
                // Scroll suave al hacer clic
                link.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.getElementById(heading.id);
                    const offsetTop = target.getBoundingClientRect().top + window.scrollY - 70;
                    window.scrollTo({ top: offsetTop, behavior: 'smooth' });
                });
                
                li.appendChild(link);
                tocList.appendChild(li);
            });
        });
    </script>
</body>
</html>