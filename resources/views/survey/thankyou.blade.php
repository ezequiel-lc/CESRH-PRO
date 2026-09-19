<!-- resources/views/survey/thankyou.blade.php -->
@extends('layouts.cuestionariosdx035')

@section('title', 'Gracias por responder')

@section('content')
    <div class="text-center">
        <!-- Icono de check -->
        <div class="mb-6">
            <svg class="w-16 h-16 mx-auto text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>

        <!-- Mensaje principal -->
        <h1 class="text-4xl font-bold text-blue-600 mb-4">¡Gracias por responder la encuesta!</h1>

        <!-- Mensaje adicional -->
        @if(session('requiereAtencion'))
            <p class="text-lg text-gray-700 mb-6">Tu encuesta ha sido revisada y <span class="font-semibold text-red-600">requiere atención adicional</span>.</p>
        @else
            <p class="text-lg text-gray-700 mb-6">Tu encuesta ha sido completada con éxito.</p>
        @endif

        <!-- Botón para volver al inicio -->
        <a href="{{ route('home') }}" class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition duration-300">
            Volver al inicio
        </a>
    </div>
@endsection