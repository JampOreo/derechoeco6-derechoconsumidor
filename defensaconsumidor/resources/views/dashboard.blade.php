<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Defensa al Consumidor</title>
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

        /* Chatbot */
        .chat-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            overflow: hidden;
            margin-top: 30px;
        }
        .chat-header {
            background: #3f35bb;
            color: white;
            padding: 15px;
            text-align: center;
            font-weight: bold;
        }
        .chat-messages {
            height: 300px;
            overflow-y: auto;
            padding: 15px;
            background: #f9f9ff;
        }
        .message {
            margin-bottom: 15px;
            max-width: 80%;
            padding: 10px 15px;
            border-radius: 18px;
            line-height: 1.4;
            position: relative;
            word-wrap: break-word;
        }
        .bot-message {
            background: #e0e0e0;
            align-self: flex-start;
            border-bottom-left-radius: 5px;
        }
        .user-message {
            background: #3f35bb;
            color: white;
            margin-left: auto;
            border-bottom-right-radius: 5px;
        }
        .chat-input {
            display: flex;
            padding: 15px;
            background: white;
            border-top: 1px solid #eee;
        }
        .chat-input input {
            flex: 1;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 25px;
            outline: none;
            font-size: 16px;
        }
        .chat-input button {
            background: #3f35bb;
            color: white;
            border: none;
            border-radius: 50%;
            width: 45px;
            height: 45px;
            margin-left: 10px;
            cursor: pointer;
            font-size: 18px;
        }
        .chat-input button:hover {
            background: #2e268a;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Defensa al Consumidor</h1>
        <p>El Derecho del Consumidor es un conjunto de normas y principios que protegen a las personas...</p>
    </div>

    <div class="container">
        <div class="links">
            <a href="{{ route('juridico.index') }}" class="btn">Contenido Jurídico</a>
            <a href="{{ route('consejos.index') }}" class="btn">Contactos y consejos</a>
            <a href="{{ route('login') }}" class="btn" style="background: #ff6b6b;">Admin Login</a>
        </div>

        <!-- Chatbot -->
        <div class="chat-container">
            <div class="chat-header">Asistente Virtual</div>
            <div class="chat-messages" id="chat-messages">
                <div class="message bot-message">¡Hola! Soy tu asistente virtual. Puedes preguntarme sobre temas de defensa al consumidor.</div>
            </div>
            <div class="chat-input">
                <input type="text" id="user-input" placeholder="Escribe tu pregunta..." autocomplete="off">
                <button id="send-btn">➤</button>
            </div>
        </div>
    </div>

    <script>
document.addEventListener('DOMContentLoaded', function () {
    const chatMessages = document.getElementById('chat-messages');
    const userInput = document.getElementById('user-input');
    const sendBtn = document.getElementById('send-btn');

    function addMessage(text, isUser = false) {
        const messageDiv = document.createElement('div');
        messageDiv.classList.add('message');
        messageDiv.classList.add(isUser ? 'user-message' : 'bot-message');
        messageDiv.innerHTML = isUser ? text : ''; // El bot empieza vacío
        chatMessages.appendChild(messageDiv);
        chatMessages.scrollTop = chatMessages.scrollHeight;
        return messageDiv;
    }

    function typeMessage(element, text, callback = null) {
        let i = 0;
        const speed = 20; // ms por letra

        function type() {
            if (i < text.length) {
                // Manejar saltos de línea y HTML simple
                if (text.substr(i, 4) === '<br>') {
                    element.innerHTML += '<br>';
                    i += 4;
                } else if (text.substr(i, 3) === '&lt') {
                    // Evitar romper con caracteres especiales
                    element.innerHTML += text[i];
                    i++;
                } else {
                    element.innerHTML += text[i];
                    i++;
                }
                chatMessages.scrollTop = chatMessages.scrollHeight;
                setTimeout(type, speed);
            } else if (callback) {
                callback();
            }
        }
        type();
    }

    function showTypingIndicator() {
        const indicator = document.createElement('div');
        indicator.classList.add('message', 'bot-message');
        indicator.id = 'typing-indicator';
        indicator.textContent = '';
        chatMessages.appendChild(indicator);
        chatMessages.scrollTop = chatMessages.scrollHeight;

        // Animación de puntos: "...", luego desaparece
        let dots = 0;
        const typingInterval = setInterval(() => {
            indicator.textContent = '.'.repeat(dots % 4);
            dots++;
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }, 500);

        return { element: indicator, interval: typingInterval };
    }

    function hideTypingIndicator(indicatorInfo) {
        clearInterval(indicatorInfo.interval);
        indicatorInfo.element.remove();
    }

    function sendMessage() {
        const message = userInput.value.trim();
        if (!message) return;

        // Mostrar mensaje del usuario
        addMessage(message, true);
        userInput.value = '';
        userInput.disabled = true;
        sendBtn.disabled = true;

        // Mostrar indicador de "escribiendo"
        const typingIndicator = showTypingIndicator();

        // Simular retraso de "pensar" (300ms)
        setTimeout(() => {
            fetch("{{ route('chatbot') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ message: message })
            })
            .then(response => response.json())
            .then(data => {
                // Ocultar indicador
                hideTypingIndicator(typingIndicator);

                // Mostrar mensaje del bot con animación de escritura
                const botMessageDiv = addMessage('', false);
                typeMessage(botMessageDiv, data.reply);
            })
            .catch(error => {
                hideTypingIndicator(typingIndicator);
                const botMessageDiv = addMessage('', false);
                typeMessage(botMessageDiv, "Hubo un error al procesar tu pregunta. Inténtalo de nuevo.");
            })
            .finally(() => {
                userInput.disabled = false;
                sendBtn.disabled = false;
                userInput.focus();
            });
        }, 300);
    }

    sendBtn.addEventListener('click', sendMessage);
    userInput.addEventListener('keypress', function (e) {
        if (e.key === 'Enter') sendMessage();
    });
});
</script>
</body>
</html>