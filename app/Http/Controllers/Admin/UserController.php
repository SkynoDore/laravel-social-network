<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);
        return view('admin.users.index', compact('users'), [
            'userCount' => \App\Models\User::count(),
            'noteCount' => \App\Models\Note::count(),
        ]);

    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
{
    // Validaciones generales
    $request->validate([
        'name' => 'required|string|max:255',
        'user_name' => 'required|string|max:255|unique:users,user_name,' . $user->id,
        'email' => 'required|email|unique:users,email,' . $user->id,
        'role' => 'required|string',
    ]);

    // Validación condicional de contraseña
    if ($request->filled('password')) {
        $request->validate([
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);
        $user->password = Hash::make($request->password);
    }

    // Asignación de otros campos
    $user->name = $request->name;
    $user->user_name = $request->user_name;
    $user->email = $request->email;
    $user->role = $request->role;

    $user->save();

    return redirect()->route('admin.users.index')->with('success', 'Usuario actualizado');
}


    public function destroy(User $user)
    {
          $user->delete();

        return back()->with('success', 'Usuario eliminado');
    }
}
