@extends('layouts.app')

@section('Content')
    <div class="p-6">
        <h1 class="text-xl font-bold mb-4">Listado de usuarios</h1>

        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-2 mb-4 rounded">{{ session('success') }}</div>
        @endif

        <table class="w-full border text-sm text-left">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2">Nombre</th>
                    <th class="p-2">Email</th>
                    <th class="p-2">Usuario</th>
                    <th class="p-2">Rol</th>
                    <th class="p-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr class="border-t">
                        <td class="p-2">{{ $user->name }}</td>
                        <td class="p-2">{{ $user->email }}</td>
                        <td class="p-2">{{ $user->user_name }}</td>
                        <td class="p-2">{{ $user->role }}</td>
                        <td class="p-2 flex gap-2">
                            <a href="{{ route('admin.users.edit', $user) }}"
                               class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">Editar</a>

                            <form method="POST" action="{{ route('admin.users.destroy', $user) }}"
                                  onsubmit="return confirm('¿Estás seguro?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                    Borrar
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
