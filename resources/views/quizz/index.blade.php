<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quizz de Seguridad Informática</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to bottom right, #f0f8ff, #ffcc99);
            color: #333;
            text-align: center;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        h1 {
            font-size: 2.5em;
            margin-bottom: 20px;
            color: #0094D8;
        }
       

        .level-button {
            background: linear-gradient(to right, #ff7e5f, #feb47b);
            border: none;
            color: white;
            padding: 15px 30px;
            font-size: 1.2em;
            cursor: pointer;
            border-radius: 5px;
            transition: transform 0.2s;
            margin: 10px;
        }

        .level-button:hover {
            transform: scale(1.1);
        }

        #question-container {
            display: none;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            width: 80%;
            max-width: 600px;
        }

        #answer-buttons button {
            background: linear-gradient(to right, #56ab2f, #a8e063);
            border: none;
            color: white;
            padding: 10px 20px;
            font-size: 1em;
            cursor: pointer;
            border-radius: 5px;
            margin: 10px 0;
            transition: transform 0.2s;
            width: 100%;
        }

        #answer-buttons button:hover {
            transform: scale(1.05);
        }

        #result-container {
            display: none;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            width: 80%;
            max-width: 600px;
        }

        .face {
            display: none;
            font-size: 5em;
        }

        #timer {
            width: 100%;
            background-color: #ddd;
            border-radius: 5px;
            overflow: hidden;
            margin-top: 10px;
        }

        #timer-fill {
            height: 10px;
            background-color: #4caf50;
            width: 100%;
            transition: width 1s linear;
        }

        #timer-counter {
            margin-top: 5px;
            font-size: 1em;
        }

        .back-button {
            background: linear-gradient(to right, #2196F3, #21CBF3);
            border: none;
            color: white;
            padding: 15px 30px;
            font-size: 1.2em;
            cursor: pointer;
            border-radius: 5px;
            transition: transform 0.2s;
            margin-top: 20px;
        }

        .back-button:hover {
            transform: scale(1.1);
        }
    </style>
</head>
<body>
    <h1>Quizz de Redes</h1>
    
    <div id="level-selection">
        <h1>Selecciona un nivel de dificultad:</h2>
        <button class="level-button" onclick="startQuizz('Facil')">Fácil</button>
        <button class="level-button" onclick="startQuizz('Intermedio')">Intermedio</button>
        <button class="level-button" onclick="startQuizz('Dificil')">Difícil</button>
    </div>

    <div id="question-container">
        <h2 id="question-number"></h2>
        <h3 id="question-title"></h3>
        <div id="answer-buttons"></div>
        <div id="timer">
            <div id="timer-fill"></div>
        </div>
        <p id="timer-counter"></p>
    </div>

    <div id="result-container">
        <h2>Resultados</h2>
        <p id="result-message"></p>
        <div id="justifications"></div>
        <button class="level-button" onclick="goBack()">Volver a intentar</button>
    </div>

    <script>
        const questions = {
            'Facil': [
                { question: "¿Qué es un router?", answers: ["Dispositivo que conecta redes", "Un tipo de software", "Un protocolo de comunicación", "Un virus informático"], correct: 0 },
                { question: "¿Qué significa LAN?", answers: ["Red de Área Local", "Red de Área Amplia", "Protocolo de comunicación", "Un dispositivo de red"], correct: 0 },
                { question: "¿Qué es HTTP?", answers: ["Protocolo de transferencia de hipertexto", "Un tipo de software", "Un dispositivo de red", "Un virus informático"], correct: 0 },
                { question: "¿Qué es un firewall?", answers: ["Protege la red de intrusos", "Un tipo de virus", "Un dispositivo de red", "Un protocolo de seguridad"], correct: 0 },
                { question: "¿Qué es un switch?", answers: ["Dispositivo que conecta varios dispositivos en una red", "Un tipo de malware", "Un software de edición", "Un protocolo de red"], correct: 0 },
                { question: "¿Qué es un módem?", answers: ["Dispositivo que modula y demodula señales", "Un tipo de virus", "Un software de edición", "Un dispositivo de red"], correct: 0 },
                { question: "¿Qué significa WAN?", answers: ["Red de Área Amplia", "Red de Área Local", "Un dispositivo de red", "Un protocolo de comunicación"], correct: 0 },
                { question: "¿Qué es un dominio?", answers: ["Nombre que identifica un sitio web", "Un tipo de virus", "Un software de edición", "Un protocolo de comunicación"], correct: 0 },
                { question: "¿Qué es una dirección IP estática?", answers: ["No cambia y es asignada manualmente", "Cambia frecuentemente", "Asigna direcciones IP automáticamente", "Un tipo de malware"], correct: 0 },
                { question: "¿Qué es DHCP?", answers: ["Protocolo que asigna direcciones IP automáticamente", "Un tipo de firewall", "Un dispositivo de red", "Un protocolo de seguridad"], correct: 0 },
            ],
            'Intermedio': [
                { question: "¿Qué significa NAT?", answers: ["Traducción de Dirección de Red", "Un tipo de malware", "Un software de edición", "Un dispositivo de red"], correct: 0 },
                { question: "¿Qué es un VPN?", answers: ["Red Privada Virtual", "Un tipo de virus", "Un protocolo de red", "Un dispositivo de red"], correct: 0 },
                { question: "¿Qué significa TCP?", answers: ["Protocolo de Control de Transmisión", "Un tipo de software", "Un dispositivo de red", "Un virus informático"], correct: 0 },
                { question: "¿Qué es un punto de acceso?", answers: ["Permite la conexión de dispositivos inalámbricos a una red", "Un tipo de malware", "Un dispositivo de red", "Un protocolo de comunicación"], correct: 0 },
                { question: "¿Qué significa DDoS?", answers: ["Ataque de Denegación de Servicio Distribuido", "Un tipo de virus", "Un protocolo de red", "Un software de edición"], correct: 0 },
                { question: "¿Qué hace un servidor DNS?", answers: ["Traduce nombres de dominio a direcciones IP", "Un tipo de firewall", "Un dispositivo de red", "Un protocolo de seguridad"], correct: 0 },
                { question: "¿Qué es un ataque de phishing?", answers: ["Intento de obtener información confidencial", "Un tipo de malware", "Un software de edición", "Un dispositivo de red"], correct: 0 },
                { question: "¿Qué es la segmentación de red?", answers: ["Dividir una red en subredes más pequeñas", "Un tipo de virus", "Un dispositivo de red", "Un protocolo de comunicación"], correct: 0 },
                { question: "¿Qué es un proxy?", answers: ["Actúa como intermediario entre un cliente y un servidor", "Un tipo de malware", "Un dispositivo de red", "Un software de edición"], correct: 0 },
                { question: "¿Qué es el análisis de tráfico de red?", answers: ["Estudia el flujo de datos para identificar problemas", "Un tipo de virus", "Un software de edición", "Un dispositivo de red"], correct: 0 },
            ],
            'Dificil': [
                { question: "¿Qué es un IDS?", answers: ["Sistema de Detección de Intrusos", "Un tipo de firewall", "Un dispositivo de red", "Un software de edición"], correct: 0 },
                { question: "¿Qué significa SSL?", answers: ["Capa de Conexión Segura", "Protocolo de Seguridad de Red", "Sistema de Seguridad de Servidor", "Un tipo de malware"], correct: 0 },
                { question: "¿Qué es un VLAN?", answers: ["Red de Área Local Virtual", "Un tipo de firewall", "Un dispositivo de red", "Un protocolo de comunicación"], correct: 0 },
                { question: "¿Qué es un ataque MITM?", answers: ["Hombre en el Medio", "Un tipo de malware", "Un protocolo de red", "Un servidor"], correct: 0 },
                { question: "¿Qué es la encriptación?", answers: ["Proceso de convertir datos en un formato seguro", "Un tipo de ataque", "Un dispositivo de red", "Un software de seguridad"], correct: 0 },
                { question: "¿Qué es una vulnerabilidad de seguridad?", answers: ["Una debilidad en un sistema que puede ser explotada", "Un tipo de malware", "Un protocolo de red", "Un servidor"], correct: 0 },
                { question: "¿Qué es un ataque de fuerza bruta?", answers: ["Método para adivinar contraseñas probando combinaciones", "Un tipo de malware", "Un ataque de red", "Un protocolo de seguridad"], correct: 0 },
                { question: "¿Qué es la autenticación de dos factores?", answers: ["Método que requiere dos formas de verificación", "Un tipo de malware", "Un dispositivo de red", "Un protocolo de seguridad"], correct: 0 },
                { question: "¿Qué es el cifrado simétrico?", answers: ["Uso de la misma clave para cifrar y descifrar datos", "Un tipo de malware", "Un dispositivo de red", "Un protocolo de seguridad"], correct: 0 },
                { question: "¿Qué es un escáner de vulnerabilidades?", answers: ["Herramienta que busca debilidades en un sistema", "Un tipo de ataque", "Un protocolo de comunicación", "Un software de edición"], correct: 0 },
            ]
        };

        let currentQuestions = [];
        let currentQuestionIndex = 0;
        let score = 0;
        let timer;
        const timeLimit = 20; // tiempo límite en segundos
        let timeLeft = timeLimit;

        function startQuizz(level) {
            document.getElementById('level-selection').style.display = 'none';
            currentQuestions = questions[level];
            currentQuestionIndex = 0;
            score = 0;
            showQuestion();
            document.getElementById('question-container').style.display = 'block';
            document.getElementById('justifications').innerHTML = '';
        }

        function showQuestion() {
            resetTimer();
            const currentQuestion = currentQuestions[currentQuestionIndex];
            document.getElementById('question-number').innerText = `Pregunta ${currentQuestionIndex + 1}`;
            document.getElementById('question-title').innerText = currentQuestion.question;
            const answerButtons = document.getElementById('answer-buttons');
            answerButtons.innerHTML = '';
            currentQuestion.answers.forEach((answer, index) => {
                const button = document.createElement('button');
                button.innerText = answer;
                button.className = 'btn';
                button.onclick = () => selectAnswer(index);
                answerButtons.appendChild(button);
            });
            updateTimer();
        }

        function resetTimer() {
            timeLeft = timeLimit;
            clearInterval(timer);
            timer = setInterval(() => {
                timeLeft--;
                updateTimer();
                if (timeLeft <= 0) {
                    clearInterval(timer);
                    selectAnswer(-1); // Respuesta incorrecta por tiempo agotado
                }
            }, 1000);
        }

        function updateTimer() {
            document.getElementById('timer-counter').innerText = `Tiempo restante: ${timeLeft} segundos`;
            const fill = document.getElementById('timer-fill');
            fill.style.width = `${(timeLeft / timeLimit) * 100}%`;
        }

        function selectAnswer(selectedIndex) {
            clearInterval(timer);
            const currentQuestion = currentQuestions[currentQuestionIndex];
            const isCorrect = selectedIndex === currentQuestion.correct;
            if (isCorrect) {
                score++;
            } else {
                // Retroalimentación
                const justification = document.createElement('p');
                justification.innerText = `Pregunta ${currentQuestionIndex + 1}: ${currentQuestion.answers[currentQuestion.correct]} es la respuesta correcta.`;
                document.getElementById('justifications').appendChild(justification);
            }
            currentQuestionIndex++;
            if (currentQuestionIndex < currentQuestions.length) {
                showQuestion();
            } else {
                showResults();
            }
        }

        function showResults() {
            document.getElementById('question-container').style.display = 'none';
            document.getElementById('result-container').style.display = 'block';
            document.getElementById('result-message').innerText = `Obtuviste ${score} de ${currentQuestions.length} respuestas correctas.`;
            if (score === currentQuestions.length) {
                document.getElementById('happy-face').style.display = 'block';
            } else {
                document.getElementById('sad-face').style.display = 'block';
            }
        }

        function goBack() {
            document.getElementById('result-container').style.display = 'none';
            document.getElementById('level-selection').style.display = 'block';
            document.getElementById('happy-face').style.display = 'none';
            document.getElementById('sad-face').style.display = 'none';
        }

        // Iniciar el quizz al cargar la página
        document.getElementById('level-selection').style.display = 'block';
    </script>
</body>
</html>
