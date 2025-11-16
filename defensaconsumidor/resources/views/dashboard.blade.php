<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Defensa al Consumidor</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=IBM+Plex+Sans:wght@500&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: #d6d6d8ff;
            color: #1a1a1a;
            line-height: 1.65;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .hero {
            background: 
                linear-gradient(to bottom, 
                    rgba(63, 53, 187, 0.95) 0%, 
                    rgba(63, 53, 187, 0.7) 30%, 
                    rgba(63, 53, 187, 0.4) 70%, 
                    rgba(63, 53, 187, 0.1) 100%
                ),
                url('{{ asset('images/defensaalconsumidor.jpg') }}') center/cover no-repeat;
            height: 100vh;
            min-height: 600px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: white;
            position: relative;
            width: 100%;
        }

        .hero h1 {
            font-family: 'IBM Plex Sans', sans-serif;
            font-weight: 600;
            font-size: 3rem;
            margin-bottom: 20px;
            text-shadow: 0 2px 10px rgba(0,0,0,0.3);
            z-index: 2;
            letter-spacing: -0.5px;
            animation: fadeInUp 1s ease-out;
        }

        .hero p {
            font-size: 1.3rem;
            max-width: 600px;
            margin: 0 auto;
            opacity: 0.95;
            line-height: 1.6;
            z-index: 2;
            animation: fadeInUp 1s ease-out 0.3s both;
        }

        .quick-access {
            display: flex;
            justify-content: center;
            gap: 20px;
            padding: 40px 20px 50px;
            background: #f0f0f0;
            position: relative;
            z-index: 10;
            animation: fadeIn 0.8s ease-out 0.5s both;
        }

        .action-card {
            background: white;
            border-radius: 16px;
            padding: 20px 28px;
            text-align: center;
            text-decoration: none;
            color: #1a1a1a;
            font-weight: 600;
            font-size: 1.05rem;
            box-shadow: 0 6px 16px rgba(63, 53, 187, 0.12);
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            min-width: 220px;
            border: 2px solid transparent;
            cursor: pointer;
            transform: translateY(0);
            position: relative;
            overflow: hidden;
        }

        .action-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(63, 53, 187, 0.1), transparent);
            transition: left 0.6s ease;
        }

        .action-card:hover::before {
            left: 100%;
        }

        .action-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 12px 30px rgba(63, 53, 187, 0.25);
            border-color: #3f35bb;
        }

        .action-card.admin {
            background: #fff0f0;
            border-color: #ff6b6b;
        }

        .action-card.admin:hover {
            border-color: #e05a5a;
            box-shadow: 0 12px 30px rgba(255, 107, 107, 0.2);
        }

        .action-card span {
            display: block;
            margin-top: 8px;
            font-weight: 400;
            font-size: 0.9rem;
            color: #555;
            transition: color 0.3s ease;
        }

        .action-card:hover span {
            color: #3f35bb;
        }

        .main-container {
            display: flex;
            max-width: 1600px;
            width: 100%;
            margin: 0 auto;
            padding: 0 20px;
            gap: 20px;
            flex-grow: 1;
            position: relative;
        }

        .content-section {
            flex: 1;
            background: white;
            border-radius: 18px;
            padding: 25px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.1);
            margin-right: 320px;
            transition: margin-right 0.3s ease;
        }

        .content-section.full-width {
            margin-right: 0;
        }

        .summary-wrapper {
            position: fixed;
            top: 200px;
            right: 20px;
            width: 300px;
            height: calc(100vh - 220px); /* LIMITADO: Solo hasta donde empieza el contenido jurídico */
            max-height: calc(100vh - 220px); /* LIMITADO */
            z-index: 100;
            transition: transform 0.3s ease;
        }

        .summary-section {
            height: 100%;
            background: white;
            border-radius: 18px;
            padding: 20px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.1);
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            border: 2px solid #f0f3ff;
        }

        .summary-section.collapsed {
            transform: translateX(100%);
        }

        .summary-section h2 {
            font-family: 'IBM Plex Sans', sans-serif;
            font-weight: 600;
            font-size: 1.3rem;
            margin-bottom: 15px;
            color: #3f35bb;
            text-align: center;
            animation: fadeIn 0.6s ease-out;
        }

        .summary-list {
            list-style-type: none;
            padding-left: 0;
            flex: 1;
            overflow-y: auto;
        }

        .summary-list li {
            margin-bottom: 10px;
            font-size: 0.95rem;
            animation: fadeInLeft 0.5s ease-out;
            animation-fill-mode: both;
        }

        .summary-list li:nth-child(1) { animation-delay: 0.1s; }
        .summary-list li:nth-child(2) { animation-delay: 0.15s; }
        .summary-list li:nth-child(3) { animation-delay: 0.2s; }
        .summary-list li:nth-child(4) { animation-delay: 0.25s; }
        .summary-list li:nth-child(5) { animation-delay: 0.3s; }
        .summary-list li:nth-child(6) { animation-delay: 0.35s; }
        .summary-list li:nth-child(7) { animation-delay: 0.4s; }
        .summary-list li:nth-child(8) { animation-delay: 0.45s; }
        .summary-list li:nth-child(9) { animation-delay: 0.5s; }
        .summary-list li:nth-child(10) { animation-delay: 0.55s; }
        .summary-list li:nth-child(11) { animation-delay: 0.6s; }
        .summary-list li:nth-child(12) { animation-delay: 0.65s; }
        .summary-list li:nth-child(13) { animation-delay: 0.7s; }
        .summary-list li:nth-child(14) { animation-delay: 0.75s; }

        .summary-list a {
            color: #222;
            text-decoration: none;
            display: block;
            padding: 12px 16px;
            border-radius: 10px;
            transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            border-left: 3px solid transparent;
            position: relative;
            overflow: hidden;
        }

        .summary-list a::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(63, 53, 187, 0.1), transparent);
            transition: left 0.6s ease;
        }

        .summary-list a:hover::before {
            left: 100%;
        }

        .summary-list a:hover,
        .summary-list a.active {
            background: #3f35bb;
            color: white;
            transform: translateX(8px);
            border-left-color: #2e268a;
            box-shadow: 0 4px 12px rgba(63, 53, 187, 0.2);
        }

        .summary-controls {
            display: flex;
            gap: 10px;
            margin-top: 15px;
            animation: fadeInUp 0.6s ease-out 0.8s both;
        }

        .summary-toggle-btn,
        .back-to-top-btn {
            flex: 1;
            background: #3f35bb;
            color: white;
            border: none;
            border-radius: 10px;
            padding: 12px;
            cursor: pointer;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            position: relative;
            overflow: hidden;
        }

        .summary-toggle-btn::before,
        .back-to-top-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.6s ease;
        }

        .summary-toggle-btn:hover::before,
        .back-to-top-btn:hover::before {
            left: 100%;
        }

        .summary-toggle-btn:hover,
        .back-to-top-btn:hover {
            background: #2a207a;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(63, 53, 187, 0.3);
        }

        .floating-toggle {
            position: fixed;
            top: 200px;
            right: 20px;
            width: 50px;
            height: 50px;
            background: #3f35bb;
            color: white;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            z-index: 101;
            display: none;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            box-shadow: 0 6px 20px rgba(63, 53, 187, 0.3);
            transition: all 0.3s ease;
            animation: bounceIn 0.6s ease-out;
        }

        .floating-toggle:hover {
            background: #2a207a;
            transform: scale(1.1);
            box-shadow: 0 8px 25px rgba(63, 53, 187, 0.4);
        }

        .section {
            margin-bottom: 40px;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
            animation: fadeInUp 0.6s ease-out;
            animation-fill-mode: both;
        }

        .section:nth-child(1) { animation-delay: 0.1s; }
        .section:nth-child(2) { animation-delay: 0.2s; }
        .section:nth-child(3) { animation-delay: 0.3s; }
        .section:nth-child(4) { animation-delay: 0.4s; }
        .section:nth-child(5) { animation-delay: 0.5s; }
        .section:nth-child(6) { animation-delay: 0.6s; }
        .section:nth-child(7) { animation-delay: 0.7s; }
        .section:nth-child(8) { animation-delay: 0.8s; }
        .section:nth-child(9) { animation-delay: 0.9s; }
        .section:nth-child(10) { animation-delay: 1.0s; }
        .section:nth-child(11) { animation-delay: 1.1s; }
        .section:nth-child(12) { animation-delay: 1.2s; }
        .section:nth-child(13) { animation-delay: 1.3s; }
        .section:nth-child(14) { animation-delay: 1.4s; }

        .section:last-child {
            border-bottom: none;
        }

        .section h2 {
            font-family: 'IBM Plex Sans', sans-serif;
            font-weight: 600;
            font-size: 1.6rem;
            color: #3f35bb;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #f0f3ff;
            transition: all 0.3s ease;
        }

        .section h2:hover {
            color: #2e268a;
            border-bottom-color: #3f35bb;
        }

        .section h3 {
            font-family: 'IBM Plex Sans', sans-serif;
            font-weight: 500;
            font-size: 1.3rem;
            color: #2e268a;
            margin-top: 25px;
            margin-bottom: 15px;
            transition: color 0.3s ease;
        }

        .section h3:hover {
            color: #3f35bb;
        }

        .section p {
            font-size: 1.05rem;
            line-height: 1.75;
            margin-bottom: 20px;
            text-align: justify;
            transition: all 0.3s ease;
        }

        .section:hover p {
            color: #333;
        }

        /* Chatbot a la izquierda */
        .floating-chat-btn {
            position: fixed;
            bottom: 30px;
            left: 30px;
            width: 70px;
            height: 70px;
            background: #3f35bb;
            color: white;
            border: none;
            border-radius: 50%;
            font-size: 28px;
            cursor: pointer;
            box-shadow: 0 8px 25px rgba(63, 53, 187, 0.4);
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            animation: bounceIn 0.8s ease-out 1s both;
        }

        .floating-chat-btn:hover {
            background: #2a207a;
            transform: scale(1.1) rotate(5deg);
            box-shadow: 0 12px 35px rgba(63, 53, 187, 0.6);
        }

        .chat-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 2000;
            display: none;
            animation: fadeIn 0.3s ease-out;
        }

        .chat-modal {
            position: fixed;
            bottom: 120px;
            left: 30px;
            width: 380px;
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 50px rgba(0,0,0,0.2);
            z-index: 2001;
            display: none;
            animation: slideInUp 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        .chat-header {
            background: #3f35bb;
            color: white;
            padding: 20px;
            text-align: center;
            font-weight: 600;
            font-size: 1.3rem;
            letter-spacing: 0.3px;
            animation: fadeIn 0.5s ease-out;
        }

        .chat-messages {
            height: 320px;
            overflow-y: auto;
            padding: 20px;
            background: #fafbff;
            display: flex;
            flex-direction: column;
        }

        .message {
            max-width: 82%;
            padding: 15px 20px;
            margin-bottom: 20px;
            border-radius: 22px;
            line-height: 1.55;
            word-wrap: break-word;
            font-size: 1rem;
            position: relative;
            animation: messageSlide 0.3s ease-out;
        }

        @keyframes messageSlide {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .bot-message {
            background: #eef2ff;
            color: #222;
            align-self: flex-start;
            border-bottom-left-radius: 6px;
            animation: slideInLeft 0.3s ease-out;
        }

        .user-message {
            background: #3f35bb;
            color: white;
            align-self: flex-end;
            border-bottom-right-radius: 6px;
            animation: slideInRight 0.3s ease-out;
        }

        .chat-input {
            display: flex;
            padding: 20px;
            background: white;
            border-top: 1px solid #f0f3ff;
        }

        .chat-input input {
            flex: 1;
            padding: 16px 24px;
            border: 2px solid #d4d9f7;
            border-radius: 35px;
            outline: none;
            font-size: 16px;
            font-family: 'Inter', sans-serif;
            background: #fbfcff;
            transition: all 0.3s ease;
        }

        .chat-input input:focus {
            border-color: #3f35bb;
            box-shadow: 0 0 0 4px rgba(63, 53, 187, 0.15);
            transform: scale(1.02);
        }

        .chat-input button {
            width: 55px;
            height: 55px;
            background: #3f35bb;
            color: white;
            border: none;
            border-radius: 50%;
            margin-left: 15px;
            font-size: 22px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .chat-input button:hover {
            background: #2a207a;
            transform: scale(1.1) rotate(15deg);
        }

        /* Modal para contactos */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 3000;
            align-items: center;
            justify-content: center;
            animation: fadeIn 0.3s ease-out;
        }

        .modal-content {
            background: white;
            border-radius: 20px;
            padding: 30px;
            max-width: 500px;
            width: 90%;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            animation: modalSlideIn 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        @keyframes modalSlideIn {
            from {
                opacity: 0;
                transform: scale(0.8) translateY(-50px);
            }
            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            animation: fadeIn 0.5s ease-out 0.2s both;
        }

        .modal-header h2 {
            font-family: 'IBM Plex Sans', sans-serif;
            color: #3f35bb;
            font-size: 1.5rem;
        }

        .close-btn {
            background: none;
            border: none;
            font-size: 28px;
            cursor: pointer;
            color: #666;
            transition: all 0.3s ease;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .close-btn:hover {
            color: #3f35bb;
            background: #f0f3ff;
            transform: rotate(90deg);
        }

        .contact-list {
            list-style: none;
            padding: 0;
        }

        .contact-list li {
            padding: 12px 0;
            border-bottom: 1px solid #eee;
            animation: fadeInLeft 0.5s ease-out;
            animation-fill-mode: both;
        }

        .contact-list li:nth-child(1) { animation-delay: 0.3s; }
        .contact-list li:nth-child(2) { animation-delay: 0.4s; }
        .contact-list li:nth-child(3) { animation-delay: 0.5s; }
        .contact-list li:nth-child(4) { animation-delay: 0.6s; }

        .contact-list li:last-child {
            border-bottom: none;
        }

        /* Animaciones CSS */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInLeft {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes bounceIn {
            0% {
                opacity: 0;
                transform: scale(0.3);
            }
            50% {
                opacity: 1;
                transform: scale(1.05);
            }
            70% {
                transform: scale(0.9);
            }
            100% {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
            100% {
                transform: scale(1);
            }
        }

        /* Scroll suave */
        html {
            scroll-behavior: smooth;
        }

        @media (max-width: 1100px) {
            .main-container {
                flex-direction: column;
            }
            
            .content-section {
                margin-right: 0;
                width: 100%;
            }
            
            .summary-wrapper {
                position: static;
                width: 100%;
                height: auto;
                margin-bottom: 20px;
            }
            
            .summary-section {
                height: auto;
                max-height: 300px;
            }
            
            .floating-toggle {
                display: none;
            }
            
            .chat-modal {
                left: 20px;
                right: 20px;
                width: auto;
            }

            .hero h1 {
                font-size: 2.2rem;
            }

            .hero p {
                font-size: 1.1rem;
            }
        }

        @media (max-width: 680px) {
            .hero h1 { 
                font-size: 1.8rem; 
                padding: 0 20px;
            }
            .hero p {
                font-size: 1rem;
                padding: 0 20px;
            }
            .chat-modal { 
                width: calc(100% - 40px); 
                left: 20px; 
                right: 20px; 
            }
            .main-container { padding: 10px; }
            .content-section { padding: 20px; }
            .quick-access {
                flex-direction: column;
                gap: 12px;
                padding: 20px;
            }
            
            .summary-controls {
                flex-direction: column;
            }
            
            .floating-chat-btn {
                left: 20px;
                bottom: 20px;
                width: 60px;
                height: 60px;
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <div class="hero">
        <h1>DEFENSA DEL CONSUMIDOR</h1>
        <p>Información completa sobre la Ley 24.240 de Defensa del Consumidor</p>
    </div>

    <div class="quick-access">
        <a href="#" class="action-card" id="contactos-btn">
            Contactos y consejos
            <span>Guías y recursos útiles</span>
        </a>
        <a href="/auth/login" class="action-card admin" id="login-btn">
            Admin Login
            <span>Gestión del sistema</span>
        </a>
    </div>

    <div class="main-container">
        <!-- Botón flotante para mostrar/ocultar sumario -->
        <button id="floating-toggle" class="floating-toggle">📑</button>

        <!-- Sumario fijo a la derecha -->
        <div class="summary-wrapper">
            <div class="summary-section" id="summary-section">
                <h2>Sumario de Contenidos</h2>
                <ul class="summary-list">
                    <li><a href="#introduccion" class="active">Introducción al Régimen de Protección del Consumidor</a></li>
                    <li><a href="#caracteristicas-derecho">Características del Derecho del Consumidor</a></li>
                    <li><a href="#derechos-obligaciones">Derechos y Obligaciones del Consumidor y del Proveedor</a></li>
                    <li><a href="#caracteristicas-objeto">Características del Objeto de la Relación de Consumo</a></li>
                    <li><a href="#promociones-ofertas">Promociones, Ofertas y Publicidad</a></li>
                    <li><a href="#contenido-documento-venta">Contenido del Documento de Venta</a></li>
                    <li><a href="#cosas-no-consumibles">Bienes Muebles No Consumibles</a></li>
                    <li><a href="#prestacion-servicios">Prestación de Servicios y Usuarios de Servicios Públicos Domiciliarios</a></li>
                    <li><a href="#venta-domiciliaria">Venta Domiciliaria, por Correspondencia y Otras Modalidades</a></li>
                    <li><a href="#venta-credito">Operaciones de Venta a Crédito</a></li>
                    <li><a href="#terminos-abusivos">Términos Abusivos y Cláusulas Ineficaces</a></li>
                    <li><a href="#responsabilidad-danos">Responsabilidad por Daños</a></li>
                    <li><a href="#procedimiento-sanciones">Procedimiento Administrativo y Sanciones</a></li>
                    <li><a href="#asociaciones-consumidores">Asociaciones de Consumidores: Características y Ejemplos</a></li>
                </ul>
                <div class="summary-controls">
                    <button id="summary-toggle-btn" class="summary-toggle-btn">
                        <span>▶</span> Ocultar
                    </button>
                    <button id="back-to-top-btn" class="back-to-top-btn">
                        <span>↑</span> Inicio
                    </button>
                </div>
            </div>
        </div>

        <!-- Contenido principal -->
        <div class="content-section" id="content">
            <div class="section" id="introduccion">
                <h2>Introducción al Régimen de Protección del Consumidor</h2>
                <p>La Ley Nacional Nº 24.240 de Defensa del Consumidor constituye el pilar fundamental del ordenamiento jurídico argentino en materia de protección de los derechos de los consumidores y usuarios. Promulgada con el objeto de garantizar relaciones de consumo equitativas, transparentes y justas, esta norma establece un marco integral que equilibra el poder entre las partes contratantes, privilegiando siempre el interés del consumidor como parte más vulnerable. Su carácter de orden público y su aplicación en todo el territorio nacional reflejan el compromiso del Estado con la equidad en las transacciones económicas. A través de principios como la buena fe, la información clara y la responsabilidad solidaria, la ley redefine la relación de consumo como un vínculo asimétrico que requiere protección especial.</p>
            </div>

            <div class="section" id="caracteristicas-derecho">
                <h2>Características del Derecho del Consumidor</h2>
                <p>El derecho del consumidor en el marco de la Ley 24.240 se caracteriza por ser un derecho moderno, de naturaleza social y de orden público, cuya finalidad es corregir las desigualdades estructurales entre proveedores y usuarios. Este derecho es irrenunciable, intransferible y no puede ser objeto de limitaciones contractuales. Se basa en el principio de tutela efectiva, que impone al Estado la obligación de proteger activamente al consumidor frente a prácticas abusivas o desleales. La ley adopta una interpretación favorable al consumidor en caso de duda (principio pro consumidor), lo que asegura que cualquier ambigüedad contractual o normativa se resuelva en beneficio del destinatario final. Además, reconoce la equiparación del usuario, extendiendo la protección incluso a quienes no son parte directa del contrato pero utilizan el bien o servicio en beneficio propio o familiar.</p>
            </div>

            <div class="section" id="derechos-obligaciones">
                <h2>Derechos y Obligaciones del Consumidor y del Proveedor</h2>
                <p>El régimen de derechos y obligaciones establecido por la ley es binomial y recíproco, aunque claramente orientado a proteger al consumidor. El consumidor tiene derecho a recibir información veraz, clara y completa sobre productos y servicios; a la seguridad en su uso; a la garantía legal; a la reparación de daños; y a la libre elección en caso de incumplimiento contractual. Asimismo, puede revocar compras realizadas fuera del establecimiento comercial dentro de los diez días posteriores a la contratación. Por su parte, el proveedor —entendido como toda persona física o jurídica que produce, distribuye o comercializa bienes o servicios— está obligado a cumplir con las ofertas públicas, entregar documentación adecuada, brindar garantías y actuar con lealtad y transparencia. No obstante, los profesionales liberales con título universitario quedan excluidos del régimen, salvo en lo concerniente a su publicidad.</p>
            </div>

            <div class="section" id="caracteristicas-objeto">
                <h2>Características del Objeto de la Relación de Consumo</h2>
                <p>El objeto de la relación de consumo comprende tanto bienes muebles como servicios, ofrecidos de manera onerosa o gratuita, siempre que el destinatario sea el consumidor final. La ley protege tanto la adquisición de productos nuevos como usados o reacondicionados, exigiendo que estos últimos sean identificados expresamente. Incluye también servicios públicos domiciliarios, operaciones de crédito al consumo, ventas telefónicas o por catálogo, y todo tipo de prestación que forme parte del circuito económico dirigido al consumidor. La relación se configura cuando existe una actividad profesional del proveedor y una posición de vulnerabilidad del consumidor, lo que define un ámbito de protección amplio y adaptable a nuevas formas de comercialización.</p>
            </div>

            <div class="section" id="promociones-ofertas">
                <h2>Promociones, Ofertas y Publicidad</h2>
                <p>Las promociones, ofertas y publicidad están sujetas a rigurosas exigencias para evitar prácticas engañosas. Toda oferta pública es vinculante durante su vigencia y debe incluir fechas de inicio y fin, condiciones y limitaciones. Si se revoca, debe hacerse mediante medios similares a los utilizados para su lanzamiento. La publicidad forma parte integrante del contrato y todo lo prometido en ella obliga al oferente. En el caso de ventas telefónicas, por catálogo o correo, debe figurar obligatoriamente el nombre, domicilio y CUIT del oferente. Revocar una oferta sin cumplirla se considera negativa injustificada de venta, sancionable administrativamente. Además, queda prohibida cualquier práctica que simule un reclamo judicial en cobros extrajudiciales, así como la discriminación por nacionalidad u otras condiciones.</p>
            </div>

            <div class="section" id="contenido-documento-venta">
                <h2>Contenido del Documento de Venta</h2>
                <p>El documento de venta es un instrumento esencial para garantizar la transparencia contractual. Debe contener, en idioma castellano, de forma clara и legible: descripción del bien, datos del vendedor, fabricante, distribuidor o importador, características de la garantía, plazos y condiciones de entrega, precio total a pagar e inclusiones de costos adicionales. Las cláusulas adicionales deben redactarse en letra destacada y ser firmadas por ambas partes. El consumidor debe recibir un ejemplar original del contrato. Esta obligación se mantiene independientemente de otras normativas sectoriales, asegurando que el usuario disponga de toda la información necesaria para ejercer sus derechos. La reglamentación puede simplificar el formato según la naturaleza del bien, siempre que se preserve su finalidad informativa.</p>
            </div>

            <div class="section" id="cosas-no-consumibles">
                <h2>Bienes Muebles No Consumibles</h2>
                <p>En cuanto a los bienes muebles no consumibles, la ley establece una garantía legal de seis meses para productos nuevos y tres meses para usados, computados desde la entrega. Durante este período, el consumidor tiene derecho a la reparación sin costo, y si esta no resulta satisfactoria, puede optar por la sustitución del bien, la devolución del dinero o una quita proporcional del precio. Los fabricantes, importadores y vendedores deben asegurar repuestos y servicio técnico adecuado. La responsabilidad por defectos es solidaria entre productores, importadores, distribuidores y vendedores. Además, el tiempo que el consumidor no pueda usar el bien en garantía se suma automáticamente al plazo legal, prolongando su protección. Todo ello se documenta mediante un certificado de garantía escrito, claro y completo.</p>
            </div>

            <div class="section" id="prestacion-servicios">
                <h2>Prestación de Servicios y Usuarios de Servicios Públicos Domiciliarios</h2>
                <p>Los servicios deben prestarse conforme a las condiciones ofrecidas, publicitadas o convenidas. El prestador debe entregar un presupuesto detallado que incluya descripción del trabajo, materiales, precios, plazo de ejecución y garantía. Si surgen costos adicionales no previstos, debe informarse al consumidor antes de realizarlos. Si aparecen defectos dentro de los treinta días posteriores a la finalización del servicio, el prestador está obligado a corregirlos sin cargo. En el caso de servicios públicos domiciliarios, se presume que cualquier interrupción o alteración es imputable al prestador, quien dispone de treinta días para probar lo contrario. Si no lo hace, debe reintegrar el valor total del servicio no prestado. Además, si una factura supera en un 75% el promedio de consumo histórico, se presume error, y el usuario solo debe pagar el promedio, con derecho a intereses y una indemnización del 25% si el reclamo prospera.</p>
            </div>

            <div class="section" id="venta-domiciliaria">
                <h2>Venta Domiciliaria, por Correspondencia y Otras Modalidades</h2>
                <p>La venta domiciliaria o directa, así como las modalidades por teléfono, catálogo o correo, otorgan al consumidor un derecho de arrepentimiento de diez días corridos, contados desde la entrega del bien o la celebración del contrato, lo último que ocurra. Durante este período, puede revocar la aceptación sin responsabilidad alguna, y los gastos de devolución corren por cuenta del vendedor. Este derecho debe ser informado por escrito y de forma clara en todo documento relacionado con la venta. Queda prohibido enviar productos no solicitados que generen cargos automáticos, y el receptor no está obligado a devolverlos ni a conservarlos. Estas disposiciones buscan proteger al consumidor frente a técnicas comerciales agresivas o coercitivas que limiten su libertad de decisión.</p>
            </div>

            <div class="section" id="venta-credito">
                <h2>Operaciones de Venta a Crédito</h2>
                <p>Las operaciones de crédito al consumo están sujetas a estrictos requisitos de transparencia. Debe consignarse claramente el precio al contado, el monto financiado, la tasa de interés efectiva anual, el costo financiero total, el sistema de amortización, el número y monto de cuotas, y todos los gastos, seguros o adicionales. La omisión de cualquiera de estos datos puede llevar a la nulidad del contrato o de sus cláusulas. Si no se indica la tasa de interés, se aplica la tasa pasiva promedio del mercado publicada por el Banco Central. Además, la eficacia del contrato queda condicionada a la obtención efectiva del crédito; si este no se aprueba, la operación se resuelve sin costo para el consumidor, y se le devuelven todas las sumas pagadas. El juez competente será el del domicilio del consumidor, prevaleciendo su elección sobre cualquier pacto en contrario.</p>
            </div>

            <div class="section" id="terminos-abusivos">
                <h2>Términos Abusivos y Cláusulas Ineficaces</h2>
                <p>La ley declara nulas de pleno derecho ciertas cláusulas que perjudican al consumidor. Son ineficaces aquellas que limitan la responsabilidad del proveedor, restringen derechos del consumidor, amplían los derechos del proveedor o invierten la carga de la prueba en perjuicio del usuario. La interpretación del contrato siempre favorecerá al consumidor, y cualquier ambigüedad se resolverá en su beneficio. Las empresas que utilicen contratos de adhesión deben publicar el modelo de contrato en su sitio web y entregarlo gratuitamente antes de la firma. Además, deben exhibir un cartel visible indicando que el modelo está disponible. Esto garantiza que el consumidor pueda conocer los términos antes de comprometerse, evitando sorpresas contractuales.</p>
            </div>

            <div class="section" id="responsabilidad-danos">
                <h2>Responsabilidad por Daños</h2>
                <p>La responsabilidad por daños derivados de productos defectuosos o servicios deficientes es solidaria entre productores, importadores, distribuidores, vendedores y prestadores de servicios. El transportista también responde si el daño ocurre durante el traslado. Solo se libera quien demuestre que el daño no fue causado por su intervención. El daño directo, entendido como el menoscabo patrimonial inmediato al consumidor, puede ser reparado mediante indemnizaciones fijadas por organismos especializados, siempre que cumplan con criterios de independencia, técnica y control judicial. No obstante, esta figura no cubre daños no patrimoniales, como afectaciones a la salud psicofísica o derechos personalísimos, los cuales quedan bajo el régimen general de responsabilidad civil.</p>
            </div>

            <div class="section" id="procedimiento-sanciones">
                <h2>Procedimiento Administrativo y Sanciones</h2>
                <p>La autoridad nacional de aplicación es la Secretaría de Comercio Interior, mientras que provincias y la Ciudad Autónoma de Buenos Aires actúan como autoridades locales. Las actuaciones administrativas pueden iniciarse de oficio o por denuncia. El presunto infractor tiene cinco días hábiles para presentar descargo. Concluidas las diligencias, se dicta resolución dentro de los veinte días hábiles. Las sanciones incluyen apercibimiento, multas (de 0,5 a 2.100 canastas básicas del INDEC), decomiso de mercaderías, clausura hasta 30 días, suspensión en registros estatales hasta cinco años, y pérdida de concesiones. La publicación de la sanción a costa del infractor es obligatoria en casos graves. Las denuncias maliciosas también son sancionables. Las sanciones prescriben a los tres años, interrumpiéndose con nuevas infracciones o el inicio del procedimiento.</p>
            </div>

            <div class="section" id="asociaciones-consumidores">
                <h2>Asociaciones de Consumidores: Características y Ejemplos</h2>
                <p>Las asociaciones de consumidores están legitimadas para actuar en defensa de intereses individuales, colectivos o difusos. Para funcionar, deben solicitar autorización a la autoridad de aplicación y cumplir requisitos estrictos: no participar en política partidaria, ser independientes de actividades comerciales, no recibir aportes de empresas y no incluir publicidad en sus publicaciones. Sus fines incluyen velar por el cumplimiento de la ley, proponer normas, recibir reclamaciones, representar a consumidores ante tribunales y organismos, y promover la educación del consumidor. Un ejemplo destacado es la Asociación de Usuarios y Consumidores (AdeuC), reconocida por su labor en reclamos masivos y litigios estratégicos. Otra organización relevante es Consumidores Libres, que realiza estudios de mercado, control de calidad y campañas de concientización. Estas entidades juegan un rol clave en la vigilancia ciudadana y la defensa efectiva de los derechos del consumidor.</p>
            </div>
        </div>
    </div>

    <!-- Botón del chatbot a la izquierda -->
    <button id="chat-toggle-btn" class="floating-chat-btn">💬</button>

    <!-- Modal del chatbot -->
    <div id="chat-overlay" class="chat-overlay"></div>
    <div id="chat-modal" class="chat-modal">
        <div class="chat-header">Asistente Virtual</div>
        <div class="chat-messages" id="chat-messages">
            <div class="message bot-message">¡Hola! Soy tu asistente virtual. Puedes preguntarme sobre temas de defensa al consumidor.</div>
        </div>
        <div class="chat-input">
            <input type="text" id="user-input" placeholder="Escribe tu pregunta..." autocomplete="off">
            <button id="send-btn">➤</button>
        </div>
    </div>

    <!-- Modal para Contactos y Consejos -->
    <div id="contactos-modal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Contactos y Consejos</h2>
                <button class="close-btn" id="close-contactos">&times;</button>
            </div>
            <div class="modal-body">
                <h3>Recursos de Ayuda</h3>
                <ul class="contact-list">
                    <li><strong>Defensa del Consumidor Nacional:</strong> 0800-666-1518</li>
                    <li><strong>Atención al Ciudadano:</strong> 0800-222-4837</li>
                    <li><strong>Emergencias:</strong> 911</li>
                    <li><strong>Asesoramiento Legal Gratuito:</strong> Consultar en colegios de abogados locales</li>
                </ul>
                <h3>Consejos Útiles</h3>
                <p>• Guarde siempre los comprobantes de compra</p>
                <p>• Lea detenidamente los contratos antes de firmar</p>
                <p>• Conozca los plazos de garantía legal</p>
                <p>• Ejercite su derecho de arrepentimiento cuando corresponda</p>
            </div>
        </div>
    </div>

    <!-- Archivo JavaScript para animaciones avanzadas -->
    <script src="{{ asset('js/animations.js') }}"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        // ========== VARIABLES ==========
        const summarySection = document.getElementById('summary-section');
        const summaryToggleBtn = document.getElementById('summary-toggle-btn');
        const floatingToggle = document.getElementById('floating-toggle');
        const backToTopBtn = document.getElementById('back-to-top-btn');
        const contentSection = document.getElementById('content');
        const summaryLinks = document.querySelectorAll('.summary-list a');
        const chatMessages = document.getElementById('chat-messages');
        const userInput = document.getElementById('user-input');
        const sendBtn = document.getElementById('send-btn');
        const chatToggleBtn = document.getElementById('chat-toggle-btn');
        const chatOverlay = document.getElementById('chat-overlay');
        const chatModal = document.getElementById('chat-modal');
        const contactosBtn = document.getElementById('contactos-btn');
        const contactosModal = document.getElementById('contactos-modal');
        const closeContactos = document.getElementById('close-contactos');

        // ========== FUNCIONES PARA MODALES ==========
        function openModal(modal) {
            modal.style.display = 'flex';
        }

        function closeModal(modal) {
            modal.style.display = 'none';
        }

        // ========== FUNCIONES DEL SUMARIO ==========
        let isSummaryVisible = true;

        function toggleSummary() {
            isSummaryVisible = !isSummaryVisible;
            
            if (isSummaryVisible) {
                summarySection.classList.remove('collapsed');
                contentSection.classList.remove('full-width');
                summaryToggleBtn.innerHTML = '<span>▶</span> Ocultar';
                floatingToggle.style.display = 'none';
            } else {
                summarySection.classList.add('collapsed');
                contentSection.classList.add('full-width');
                summaryToggleBtn.innerHTML = '<span>◀</span> Mostrar';
                floatingToggle.style.display = 'flex';
            }
        }

        function scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        function scrollToSection(event) {
            event.preventDefault();
            const targetId = event.target.getAttribute('href').substring(1);
            const targetElement = document.getElementById(targetId);
            if (targetElement) {
                targetElement.scrollIntoView({ behavior: 'smooth' });
            }
        }

        function updateActiveSummaryLink() {
            const sections = document.querySelectorAll('.section');
            let currentActiveIndex = -1;
            
            sections.forEach((section, index) => {
                const rect = section.getBoundingClientRect();
                if (rect.top <= 150 && rect.bottom >= 150) {
                    currentActiveIndex = index;
                }
            });
            
            summaryLinks.forEach((link, index) => {
                if (index === currentActiveIndex) {
                    link.classList.add('active');
                } else {
                    link.classList.remove('active');
                }
            });
        }

        // ========== FUNCIONES DEL CHATBOT ==========
        function addMessage(text, isUser = false) {
            const messageDiv = document.createElement('div');
            messageDiv.classList.add('message');
            messageDiv.classList.add(isUser ? 'user-message' : 'bot-message');
            messageDiv.innerHTML = isUser ? text : '';
            chatMessages.appendChild(messageDiv);
            chatMessages.scrollTop = chatMessages.scrollHeight;
            return messageDiv;
        }

        function typeMessage(element, text, callback = null) {
            let i = 0;
            const speed = 20;

            function type() {
                if (i < text.length) {
                    if (text.substr(i, 4) === '<br>') {
                        element.innerHTML += '<br>';
                        i += 4;
                    } else if (text.substr(i, 3) === '&lt') {
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

            addMessage(message, true);
            userInput.value = '';
            userInput.disabled = true;
            sendBtn.disabled = true;

            const typingIndicator = showTypingIndicator();

            setTimeout(() => {
                fetch("/chatbot", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                    },
                    body: JSON.stringify({ message: message })
                })
                .then(response => response.json())
                .then(data => {
                    hideTypingIndicator(typingIndicator);
                    const botMessageDiv = addMessage('', false);
                    typeMessage(botMessageDiv, data.reply || "Gracias por tu consulta sobre defensa al consumidor.");
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

        // ========== EVENT LISTENERS ==========
        summaryToggleBtn.addEventListener('click', toggleSummary);
        floatingToggle.addEventListener('click', toggleSummary);
        backToTopBtn.addEventListener('click', scrollToTop);

        summaryLinks.forEach(link => {
            link.addEventListener('click', scrollToSection);
        });

        window.addEventListener('scroll', updateActiveSummaryLink);
        
        contactosBtn.addEventListener('click', (e) => {
            e.preventDefault();
            openModal(contactosModal);
        });

        closeContactos.addEventListener('click', () => {
            closeModal(contactosModal);
        });

        window.addEventListener('click', (e) => {
            if (e.target === contactosModal) {
                closeModal(contactosModal);
            }
        });

        sendBtn.addEventListener('click', sendMessage);
        userInput.addEventListener('keypress', function (e) {
            if (e.key === 'Enter') sendMessage();
        });

        chatToggleBtn.addEventListener('click', () => {
            chatModal.style.display = 'block';
            chatOverlay.style.display = 'block';
            userInput.focus();
        });

        chatOverlay.addEventListener('click', () => {
            chatModal.style.display = 'none';
            chatOverlay.style.display = 'none';
        });

        // Inicializar
        updateActiveSummaryLink();
    });
</script>
</body>
</html>