@extends('layouts.app')

@section('Content')
    <div class="p-6 max-w-xl mx-auto">
        <h1 class="text-xl font-bold mb-4">Editar usuario</h1>

        <form method="POST" action="{{ route('admin.users.update', $user) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block">Nombre</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full border p-2 rounded">
                @error('name') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
            </div>

            <div class="mb-4">
                <label class="block">Nombre de usuario</label>
                <input type="text" name="user_name" value="{{ old('user_name', $user->user_name) }}" class="w-full border p-2 rounded">
                @error('user_name') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
            </div>

            <div class="mb-4">
                <label class="block">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full border p-2 rounded">
                @error('email') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
            </div>

            <div class="mb-4">
                <label class="block">Rol</label>
                <select name="role" class="w-full border p-2 rounded">
                    <option value="visitor" @selected($user->role === 'visitor')>Visitor</option>
                    <option value="admin" @selected($user->role === 'admin')>Admin</option>
                    <!-- Puedes agregar más roles -->
                </select>
                @error('role') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
            </div>

            <div class="mb-4">
                <label class="block">Contraseña (deja en blanco para no cambiarla)</label>
                <input type="password" name="password" class="w-full border p-2 rounded">
                <input type="password" name="password_confirmation" placeholder="Confirmar contraseña" class="w-full border p-2 rounded mt-2">
                @error('password') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
            </div>

            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                Guardar cambios
            </button>
        </form>
    </div>
@endsection
