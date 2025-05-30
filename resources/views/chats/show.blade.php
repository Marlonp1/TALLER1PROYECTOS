<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quizz Divertido para Niños de Primaria</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: url('https://img.freepik.com/free-psd/3d-rendering-questions-background_23-2151455632.jpg?semt=ais_hybrid&w=740') no-repeat center center fixed;
            background-size: cover;
            color: #222;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            min-height: 100vh;
        }

        h1, h2, h3 {
            color: #222;
            text-align: center;
        }

        h1 {
            font-size: 3em;
            margin-top: 30px;
        }

        .info-sorda {
            background: rgba(255, 255, 255, 0.85);
            color: #222;
            padding: 15px;
            border-radius: 10px;
            width: 80%;
            max-width: 600px;
            margin: 15px auto;
            font-size: 1.1em;
            text-align: center;
        }

        .button-container {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .button-container button {
            background: #FFC107;
            color: #222;
            padding: 15px 30px;
            border: none;
            border-radius: 25px;
            font-weight: bold;
            cursor: pointer;
            font-size: 1.1em;
            transition: 0.3s;
        }

        .button-container button:hover {
            background: #FF9800;
            transform: scale(1.1);
        }

        #difficulty-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .answer-button {
            background: #AED581;
            color: #222;
            padding: 15px;
            border: none;
            border-radius: 25px;
            width: 100%;
            font-size: 1.2em;
            cursor: pointer;
            margin: 10px 0;
            transition: transform 0.2s, background 0.3s;
        }

        .answer-button:hover {
            background: #9CCC65;
            transform: scale(1.05);
        }

        .answer-button.correct { background: #81C784; }
        .answer-button.incorrect { background: #E57373; }

        #question-container, #result-container {
            display: none;
            background: rgba(255, 255, 255, 0.9);
            color: #222;
            padding: 20px;
            border-radius: 10px;
            width: 80%;
            max-width: 600px;
            margin-top: 20px;
        }

        #result-container {
            background: rgba(255, 255, 255, 0.9);
        }

        .result-button {
            background-color: #64B5F6;
            color: #222;
            font-size: 1.2em;
            padding: 15px 30px;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            transition: background 0.3s, transform 0.3s;
            margin: 10px;
        }

        .result-button:hover {
            background-color: #42A5F5;
            transform: scale(1.1);
        }

        .result-button:active {
            transform: scale(0.98);
        }
    </style>
