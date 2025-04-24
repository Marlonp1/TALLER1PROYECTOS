<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quizz Divertido para Niños de Primaria</title>
    <style>
        /* Estilos que ya tienes */
        body {
            font-family: 'Arial', sans-serif;
            background: url('https://i.pinimg.com/originals/1b/83/dc/1b83dce6c2a59c92d2dfdd14df85c377.gif') no-repeat center center fixed;
            background-size: cover;
            color: #fff;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        h1 {
            font-size: 3em;
            margin-bottom: 20px;
            text-align: center;
        }
        .button-container {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
        }
        .button-container button {
            background: #FFC107;
            color: #333;
            padding: 15px 30px;
            border: none;
            border-radius: 25px;
            font-weight: bold;
            cursor: pointer;
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
            background: #4CAF50;
            color: white;
            padding: 15px;
            border: none;
            border-radius: 25px;
            width: 100%;
            font-size: 1.1em;
            cursor: pointer;
            margin: 10px 0;
            transition: transform 0.2s, background 0.3s;
        }
        .answer-button:hover {
            background: #43A047;
            transform: scale(1.05);
        }
        .answer-button.correct { background: #66BB6A; }
        .answer-button.incorrect { background: #E57373; }
        #question-container, #result-container {
            display: none;
            background: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            width: 80%;
            max-width: 600px;
            margin-top: 20px;
        }
        #result-container {
            background: rgba(0, 0, 0, 0.6);
        }

        /* Estilos para los botones de reiniciar y ver resultados */
        .result-button {
            background-color: #2196F3;
            color: white;
            font-size: 1.2em;
            padding: 15px 30px;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            transition: background 0.3s, transform 0.3s;
            margin: 10px;
        }

        .result-button:hover {
            background-color: #1976D2;
            transform: scale(1.1);
        }

        .result-button:active {
            transform: scale(0.98);
        }
    </style>
</head>
<body>
    <h1>Quizz Divertido para Niños de Primaria</h1>
    
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
            startTime = new Date().getTime();  // Iniciar el tiempo
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
            document.getElementById("view-results").style.display = "block";  // Mostrar el botón de resultados
        }

        function restartQuiz() {
            document.getElementById("result-container").style.display = "none";
            document.getElementById("difficulty-container").style.display = "block";
        }

        // Función para redirigir a los resultados
        function viewResults() {
            const userName = "Nombre del Usuario";  // Aquí puedes obtener el nombre del usuario desde sesión o input
            const timeTaken = ((new Date().getTime() - startTime) / 1000).toFixed(2);  // Calcular el tiempo en segundos
            window.location.href = "{{ route('resultados.index') }}?score=" + score + "&totalQuestions=" + questions[selectedDifficulty].length + "&user_name=" + userName + "&time_taken=" + timeTaken + "&difficulty=" + selectedDifficulty;
        }
    </script>
</body>
</html>
