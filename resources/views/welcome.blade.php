@extends('layouts.app')
@section('title', 'Toca Césped')
@section('description', 'Red social de amantes de la actividad física y el aire libre.')
@section('keywords', 'Social, deporte, actividad fisica, aire libre, comunidad, notas, comentarios')
@section('Content')
   <h1 class="text-3xl font-bold mb-4">¡Bienvenido a Toca Césped!</h1>

  <p class="mb-4">
    ¿Harto de pasar horas frente al móvil sin hacer nada productivo?
    <strong>Toca Césped</strong> es tu excusa perfecta para salir, moverte y reconectar con el mundo real.
    Descubre parques cercanos donde entrenar, hacer yoga, practicar calistenia o simplemente pasar un buen rato con amigos.
  </p>

  <p class="mb-4">
    Olvídate de los procesos largos. En solo unos pasos podrás crear tu perfil, unirte a comunidades
    y empezar a explorar todo lo que <strong>Toca Césped</strong> tiene para ofrecer.
  </p>

  <p class="mb-4 font-semibold italic">
    ¡Sal, toca césped y vive!
  </p>

  <p class="mb-6">
    Esta es tu oportunidad para dejar las excusas atrás y comenzar a moverte. La naturaleza te espera,
    y no hay mejor forma de disfrutarla que rodeado de gente con tus mismas ganas de activarse.
  </p>

  <h2 class="text-xl font-semibold mb-2">¿Qué puedes hacer en esta red social?</h2>
  <ul class="list-disc pl-6 mb-6">
    <li>Configurar tu <a href="{{route('profile.edit')}}" class="text-blue-600 hover:underline">perfil</a></li>
    <li><a href="{{route('group.index')}}" class="text-blue-600 hover:underline">Buscador de parques</a> con filtros y geolocalización</li>
    <li><a href="{{route('note.create')}}" class="text-blue-600 hover:underline">Publicar</a> lo que piensas</li>
    <li>Comentar publicaciones</li>
    <li>Sistema de likes y dislikes</li>
  </ul>

  <p class="text-sm text-gray-600">
    La página se encuentra actualmente en desarrollo. Si detectas algún error o quieres aportar ideas,
    puedes escribirnos a: <a href="mailto:skynodore@gmail.com" class="text-blue-600 underline">skynodore@gmail.com</a>
  </p>

@endsection
