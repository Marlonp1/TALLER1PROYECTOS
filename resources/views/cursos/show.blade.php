@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>{{ $curso->nombre_curso }}</h2>
    <p>{{ __('Profesor: ') }} {{ $curso->profesor->name }}</p>
    <!-- Aquí puedes agregar más detalles sobre el curso -->
</div>
@endsection