</head>
<body>
    <h1>Quizz Divertido para Niños de Primaria</h1>

    <div class="info-sorda">
        <strong>¡Hola! Este juego de preguntas es para aprender y divertirse.</strong><br>
        Las preguntas y respuestas son escritas para que puedas leerlas. ¡Disfruta!
    </div>

    <div id="difficulty-container">
        <h2>Selecciona la dificultad</h2>
        <div class="button-container">
            <button onclick="startQuiz('easy')">Fácil</button>
            <button onclick="startQuiz('medium')">Medio</button>
            <button onclick="startQuiz('hard')">Difícil</button>
        </div>
    </div>

    <div id="question-container">
        <h2 id="question"></h2>
        <div id="answers"></div>
    </div>

    <div id="result-container">
        <h3 id="result"></h3>
        <button class="result-button" onclick="restartQuiz()">Reiniciar</button>
        <button class="result-button" id="view-results" onclick="viewResults()" style="display:none;">Ver Resultados</button>
    </div>

    <script>
        const questions = {
            easy: [
                { question: "¿Cuánto es 2 + 2?", answers: ["3", "4", "5"], correct: "4" },
                { question: "¿Cuántos días tiene una semana?", answers: ["5", "6", "7"], correct: "7" },
                { question: "¿En qué continente está Perú?", answers: ["Asia", "Europa", "América"], correct: "América" },
                { question: "¿Cuál es el color del sol?", answers: ["Rojo", "Amarillo", "Azul"], correct: "Amarillo" },
                { question: "¿Cómo se llama el presidente de Perú?", answers: ["Pedro Castillo", "Dina Boluarte", "Ollanta Humala"], correct: "Dina Boluarte" }
            ],
            medium: [
                { question: "¿Cuántos países hay en América del Sur?", answers: ["9", "12", "14"], correct: "12" },
                { question: "¿Cuántos meses tiene un año?", answers: ["10", "11", "12"], correct: "12" },
                { question: "¿Cuál es la capital de Francia?", answers: ["Madrid", "Roma", "París"], correct: "París" },
                { question: "¿Cuántos continentes hay?", answers: ["5", "6", "7"], correct: "7" },
                { question: "¿Quién pintó la Mona Lisa?", answers: ["Picasso", "Da Vinci", "Van Gogh"], correct: "Da Vinci" }
            ],
            hard: [
                { question: "¿Cuál es el número atómico del oro?", answers: ["79", "89", "64"], correct: "79" },
                { question: "¿Qué órgano produce la insulina?", answers: ["Estómago", "Hígado", "Páncreas"], correct: "Páncreas" },
                { question: "¿Quién escribió 'Don Quijote de la Mancha'?", answers: ["Miguel de Cervantes", "Federico García Lorca", "Mario Vargas Llosa"], correct: "Miguel de Cervantes" },
                { question: "¿Qué tipo de animal es el delfín?", answers: ["Mamífero", "Reptil", "Pájaro"], correct: "Mamífero" },
                { question: "¿Qué país tiene la mayor población del mundo?", answers: ["India", "China", "Estados Unidos"], correct: "China" }
            ]
        };

        let currentQuestionIndex = 0;
        let score = 0;
        let selectedDifficulty = '';
        let startTime = 0;

        function startQuiz(difficulty) {
            selectedDifficulty = difficulty;
            currentQuestionIndex = 0;
            score = 0;
            startTime = new Date().getTime();
            document.getElementById("difficulty-container").style.display = "none";
            document.getElementById("question-container").style.display = "block";
            showQuestion();
        }

        function showQuestion() {
            const questionData = questions[selectedDifficulty][currentQuestionIndex];
            document.getElementById("question").innerText = questionData.question;
            const answersContainer = document.getElementById("answers");
            answersContainer.innerHTML = '';

            questionData.answers.forEach(answer => {
                const button = document.createElement('button');
                button.classList.add('answer-button');
                button.innerText = answer;
                button.onclick = () => checkAnswer(answer);
                answersContainer.appendChild(button);
            });
        }

        function checkAnswer(selectedAnswer) {
            const questionData = questions[selectedDifficulty][currentQuestionIndex];
            const answerButtons = document.querySelectorAll('.answer-button');

            answerButtons.forEach(button => {
                button.disabled = true;
                if (button.innerText === questionData.correct) {
                    button.classList.add('correct');
                }
                if (button.innerText === selectedAnswer && selectedAnswer !== questionData.correct) {
                    button.classList.add('incorrect');
                }
            });

            if (selectedAnswer === questionData.correct) {
                score++;
            }

            currentQuestionIndex++;

            if (currentQuestionIndex < questions[selectedDifficulty].length) {
                setTimeout(showQuestion, 1000);
            } else {
                setTimeout(showResult, 1000);
            }
        }

        function showResult() {
            document.getElementById("question-container").style.display = "none";
            const resultMessage = `¡Terminado! Has respondido correctamente ${score} de ${questions[selectedDifficulty].length} preguntas.`;
            document.getElementById("result").innerText = resultMessage;
            document.getElementById("result-container").style.display = "block";
            document.getElementById("view-results").style.display = "block";
        }

        function restartQuiz() {
            document.getElementById("result-container").style.display = "none";
            document.getElementById("difficulty-container").style.display = "block";
        }

        function viewResults() {
            const userName = "Nombre del Usuario";
            const timeTaken = ((new Date().getTime() - startTime) / 1000).toFixed(2);
            window.location.href = "{{ route('resultados.index') }}?score=" + score + "&totalQuestions=" + questions[selectedDifficulty].length + "&user_name=" + userName + "&time_taken=" + timeTaken + "&difficulty=" + selectedDifficulty;
        }
    </script>
</body>
</html>
