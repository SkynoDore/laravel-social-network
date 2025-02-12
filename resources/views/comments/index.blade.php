@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Comentarios de "{{ $note->title }}"</h1>

        <form action="{{ route('comments.store', $note->id) }}" method="POST">
            @csrf
            <textarea name="text" class="form-control" required></textarea>
            <button type="submit" class="btn btn-primary mt-2">Comentar</button>
        </form>

        <ul class="list-group mt-4">
            @foreach ($note->comments as $comment)
                <li class="list-group-item">
                    <strong>{{ $comment->user->name }}:</strong> {{ $comment->text }}
                    @if (auth()->id() === $comment->user_id)
                        <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
@endsection
