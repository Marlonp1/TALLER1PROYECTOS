<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ResultadoController extends Controller
{
    // Método para mostrar los resultados
    public function index(Request $request)
    {
        // Recibe los parámetros de la URL
        $score = $request->input('score');
        $totalQuestions = $request->input('totalQuestions');
        $userName = auth()->user()->nombre;
        $timeTaken = $request->input('time_taken');
        $difficulty = $request->input('difficulty');  // Asegúrate de capturar la dificultad
        
        // Depuración: log de los valores recibidos
        Log::info("Recibido en index: score={$score}, totalQuestions={$totalQuestions}, userName={$userName}, timeTaken={$timeTaken}, difficulty={$difficulty}");

        // Lógica para obtener los top resultados
        $topResults = $this->getTopResults();

        // Guardar el resultado automáticamente
        $this->guardarResultadoAutomáticamente($score, $totalQuestions, $difficulty, $timeTaken, $userName);

        // Retorna la vista con las variables necesarias
        return view('resultados.index', compact('score', 'totalQuestions', 'userName', 'timeTaken', 'difficulty', 'topResults'));
    }

    // Función para obtener los resultados desde el archivo JSON
    private function getTopResults()
    {
        // Ruta del archivo JSON donde se guardan los resultados
        $filePath = storage_path('app/results.json');

        // Si el archivo existe, lo leemos
        if (file_exists($filePath)) {
            $results = json_decode(file_get_contents($filePath), true);
            return $results;
        }

        // Si el archivo no existe, regresamos un arreglo vacío
        return [];
    }

    // Función para guardar los resultados en un archivo JSON
    private function guardarResultadoAutomáticamente($score, $totalQuestions, $difficulty, $timeTaken, $userName)
    {
        try {
            // Obtenemos los resultados actuales
            $results = $this->getTopResults();

            // Añadir el nuevo resultado
            $newResult = [
                'nombre' => $userName,
                'puntaje' => $score,
                'total_preguntas' => $totalQuestions,
                'dificultad' => $difficulty,
                'tiempo_respuesta' => $timeTaken,
            ];

            $results[] = $newResult;

            // Ordenamos los resultados por puntaje de mayor a menor
            usort($results, function ($a, $b) {
                return $b['puntaje'] - $a['puntaje'];
            });

            // Limitar los resultados a los 5 primeros
            $topResults = array_slice($results, 0, 5);

            // Guardamos los resultados actualizados en el archivo JSON
            file_put_contents(storage_path('app/results.json'), json_encode($topResults, JSON_PRETTY_PRINT));

            // Depuración: confirmación de que el resultado fue guardado
            Log::info("Resultado guardado exitosamente: Nombre={$userName}, Puntaje={$score}, Tiempo={$timeTaken}");
        } catch (\Exception $e) {
            // En caso de error, logueamos la excepción
            Log::error("Error al guardar el resultado: " . $e->getMessage());
        }
    }
}
