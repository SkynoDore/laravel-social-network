<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['text', 'userId', 'noteId']; //ya al especificar los campos que se pueden llenar, no es necesario especificar los campos que no se pueden llenar
    // Relación con el usuario (Un comentario pertenece a un usuario)
    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }

    // Relación con la nota (Un comentario pertenece a una nota)
    public function note()
    {
        return $this->belongsTo(Note::class, 'noteId');
    }
}
