<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Defensa al Consumidor</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
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
            background: linear-gradient(135deg, #3f35bb 0%, #2e268a 100%);
            color: white;
            padding: 40px 20px;
            text-align: center;
            width: 100%;
        }

        .hero h1 {
            font-family: 'IBM Plex Sans', sans-serif;
            font-weight: 600;
            font-size: 2rem;
            margin-bottom: 12px;
            letter-spacing: -0.5px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.15);
        }

        .hero p {
            max-width: 750px;
            margin: 0 auto;
            font-size: 1.05rem;
            opacity: 0.95;
            line-height: 1.75;
        }

        .quick-access {
            display: flex;
            justify-content: center;
            gap: 20px;
            padding: 20px 20px 30px;
            background: #f0f0f0;
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
            transition: all 0.25s ease;
            min-width: 220px;
            border: 2px solid transparent;
        }

        .action-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 22px rgba(63, 53, 187, 0.18);
            border-color: #3f35bb;
        }

        .action-card.admin {
            background: #fff0f0;
            border-color: #ff6b6b;
        }

        .action-card.admin:hover {
            border-color: #e05a5a;
            box-shadow: 0 8px 22px rgba(255, 107, 107, 0.15);
        }

        .action-card span {
            display: block;
            margin-top: 8px;
            font-weight: 400;
            font-size: 0.9rem;
            color: #555;
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
            margin-right: 320px; /* Espacio para el sumario fijo a la derecha */
            transition: margin-right 0.3s ease;
        }

        .content-section.full-width {
            margin-right: 0;
        }

        .summary-wrapper {
            position: fixed;
            top: 200px; /* Debajo del hero y quick-access */
            right: 20px; /* Cambiado a la derecha */
            width: 300px;
            height: calc(100vh - 220px);
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
        }

        .summary-list a {
            color: #222;
            text-decoration: none;
            display: block;
            padding: 8px 12px;
            border-radius: 8px;
            transition: all 0.2s;
        }

        .summary-list a:hover,
        .summary-list a.active {
            background: #3f35bb;
            color: white;
        }

        .summary-controls {
            display: flex;
            gap: 10px;
            margin-top: 15px;
        }

        .summary-toggle-btn,
        .back-to-top-btn {
            flex: 1;
            background: #3f35bb;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 10px;
            cursor: pointer;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
        }

        .summary-toggle-btn:hover,
        .back-to-top-btn:hover {
            background: #2a207a;
        }

        .floating-toggle {
            position: fixed;
            top: 200px;
            right: 20px; /* Cambiado a la derecha */
            width: 40px;
            height: 40px;
            background: #3f35bb;
            color: white;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            z-index: 101;
            display: none;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        .section {
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }

        .section:last-child {
            border-bottom: none;
        }

        .section h2 {
            font-family: 'IBM Plex Sans', sans-serif;
            font-weight: 600;
            font-size: 1.6rem;
            color: #3f35bb;
            margin-bottom: 15px;
        }

        .section h3 {
            font-family: 'IBM Plex Sans', sans-serif;
            font-weight: 500;
            font-size: 1.3rem;
            color: #2e268a;
            margin-top: 20px;
            margin-bottom: 10px;
        }

        .section p {
            font-size: 1.05rem;
            line-height: 1.75;
            margin-bottom: 15px;
            text-align: justify;
        }

        /* Chatbot a la izquierda */
        .floating-chat-btn {
            position: fixed;
            bottom: 30px;
            left: 30px; /* Cambiado a la izquierda */
            width: 60px;
            height: 60px;
            background: #3f35bb;
            color: white;
            border: none;
            border-radius: 50%;
            font-size: 24px;
            cursor: pointer;
            box-shadow: 0 6px 16px rgba(63, 53, 187, 0.3);
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.2s;
        }

        .floating-chat-btn:hover {
            background: #2a207a;
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
        }

        .chat-modal {
            position: fixed;
            bottom: 100px;
            left: 30px; /* Cambiado a la izquierda */
            width: 380px;
            background: white;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0,0,0,0.15);
            z-index: 2001;
            display: none;
        }

        .chat-header {
            background: #3f35bb;
            color: white;
            padding: 18px;
            text-align: center;
            font-weight: 600;
            font-size: 1.25rem;
            letter-spacing: 0.3px;
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
            padding: 13px 18px;
            margin-bottom: 18px;
            border-radius: 22px;
            line-height: 1.55;
            word-wrap: break-word;
            font-size: 1rem;
            position: relative;
        }

        .bot-message {
            background: #eef2ff;
            color: #222;
            align-self: flex-start;
            border-bottom-left-radius: 6px;
        }

        .user-message {
            background: #3f35bb;
            color: white;
            align-self: flex-end;
            border-bottom-right-radius: 6px;
        }

        .chat-input {
            display: flex;
            padding: 18px;
            background: white;
            border-top: 1px solid #f0f3ff;
        }

        .chat-input input {
            flex: 1;
            padding: 14px 22px;
            border: 1px solid #d4d9f7;
            border-radius: 32px;
            outline: none;
            font-size: 16px;
            font-family: 'Inter', sans-serif;
            background: #fbfcff;
        }

        .chat-input input:focus {
            border-color: #3f35bb;
            box-shadow: 0 0 0 3px rgba(63, 53, 187, 0.18);
        }

        .chat-input button {
            width: 50px;
            height: 50px;
            background: #3f35bb;
            color: white;
            border: none;
            border-radius: 50%;
            margin-left: 14px;
            font-size: 20px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.2s;
        }

        .chat-input button:hover {
            background: #2a207a;
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
            
            /* Ajustes del chatbot en móviles */
            .chat-modal {
                left: 20px;
                right: 20px;
                width: auto;
            }
        }

        @media (max-width: 680px) {
            .hero h1 { font-size: 1.8rem; }
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
        <a href="#" class="action-card">
            Contactos y consejos
            <span>Guías y recursos útiles</span>
        </a>
        <a href="#" class="action-card admin">
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
                <p>El documento de venta es un instrumento esencial para garantizar la transparencia contractual. Debe contener, en idioma castellano, de forma clara y legible: descripción del bien, datos del vendedor, fabricante, distribuidor o importador, características de la garantía, plazos y condiciones de entrega, precio total a pagar e inclusiones de costos adicionales. Las cláusulas adicionales deben redactarse en letra destacada y ser firmadas por ambas partes. El consumidor debe recibir un ejemplar original del contrato. Esta obligación se mantiene independientemente de otras normativas sectoriales, asegurando que el usuario disponga de toda la información necesaria para ejercer sus derechos. La reglamentación puede simplificar el formato según la naturaleza del bien, siempre que se preserve su finalidad informativa.</p>
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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const summarySection = document.getElementById('summary-section');
            const summaryToggleBtn = document.getElementById('summary-toggle-btn');
            const floatingToggle = document.getElementById('floating-toggle');
            const backToTopBtn = document.getElementById('back-to-top-btn');
            const contentSection = document.getElementById('content');
            const summaryLinks = document.querySelectorAll('.summary-list a');
            
            // Elementos del chatbot
            const chatMessages = document.getElementById('chat-messages');
            const userInput = document.getElementById('user-input');
            const sendBtn = document.getElementById('send-btn');
            const chatToggleBtn = document.getElementById('chat-toggle-btn');
            const chatOverlay = document.getElementById('chat-overlay');
            const chatModal = document.getElementById('chat-modal');

            // Estado del sumario
            let isSummaryVisible = true;

            // Función para toggle del sumario
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

            // Función para volver al inicio
            function scrollToTop() {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            }

            // Función para desplazarse a una sección
            function scrollToSection(event) {
                event.preventDefault();
                const targetId = event.target.getAttribute('href').substring(1);
                const targetElement = document.getElementById(targetId);
                if (targetElement) {
                    targetElement.scrollIntoView({ behavior: 'smooth' });
                }
            }

            // Función para actualizar el enlace activo
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

            // Funciones del chatbot
            function addMessage(text, isUser = false) {
                const messageDiv = document.createElement('div');
                messageDiv.classList.add('message');
                messageDiv.classList.add(isUser ? 'user-message' : 'bot-message');
                messageDiv.textContent = text;
                chatMessages.appendChild(messageDiv);
                chatMessages.scrollTop = chatMessages.scrollHeight;
            }

            function sendMessage() {
                const message = userInput.value.trim();
                if (!message) return;

                addMessage(message, true);
                userInput.value = '';

                // Simular respuesta del bot
                setTimeout(() => {
                    addMessage("Gracias por tu consulta. Para asistencia personalizada, contacta con las autoridades de defensa al consumidor de tu localidad.");
                }, 1000);
            }

            // Event listeners del sumario
            summaryToggleBtn.addEventListener('click', toggleSummary);
            floatingToggle.addEventListener('click', toggleSummary);
            backToTopBtn.addEventListener('click', scrollToTop);

            summaryLinks.forEach(link => {
                link.addEventListener('click', scrollToSection);
            });

            window.addEventListener('scroll', updateActiveSummaryLink);
            
            // Event listeners del chatbot
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