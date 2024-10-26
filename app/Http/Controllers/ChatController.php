<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Curso;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ChatController extends Controller
{
    // Muestra todos los chats y los cursos disponibles
    public function index()
    {
        $cursos = Curso::all(); // Obtener todos los cursos disponibles
        $chats = Chat::with('curso')->get();

        return view('chats.index', compact('chats', 'cursos')); // Pasar ambos a la vista
    }

    // Crea un nuevo chat
    public function store(Request $request)
    {
        $request->validate([
            'id_curso' => 'required|integer',
            'tipo_pregunta' => 'required|string',
        ]);

        // Crear un nuevo chat
        try {
            $chat = new Chat();
            $chat->id_curso = $request->id_curso; // Asignar el id_curso recibido
            $chat->tipo_pregunta = $request->tipo_pregunta;
            $chat->estado_chat = 'activo'; // Estado inicial
            $chat->fecha_inicio = now(); // Asignar fecha actual
            $chat->save();

            return response()->json(['success' => true, 'chat' => $chat]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al crear el chat: ' . $e->getMessage()], 500);
        }
    }

    // Cierra un chat
    public function close($id)
    {
        $chat = Chat::findOrFail($id);
        $chat->estado_chat = 'cerrado';
        $chat->fecha_cierre = now();
        $chat->save();

        return redirect()->route('chats.index')->with('success', 'Chat cerrado.');
    }

    // Muestra un chat específico y su información
    public function show($id)
    {
        // Obtener el chat por ID
        $chat = Chat::with('curso')->findOrFail($id);
        
        $dataSet = $this->loadDataSet();

        // Suponiendo que tienes una variable para el mensaje del usuario
        $userMessage = "¿Cuál es tu pregunta aquí?"; // Cambia esto según tu lógica

        // Obtener la respuesta más cercana
        $response = $this->getClosestResponse($userMessage, $dataSet);
        
        // Verificar si hay una respuesta válida
        if (empty($response)) {
            $response = "Lo siento, no tengo información específica sobre eso. ¿Te gustaría preguntar otra cosa?";
        }

        // Pasar el dataset y la respuesta a la vista
        return view('chats.show', compact('chat', 'dataSet', 'response'));
    }

    // Carga el dataset desde el archivo CSV
    private function loadDataSet()
    {
        $dataSet = [];
        $csvFilePath = storage_path('app/datasets/data.csv');

        if (($handle = fopen($csvFilePath, 'r')) !== FALSE) {
            // Leer la primera fila (cabeceras)
            $headerRow = fgetcsv($handle);

            // Asegúrate de que las cabeceras estén correctamente formateadas
            if ($headerRow !== false) {
                // Leer cada fila
                while (($data = fgetcsv($handle)) !== FALSE) {
                    // Asegurarse de que cada fila tenga el mismo número de columnas
                    if (count($data) === count($headerRow)) {
                        $dataSet[] = array_combine($headerRow, $data); // Combinar con las cabeceras
                    }
                }
            }
            fclose($handle);
        }

        return $dataSet;
    }

    // Nueva función para obtener la respuesta más cercana usando coincidencia difusa
    public function getClosestResponse($userMessage, $dataSet)
    {
        $bestMatch = "";
        $highestSimilarity = 0; // Cambiado a 0 para comparación adecuada

        // Normalizar el mensaje del usuario
        $userMessage = $this->normalizeText($userMessage);

        // Recorrer cada entrada del dataset
        foreach ($dataSet as $data) {
            // Normalizar la pregunta actual
            $currentQuestion = $this->normalizeText($data['question']);
            
            // Calcular la distancia de Levenshtein
            $similarity = levenshtein($userMessage, $currentQuestion);

            // Convertir la similitud a un puntaje entre 0 y 1
            $maxLength = max(strlen($userMessage), strlen($currentQuestion));
            $similarityScore = $maxLength > 0 ? 1 - ($similarity / $maxLength) : 0; // Evitar división por cero

            // Verificar si este es el mejor partido
            if ($similarityScore > $highestSimilarity) {
                $highestSimilarity = $similarityScore;
                $bestMatch = $data['answer']; // Cambiado para usar 'answer' como respuesta
            }
        }

        // Retornar la mejor coincidencia o una respuesta alternativa si no se encontró coincidencia
        return $highestSimilarity > 0.5 ? $bestMatch : "Lo siento, no tengo información específica sobre eso.";
    }

    private function normalizeText($text)
    {
        // Eliminar signos de puntuación y convertir a minúsculas
        $text = strtolower($text);
        $text = preg_replace('/[¿?!.,"\'()]/', '', $text); // Elimina varios signos de puntuación
        $text = str_replace(['á', 'é', 'í', 'ó', 'ú'], ['a', 'e', 'i', 'o', 'u'], $text); // Quitar tildes
        return trim($text); // Eliminar espacios al inicio y final
    }

    // Controlador ChatbotController.php
    public function getSuggestedQuestions($category) 
    {
        $questions = [];
        
        // Leer el CSV y buscar las preguntas de la misma categoría
        $csvFilePath = storage_path('app/datasets/data.csv');
        
        if (($handle = fopen($csvFilePath, 'r')) !== FALSE) {
            // Leer la primera fila (cabeceras)
            $headerRow = fgetcsv($handle);
            while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
                if (isset($data[3]) && $data[3] === $category) {
                    $questions[] = [
                        'id' => $data[0],
                        'question' => $data[1],
                    ];
                }
            }
            fclose($handle);
        }

        return response()->json($questions);
    }

    // Muestra un quizz asociado a un chat específico
public function showQuizz($chatId)
{
    // Obtener el chat por ID
    $chat = Chat::with('curso')->findOrFail($chatId);

    // Obtener preguntas aleatorias del dataset
    $questions = $this->getRandomQuestions(10); // Cambia '10' al número de preguntas que deseas

    return view('chats.quizz', compact('chat', 'questions'));
}

// Función auxiliar para obtener preguntas aleatorias
private function getRandomQuestions($numQuestions)
{
    $dataSet = $this->loadDataSet();

    // Barajar el dataset y obtener las primeras $numQuestions preguntas
    shuffle($dataSet);
    return array_slice($dataSet, 0, $numQuestions);
}
// Evalúa el quizz y calcula la puntuación
public function evaluateQuizz(Request $request, $chatId)
{
    $correctAnswers = 0;
    $totalQuestions = count($request->questions);

    // Comparar respuestas del usuario con las correctas
    foreach ($request->questions as $questionId => $userAnswer) {
        $dataSet = $this->loadDataSet();
        $correctAnswer = $this->getAnswerByQuestionId($questionId, $dataSet);

        if (strtolower(trim($userAnswer)) === strtolower(trim($correctAnswer))) {
            $correctAnswers++;
        }
    }

    // Calcular la puntuación
    $score = ($correctAnswers / $totalQuestions) * 100;

    // Mostrar la puntuación o guardarla en la base de datos según tu lógica
    return redirect()->route('chats.show', $chatId)->with('success', "Tu puntuación es: $score%");
}

// Obtener la respuesta correcta usando el ID de la pregunta
private function getAnswerByQuestionId($questionId, $dataSet)
{
    foreach ($dataSet as $data) {
        if ($data['problem_id'] == $questionId) {
            return $data['solutions']; // Asegúrate de que 'solutions' es la columna correcta
        }
    }
    return null;
}

    
}
