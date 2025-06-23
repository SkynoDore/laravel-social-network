<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'uid',
        'title',
        'description',
        'organization_name',
        'organization_desc',
        'latitude',
        'longitude',
        'area',
        'locality',
        'district',
        'street_address',
        'postal_code',
        'link',
        'price',
    ];

    // Relación: un grupo puede tener muchas notas
    public function notes()
    {
        return $this->hasMany(Note::class);
    }
}
