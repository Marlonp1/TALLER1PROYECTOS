@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-center text-primary mb-4">{{ __('Resultados del Quizz') }}</h2>

    <div class="card shadow-lg">
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <p class="h4">¡Gracias por participar! Aquí están tus resultados:</p>
            <div class="row mt-4">
                <div class="col-md-6">
                    <p><strong>Puntaje: </strong>{{ $score }} de {{ $totalQuestions }} preguntas correctas.</p>
                    <p><strong>Dificultad: </strong>{{ ucfirst($difficulty) }}</p>
                </div>
                <div class="col-md-6 text-right">
                    <p><strong>Tiempo tomado: </strong>{{ $timeTaken }} segundos</p>
                    <p><strong>Usuario: </strong>{{ $userName }}</p>
                </div>
            </div>

            <hr>

            <h4 class="text-center mt-4">Top 5 Resultados</h4>
            @if(count($topResults) == 0)
                <p class="text-center">No hay resultados disponibles en este momento.</p>
            @else
                <table class="table table-bordered table-striped mt-4">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Puntaje</th>
                            <th>Dificultad</th>
                            <th>Tiempo Tomado (segundos)</th> <!-- Nueva columna de tiempo -->
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Mostrar los resultados del usuario en la tabla -->
                        <tr class="table-info">
                            <td>1</td>
                            <td>{{ $userName }}</td>
                            <td>{{ $score }} de {{ $totalQuestions }}</td>
                            <td>{{ ucfirst($difficulty) }}</td>
                            <td>{{ $timeTaken }} segundos</td> <!-- Mostrar solo los segundos -->
                        </tr>

                        <!-- Mostrar los resultados de los top 5 -->
                        @foreach ($topResults as $index => $result)
                            <tr>
                                <td>{{ $index + 2 }}</td> <!-- Comienza desde el 2 -->
                                <td>{{ $result['nombre'] }}</td>
                                <td>{{ $result['puntaje'] }} de {{ $result['total_preguntas'] }}</td>
                                <td>{{ ucfirst($result['dificultad']) }}</td>
                                <td>{{ $result['tiempo_respuesta'] }} segundos</td> <!-- Mostrar solo los segundos -->
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif

            <!-- Botón para volver al inicio -->
            <div class="text-center mt-4">
                <a href="http://localhost:8080/ConsolidadoPruebasGrupo01/public/" class="btn btn-primary">Volver al Inicio</a>
            </div>
        </div>
    </div>
</div>
@endsection
