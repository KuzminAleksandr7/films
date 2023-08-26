<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'is_published',
        'poster_url',
        'poster_path',
        'published_at',
    ];

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'genre_film');
    }

}
