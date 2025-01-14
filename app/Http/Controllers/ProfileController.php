<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */

public function update(ProfileUpdateRequest $request): RedirectResponse
{
    $user = $request->user();

    // Validar y subir la imagen si existe
    if ($request->hasFile('image')) {

        // Eliminar la imagen anterior si existe
        if ($user->ProfileIMG && Storage::exists($user->ProfileIMG)) {
            Storage::delete($user->ProfileIMG);
        }

        // Guardar la nueva imagen en 'profileImages'
        $path = $request->file('image')->store('profileImages', 'public');

        // Actualizar la ruta de la imagen en la base de datos
        $user->ProfileIMG = $path;
    }

    // Actualizar otros campos validados
    $user->fill($request->validated());

    if ($user->isDirty('email')) {
        $user->email_verified_at = null;
    }

    $user->save();

    return Redirect::route('profile.edit')->with('status', 'profile-updated');
}


    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
