@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>{{ __('Cursos Disponibles') }}</h2>
    
    <div class="row">
        @foreach($cursos as $curso)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm border-primary">
                    <div class="card-body">
                        <h5 class="card-title">{{ $curso->nombre_curso }}</h5>
                        <p class="card-text">{{ __('Profesor: ') }} {{ $curso->profesor->nombre }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
