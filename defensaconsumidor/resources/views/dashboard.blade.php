<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Defensa al Consumidor</title>
    <style>
        body { font-family: Arial, sans-serif; background: #dcd6f7; padding: 20px; }
        .header { background: #3f35bb; color: white; padding: 20px; text-align: center; border-radius: 0 0 20px 20px; }
        .container { max-width: 800px; margin: 20px auto; }
        .input-box { width: 100%; padding: 10px; margin: 10px 0; border-radius: 20px; border: none; }
        .btn { display: inline-block; padding: 10px 20px; margin: 10px; background: #3f35bb; color: white; border-radius: 20px; text-decoration: none; }
        .btn:hover { background: #2e268a; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Defensa al Consumidor</h1>
        <p>El Derecho del Consumidor es un conjunto de normas y principios que protegen a las personas...</p>
    </div>

    <div class="container">
        <form id="chatbotForm" method="POST" action="{{ route('chatbot.submit') }}">
            @csrf
            <input type="text" name="question" class="input-box" placeholder="Preguntar al chatbot..." required>
        </form>

        <div style="text-align: center;">
            <a href="{{ route('juridico.index') }}" class="btn">Contenido Jurídico</a>
            <a href="{{ route('consejos.index') }}" class="btn">Contactos y consejos</a>
            <a href="{{ route('login') }}" class="btn" style="background: #ff6b6b;">Admin Login</a>
        </div>
    </div>

    <script>
        document.getElementById('chatbotForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            fetch('{{ route("chatbot.submit") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => alert(data.response))
            .catch(err => alert('Error al enviar la pregunta.'));
        });
    </script>
</body>
</html>