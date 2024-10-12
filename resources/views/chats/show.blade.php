<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatbot Educativo</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #e0f7fa; /* Fondo suave */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #333;
        }
        .container {
            width: 90%;
            max-width: 800px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }
        h1 {
            background: linear-gradient(135deg, #4a90e2, #00bcd4); /* Degradado colorido */
            color: white;
            padding: 20px;
            text-align: center;
            margin: 0;
            font-weight: 600;
            font-size: 2rem;
        }
        #chatLog {
            height: 400px;
            padding: 15px;
            overflow-y: auto;
            border-top: 1px solid #ddd;
            border-bottom: 1px solid #ddd;
            background-color: #fafafa;
            border-radius: 0 0 15px 15px; /* Esquinas redondeadas */
            font-size: 1.1rem;
        }
        #userMessage {
            width: calc(100% - 140px);
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin: 10px;
            font-size: 1rem;
            display: inline-block; /* Para que se ajuste con el botón */
        }
        button {
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            background-color: #4a90e2;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
            margin: 10px;
            font-size: 1rem;
            display: inline-block; /* Para alinear con el input */
        }
        button:hover {
            background-color: #00bcd4; /* Color en hover */
            transform: translateY(-3px); /* Efecto de elevación */
        }
        .message {
            margin: 10px 0;
            padding: 10px;
            border-radius: 5px;
            position: relative;
            max-width: 80%; /* Limitar el ancho del mensaje */
            clear: both; /* Asegurar que cada mensaje esté en una nueva línea */
        }
        .message.user {
            text-align: right;
            color: white;
            background-color: #4a90e2; /* Color de fondo del usuario */
            border-radius: 10px 10px 0 10px;
            margin-left: auto; /* Alinear a la derecha */
        }
        .message.chatbot {
            text-align: left;
            color: #333;
            background-color: #f0f4f8; /* Color de fondo del chatbot */
            border-radius: 10px 10px 10px 0; /* Esquinas redondeadas */
            margin-right: auto; /* Alinear a la izquierda */
        }
        #suggestions {
            margin: 15px 0;
            font-style: italic;
            color: #666;
            display: flex;
            flex-direction: column;
            align-items: center; /* Centrar sugerencias */
        }
        #suggestions button {
            background-color: #81d4fa; /* Color de fondo para sugerencias */
            margin: 5px 0; /* Espaciado entre botones */
            width: 80%; /* Hacer los botones más anchos */
            text-align: left; /* Alinear texto a la izquierda */
            border-radius: 5px; /* Esquinas redondeadas */
        }
        #suggestions button:hover {
            background-color: #4fc3f7; /* Color en hover */
        }
    </style>
    <script>
        // Cargar el dataset en JavaScript
        const dataSet = @json($dataSet); // Asegúrate de tener tu dataset con preguntas y respuestas

        // Inicializar el chat
        function initializeChat() {
            const chatLog = document.getElementById('chatLog');
            chatLog.innerHTML += `<div class="message chatbot"><strong>Chatbot:</strong> ¡Hola! ¿En qué puedo ayudarte hoy?</div>`;
            updateSuggestions(); // Inicializar preguntas sugeridas
            chatLog.scrollTop = chatLog.scrollHeight; // Desplazar hacia abajo
        }

        // Obtener preguntas sugeridas de forma completamente aleatoria
        function getRandomQuestions() {
            const shuffledQuestions = dataSet
                .map(item => item.question)
                .sort(() => 0.5 - Math.random()); // Mezclar preguntas aleatoriamente
            return shuffledQuestions.slice(0, 3); // Devolver las primeras 3 preguntas
        }

        // Actualizar preguntas sugeridas
        function updateSuggestions() {
            const suggestionsContainer = document.getElementById('suggestions');
            suggestionsContainer.innerHTML = '<strong>Preguntas Sugeridas:</strong>';
            const randomQuestions = getRandomQuestions();

            randomQuestions.forEach(question => {
                suggestionsContainer.innerHTML += `<button onclick="selectSuggestion('${question}')">${question}</button>`;
            });

            // Si no hay preguntas, mostrar un mensaje de "sin sugerencias"
            if (suggestionsContainer.innerHTML === '<strong>Preguntas Sugeridas:</strong>') {
                suggestionsContainer.innerHTML += ' No hay preguntas disponibles.';
            }
        }

        // Obtener respuesta del chatbot
        function getChatbotResponse(userMessage) {
            const lowerCaseMessage = userMessage.toLowerCase().trim(); // Normaliza el mensaje del usuario

            // Respuestas a saludos
            const greetings = ["hola", "buenos días", "buenas tardes", "buenas noches", "qué tal", "cómo estás"];
            const farewells = ["adiós", "hasta luego", "nos vemos", "chau"];
            const insults = ["tonto", "estúpido", "idiota", "imbécil", "pendejo", "maldito"];

            // Responder a saludos
            if (greetings.some(greeting => lowerCaseMessage.includes(greeting))) {
                return "¡Hola! ¿Cómo puedo ayudarte hoy?";
            }

            // Responder a despedidas
            if (farewells.some(farewell => lowerCaseMessage.includes(farewell))) {
                return "¡Hasta luego! Si necesitas ayuda, aquí estaré.";
            }

            // Responder a insultos
            if (insults.some(insult => lowerCaseMessage.includes(insult))) {
                return "No es necesario usar palabras hirientes. Estoy aquí para ayudar.";
            }

            let bestMatch = '';
            let highestSimilarity = 0;

            // Buscar la mejor coincidencia en el dataset
            for (const item of dataSet) {
                const currentQuestion = item.question.toLowerCase().trim(); // Normaliza la pregunta
                const similarity = calculateSimilarity(lowerCaseMessage, currentQuestion);
                if (similarity > highestSimilarity) {
                    highestSimilarity = similarity;
                    bestMatch = item.answer; // Cambiar a item.answer para obtener la respuesta
                }
            }

            // Cambiar el umbral para la respuesta
            if (highestSimilarity > 0.3) { // Ajustar el umbral a 0.3
                return bestMatch;
            } else {
                // Si no hay coincidencias, dar una respuesta alternativa
                return 'Lo siento, no tengo una respuesta para eso. ¿Puedes reformular la pregunta?';
            }
        }

        // Seleccionar una pregunta sugerida
        function selectSuggestion(question) {
            document.getElementById('userMessage').value = question; // Establecer el valor del input
            sendMessage(); // Enviar el mensaje automáticamente
        }

        // Función para corregir el texto
        // Función para corregir el texto ingresado por el usuario
        function correctText(userMessage) {
            // Asegurarse de que la pregunta termina con un signo de interrogación
            if (!userMessage.endsWith('?')) {
                userMessage += '?'; // Añadir signo de interrogación al final
            }

            // Asegurarse de que la pregunta comience con un signo de interrogación si es necesario
            if (!userMessage.startsWith('¿')) {
                userMessage = '¿' + userMessage; // Añadir signo de interrogación al inicio
            }

            // Aplicar tildes solo a palabras específicas (ejemplo para "cómo" y "estás")
            userMessage = userMessage.replace(/como/gi, 'cómo');
            userMessage = userMessage.replace(/estas/gi, 'estás');
            userMessage = userMessage.replace(/mas/gi, 'más');
            userMessage = userMessage.replace(/donde/gi, 'dónde');
            userMessage = userMessage.replace(/que/gi, 'qué');
            userMessage = userMessage.replace(/quien/gi, 'quién');
            userMessage = userMessage.replace(/cuanto/gi, 'cuánto');
            userMessage = userMessage.replace(/cuando/gi, 'cuándo');
            userMessage = userMessage.replace(/cual/gi, 'cuál');
            userMessage = userMessage.replace(/porque/gi, 'por qué');
            return userMessage.trim(); // Limpiar espacios
        }


        // Enviar el mensaje
        function sendMessage() {
            const userMessageInput = document.getElementById('userMessage');
            const userMessage = userMessageInput.value;

            if (userMessage.trim() === '') {
                return; // No enviar si está vacío
            }

            // Corregir el mensaje del usuario
            const correctedMessage = correctText(userMessage);
            userMessageInput.value = ''; // Limpiar el input

            const chatLog = document.getElementById('chatLog');
            chatLog.innerHTML += `<div class="message user"><strong>Tú:</strong> ${correctedMessage}</div>`;
            chatLog.scrollTop = chatLog.scrollHeight; // Desplazar hacia abajo

            // Obtener la respuesta del chatbot
            const response = getChatbotResponse(correctedMessage);
            chatLog.innerHTML += `<div class="message chatbot"><strong>Chatbot:</strong> ${response}</div>`;
            chatLog.scrollTop = chatLog.scrollHeight; // Desplazar hacia abajo

            updateSuggestions(); // Actualizar sugerencias después de cada mensaje
        }

        // Calcular similitud entre dos cadenas (puedes usar otro método si lo prefieres)
        function calculateSimilarity(str1, str2) {
            let matches = 0;
            const words1 = str1.split(' ');
            const words2 = str2.split(' ');

            words1.forEach(word1 => {
                if (words2.includes(word1)) {
                    matches++;
                }
            });

            return matches / Math.max(words1.length, words2.length); // Normalizar por longitud
        }

        // Inicializar el chat al cargar la página
        window.onload = initializeChat;
    </script>
</head>
<body>
    <div class="container">
        <h1>Chatbot Educativo</h1>
        <div id="chatLog"></div>
        <div>
            <input type="text" id="userMessage" placeholder="Escribe tu pregunta aquí...">
            <button onclick="sendMessage()">Enviar</button>
        </div>
        <div id="suggestions"></div>
    </div>
</body>
</html>
