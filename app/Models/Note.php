<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;
    protected $fillable = [
        "title",
        "description",
        "image",
        'userId',
        'category',
        'group_id',];
        public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }
        public function comments()
    {
        return $this->hasMany(Comment::class, 'noteId');
    }

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id');
    }
}
