@props(['user', 'size' => 'w-8 h-8'])

@if ($user?->ProfileIMG)
    <img src="{{ asset('storage/' . $user->ProfileIMG) }}" alt="Foto de perfil" class="{{ $size }} rounded-full object-cover mr-2">
@else
    <img src="{{ asset('storage/profileImages/default-profile.jpg') }}" alt="Foto por defecto" class="{{ $size }} rounded-full object-cover mr-2">
@endif
